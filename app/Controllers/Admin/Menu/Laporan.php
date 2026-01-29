<?php

namespace App\Controllers\Admin\Menu;

use App\Controllers\BaseController;
use App\Models\RefJenisLayananModel;
use App\Models\SurveyRespondenModel;
use App\Models\SurveyJawabanModel;
use App\Models\RefUnsurPelayananModel;

use App\Models\RefPertanyaanModel;
use App\Models\RefJawabanModel;

class Laporan extends BaseController
{
    public function index()
    {
        $layananModel = new RefJenisLayananModel();
        $respondenModel = new SurveyRespondenModel();
        $jawabanModel = new SurveyJawabanModel();
        $unsurModel = new RefUnsurPelayananModel();
        $pertanyaanModel = new RefPertanyaanModel();
        $refJawabanModel = new RefJawabanModel();

        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $layananId = $this->request->getGet('layanan_id');

        $data = [
            'title' => 'Laporan IKM',
            'layanan' => $layananModel->where('is_active', 1)->findAll(),
            'unsur' => $unsurModel->orderBy('id', 'ASC')->findAll(),
            'reportData' => null,
            'chartOptions' => [], // Default empty
            'filters' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'layanan_id' => $layananId
            ]
        ];

        if ($startDate && $endDate && $layananId) {
            // 0. Get Dynamic Options for Charts
            // Fetch questions for this service
            $chartOptions = [];
            
            // Only fetch specific labels if a specific unit is selected
            if ($layananId !== 'all') {
                $pertanyaan = $pertanyaanModel->where('jenis_layanan_id', $layananId)->where('is_active', 1)->findAll();
                $pertanyaanIds = array_column($pertanyaan, 'id');
                
                if (!empty($pertanyaanIds)) {
                    // Fetch answers for these questions
                    $opsi = $refJawabanModel->whereIn('soal_id', $pertanyaanIds)->orderBy('bobot_nilai', 'ASC')->findAll();
                    
                    // Map Soal ID back to Unsur ID
                    $soalToUnsur = [];
                    foreach($pertanyaan as $p) {
                        $soalToUnsur[$p->id] = $p->unsur_id;
                    }

                    // Group options by Unsur ID
                    foreach($opsi as $o) {
                        if (isset($soalToUnsur[$o->soal_id])) {
                            $uId = $soalToUnsur[$o->soal_id];
                            // Store label keyed by weight (1-4)
                            $chartOptions[$uId][$o->bobot_nilai] = $o->label_jawaban;
                        }
                    }
                }
            }
            $data['chartOptions'] = $chartOptions;

            // 1. Get Respondents
            $query = $respondenModel->select('trans_responden.*, ref_instansi.nama_instansi')
                ->join('ref_instansi', 'ref_instansi.id = trans_responden.instansi_id', 'left')
                ->where("DATE(trans_responden.tanggal_survei) >=", $startDate)
                ->where("DATE(trans_responden.tanggal_survei) <=", $endDate)
                ->orderBy('trans_responden.tanggal_survei', 'ASC');

            // Apply unit filter ONLY if not 'all'
            if ($layananId !== 'all') {
                $query->where('trans_responden.jenis_layanan_id', $layananId);
            }

            $respondents = $query->findAll();

            if (!empty($respondents)) {
                $respondentIds = array_column($respondents, 'id');

                // 2. Get Answers
                // Join to get unsur info
                $answers = $jawabanModel->select('trans_detail_jawaban.*, ref_soal.unsur_id')
                    ->join('ref_soal', 'ref_soal.id = trans_detail_jawaban.soal_id')
                    ->whereIn('trans_detail_jawaban.responden_id', $respondentIds)
                    ->findAll();

                // 3. Map Answers to Respondents
                // Structure: $mappedData[responden_id][unsur_id] = score
                $mappedAnswers = [];
                foreach ($answers as $ans) {
                    $mappedAnswers[$ans->responden_id][$ans->unsur_id] = $ans->nilai_skor;
                }

                // 4. Calculate Statistics
                $stats = [
                    'total_per_unsur' => [],
                    'nrr_per_unsur' => [],
                    'nrr_tertimbang' => [],
                    'frequency' => [],
                    'ikm_total' => 0,
                    'ikm_konversi' => 0
                ];

                $totalRespondents = count($respondents);
                $totalUnsur = count($data['unsur']);
                $weight = $totalUnsur > 0 ? 1 / $totalUnsur : 0;

                // Initialize totals
                foreach ($data['unsur'] as $u) {
                    $stats['total_per_unsur'][$u->id] = 0;
                    $stats['frequency'][$u->id] = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
                }

                // Sum scores
                foreach ($respondents as $r) {
                    $r->scores = [];
                    foreach ($data['unsur'] as $u) {
                        $score = $mappedAnswers[$r->id][$u->id] ?? 0;
                        $r->scores[$u->id] = $score;
                        $stats['total_per_unsur'][$u->id] += $score;

                        if ($score >= 1 && $score <= 4) {
                            $stats['frequency'][$u->id][$score]++;
                        }
                    }
                }

                // Calculate NRR and Weighted NRR
                $sumWeightedNRR = 0;
                foreach ($data['unsur'] as $u) {
                    $totalScore = $stats['total_per_unsur'][$u->id];
                    $nrr = $totalRespondents > 0 ? $totalScore / $totalRespondents : 0;
                    $weightedNRR = $nrr * $weight;

                    $stats['nrr_per_unsur'][$u->id] = $nrr;
                    $stats['nrr_tertimbang'][$u->id] = $weightedNRR;
                    $sumWeightedNRR += $weightedNRR;
                }

                $stats['ikm_total'] = $sumWeightedNRR; // Skala 4 (approx)
                $stats['ikm_konversi'] = $sumWeightedNRR * 25; // Skala 100

                // Classification Logic
                $ikm = $stats['ikm_konversi'];
                if ($ikm >= 88.31) {
                    $stats['mutu'] = 'A';
                    $stats['ket'] = 'Sangat Baik';
                    $stats['class'] = 'bg-emerald-100 text-emerald-800 border-emerald-200';
                } elseif ($ikm >= 76.61) {
                    $stats['mutu'] = 'B';
                    $stats['ket'] = 'Baik';
                    $stats['class'] = 'bg-blue-100 text-blue-800 border-blue-200';
                } elseif ($ikm >= 65.00) {
                    $stats['mutu'] = 'C';
                    $stats['ket'] = 'Kurang Baik';
                    $stats['class'] = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                } else {
                    $stats['mutu'] = 'D';
                    $stats['ket'] = 'Tidak Baik';
                    $stats['class'] = 'bg-red-100 text-red-800 border-red-200';
                }

                $data['reportData'] = [
                    'respondents' => $respondents,
                    'stats' => $stats
                ];
            } else {
                $data['reportData'] = []; // Empty result
            }
        }

        return view('admin/menu/laporan', $data);
    }
}
