<?php

namespace App\Controllers\Admin\Menu;

use App\Controllers\BaseController;
use App\Models\TransRespondenPembinaanModel;
use App\Models\TransJawabanPembinaanModel;

use App\Models\RefJenisLayananModel;

class LaporanPembinaan extends BaseController
{
    public function index()
    {
        $respondenModel = new TransRespondenPembinaanModel();
        $jawabanModel = new TransJawabanPembinaanModel();
        $pertanyaanModel = new \App\Models\RefPertanyaanPembinaanModel();
        $layananModel = new RefJenisLayananModel(); // Load Unit Model

        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $selectedUnit = $this->request->getGet('unit'); // Filter by Unit Name
        
        // Fetch Questions
        $questions = $pertanyaanModel->where('is_active', 1)
            ->orderBy('nomor_urut', 'ASC')
            ->findAll();

        // Fetch Units for Dropdown
        $units = $layananModel->where('is_active', 1)->findAll();

        $data = [
            'title' => 'Laporan Pembinaan',
            'reportData' => [],
            'questions' => $questions,
            'units' => $units, // Pass units to view
            'filters' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'unit' => $selectedUnit
            ]
        ];

        if ($startDate && $endDate) {
            // 1. Get Respondents
            $query = $respondenModel
                ->where("DATE(tanggal_pelaksanaan) >=", $startDate)
                ->where("DATE(tanggal_pelaksanaan) <=", $endDate);

            // Apply Unit Filter if selected
            if ($selectedUnit && $selectedUnit !== 'all') {
                $query->where('unit_kerja_terkait', $selectedUnit);
            }

            $respondents = $query->orderBy('tanggal_pelaksanaan', 'DESC')->findAll();

            if (!empty($respondents)) {
                $respondentIds = array_column($respondents, 'id');
                $totalRespondents = count($respondents);

                // 2. Get Answers
                $answers = $jawabanModel->whereIn('responden_pembinaan_id', $respondentIds)->findAll();

                // 3. Map Answers & Calculate Stats
                $matrix = []; 
                $totalScorePerQuestion = [];
                $frequency = [];
                
                // Initialize stats arrays
                foreach ($questions as $q) {
                    $totalScorePerQuestion[$q->id] = 0;
                    $frequency[$q->id] = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
                }

                foreach ($answers as $ans) {
                    $qid = $ans['pertanyaan_pembinaan_id'];
                    $score = $ans['skor_jawaban'];
                    
                    // Matrix for Table
                    $matrix[$ans['responden_pembinaan_id']][$qid] = $score;
                    
                    // Stats Aggregation
                    if (isset($totalScorePerQuestion[$qid])) {
                        $totalScorePerQuestion[$qid] += $score;
                    }
                    if (isset($frequency[$qid][$score])) {
                        $frequency[$qid][$score]++;
                    }
                }

                // EMBED SCORES INTO RESPONDENTS (For Export Compatibility)
                foreach ($respondents as &$r) {
                    $r['scores'] = $matrix[$r['id']] ?? [];
                }
                unset($r); // Break reference

                // 4. Calculate NRR & IKM
                $nrrPerUnsur = [];
                $nrrTertimbang = [];
                $totalNrrTertimbang = 0;
                $weight = 1 / count($questions); // Equal weight

                foreach ($questions as $q) {
                    $avg = $totalRespondents > 0 ? $totalScorePerQuestion[$q->id] / $totalRespondents : 0;
                    $nrrPerUnsur[$q->id] = $avg;
                    
                    $weighted = $avg * $weight;
                    $nrrTertimbang[$q->id] = $weighted;
                    $totalNrrTertimbang += $weighted;
                }

                $ikmKonversi = $totalNrrTertimbang * 25; 

                // Predicate Logic
                if ($ikmKonversi >= 88.31) { $mutu = 'A'; $ket = 'Sangat Baik'; $class = 'bg-emerald-100 text-emerald-800'; }
                elseif ($ikmKonversi >= 76.61) { $mutu = 'B'; $ket = 'Baik'; $class = 'bg-blue-100 text-blue-800'; }
                elseif ($ikmKonversi >= 65.00) { $mutu = 'C'; $ket = 'Kurang Baik'; $class = 'bg-orange-100 text-orange-800'; }
                else { $mutu = 'D'; $ket = 'Tidak Baik'; $class = 'bg-red-100 text-red-800'; }

                $data['reportData'] = [
                    'respondents' => $respondents,
                    'matrix' => $matrix,
                    'avg_score' => $ikmKonversi,
                    'predikat' => $ket,
                    'stats' => [
                        'total_per_unsur' => $totalScorePerQuestion,
                        'nrr_per_unsur' => $nrrPerUnsur,
                        'nrr_tertimbang' => $nrrTertimbang,
                        'ikm_konversi' => $ikmKonversi,
                        'mutu' => $mutu,
                        'ket' => $ket,
                        'class' => $class,
                        'frequency' => $frequency
                    ]
                ];
            } else {
                $data['reportData'] = [];
            }
        }

        return view('admin/menu/laporan_pembinaan', $data);
    }
}
