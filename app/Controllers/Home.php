<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $db = \Config\Database::connect();
        // 1. Data Gender (Pie Chart)
        $genderData = $db->table('trans_responden')
            ->select('jenis_kelamin, COUNT(*) as total')
            ->groupBy('jenis_kelamin')
            ->get()->getResultArray();

        // 2. Data Pendidikan (Bar Chart)
        $pendidikanData = $db->table('trans_responden')
            ->select('ref_pendidikan.nama_pendidikan, COUNT(trans_responden.id) as total')
            ->join('ref_pendidikan', 'ref_pendidikan.id = trans_responden.pendidikan_id')
            ->groupBy('ref_pendidikan.nama_pendidikan')
            ->get()->getResultArray();

        // 3. Data Pekerjaan (Bar/Donut Chart)
        $pekerjaanData = $db->table('trans_responden')
            ->select('ref_pekerjaan.nama_pekerjaan, COUNT(trans_responden.id) as total')
            ->join('ref_pekerjaan', 'ref_pekerjaan.id = trans_responden.pekerjaan_id')
            ->groupBy('ref_pekerjaan.nama_pekerjaan')
            ->get()->getResultArray();

        // 4. Data Kelompok Usia (Column Chart)
        // Mengelompokkan umur integer menjadi kategori
        $usiaQuery = "SELECT 
            CASE 
                WHEN umur < 20 THEN '< 20 Tahun'
                WHEN umur BETWEEN 20 AND 29 THEN '20 - 29 Tahun'
                WHEN umur BETWEEN 30 AND 39 THEN '30 - 39 Tahun'
                WHEN umur BETWEEN 40 AND 49 THEN '40 - 49 Tahun'
                WHEN umur >= 50 THEN '> 50 Tahun'
            END as kelompok_usia,
            COUNT(*) as total
            FROM trans_responden
            GROUP BY kelompok_usia
            ORDER BY min(umur)";
        $usiaData = $db->query($usiaQuery)->getResultArray();

        // 5. Data Per Unit (NRR Per Unsur & Mutu) - Current Year
        $currentYear = date('Y');
        
        // Models
        $layananModel = new \App\Models\RefJenisLayananModel();
        $unsurModel   = new \App\Models\RefUnsurPelayananModel();
        
        $listLayanan = $layananModel->findAll();
        $listUnsur   = $unsurModel->findAll();
        $totalUnsur  = count($listUnsur);
        $weight      = $totalUnsur > 0 ? 1 / $totalUnsur : 0;

        $gridUnitData = [];
        // Palette of distinct colors for units (Identity Colors)
        $palette = ['blue', 'emerald', 'violet', 'amber', 'rose', 'cyan', 'fuchsia', 'lime', 'sky', 'orange', 'teal', 'indigo', 'pink'];
        $paletteIndex = 0;

        foreach ($listLayanan as $layanan) {
            // Get Respondents for this unit AND current year
            $respondents = $db->table('trans_responden')
                ->select('id')
                ->where('jenis_layanan_id', $layanan->id)
                ->where("YEAR(tanggal_survei)", $currentYear)
                ->get()->getResultArray();
            
            $respondentIds = array_column($respondents, 'id');
            $totalResponders = count($respondentIds);
            
            // Init stats
            $ikpKonversi = 0;
            $nrrPerUnsur = [];
            // Init defaults for all unsur
            foreach($listUnsur as $u) {
                $nrrPerUnsur[$u->id] = 0;
            }

            if ($totalResponders > 0) {
                // Get Answers
                $answers = $db->table('trans_detail_jawaban')
                    ->select('trans_detail_jawaban.nilai_skor, ref_soal.unsur_id')
                    ->join('ref_soal', 'ref_soal.id = trans_detail_jawaban.soal_id')
                    ->whereIn('trans_detail_jawaban.responden_id', $respondentIds)
                    ->get()->getResultArray();

                // Sum Score per Unsur
                $scorePerUnsur = [];
                foreach ($answers as $ans) {
                    $uId = $ans['unsur_id'];
                    if (!isset($scorePerUnsur[$uId])) $scorePerUnsur[$uId] = 0;
                    $scorePerUnsur[$uId] += $ans['nilai_skor'];
                }

                // Calculate NRR & IKP
                $sumWeightedNRR = 0;
                foreach ($listUnsur as $u) {
                    $totalScore = $scorePerUnsur[$u->id] ?? 0;
                    $nrr = $totalScore / $totalResponders;
                    $nrrPerUnsur[$u->id] = number_format($nrr, 2); // Store formatted for display
                    
                    $weightedNRR = $nrr * $weight;
                    $sumWeightedNRR += $weightedNRR;
                }
                $ikpKonversi = $sumWeightedNRR * 25;
            }

            // Determine Mutu
            $mutu = '-'; $ket = 'Belum Ada Data Tahun ' . $currentYear; $classColor = 'gray';
            if ($totalResponders > 0) {
                if ($ikpKonversi >= 88.31) {
                    $mutu = 'A'; $ket = 'Sangat Baik'; $classColor = 'emerald';
                } elseif ($ikpKonversi >= 76.61) {
                    $mutu = 'B'; $ket = 'Baik'; $classColor = 'blue';
                } elseif ($ikpKonversi >= 65.00) {
                    $mutu = 'C'; $ket = 'Kurang Baik'; $classColor = 'yellow';
                } else {
                    $mutu = 'D'; $ket = 'Tidak Baik'; $classColor = 'red';
                }
            }

            // Assign identity color
            $chartColor = $palette[$paletteIndex % count($palette)];
            $paletteIndex++;

            $gridUnitData[] = [
                'id' => $layanan->id,
                'nama' => $layanan->nama_layanan,
                'nrr_values' => array_values($nrrPerUnsur), // Just the values for chart [3.5, 3.2...]
                'unsur_keys' => array_map(function($u){ return $u->kode_unsur; }, $listUnsur),
                'mutu' => $mutu,
                'ket'  => $ket,
                'mutu_color'=> $classColor, // Renamed to avoid confusion
                'chart_color' => $chartColor, // New distinct color
                'ikm'  => number_format($ikpKonversi, 2)
            ];
        }

        // Active Units for Landing Page Selection
        $activeUnits = $layananModel->where('is_active', 1)->orderBy('id', 'ASC')->findAll();

        $data = [
            'title' => 'Portal Survei Kepuasan Masyarakat',
            'units' => $activeUnits, // Pass active units to View
            // Kirim data ke View dalam format JSON agar mudah dibaca JS
            'chartGender'     => json_encode($genderData),
            'chartPendidikan' => json_encode($pendidikanData),
            'chartPekerjaan'  => json_encode($pekerjaanData),
            'chartUsia'       => json_encode($usiaData),
            'gridUnitData'    => json_encode($gridUnitData),
            'currentYear'     => $currentYear
        ];

        helper('url');
        return view('landing_page', $data); // Sesuaikan nama file view Anda

    }
}
