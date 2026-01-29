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

        // --- GLOBAL IKM CALCULATION (ALL UNITS) ---
        // Get ALL Respondents for this year
        $allRespondents = $db->table('trans_responden')
            ->select('id')
            ->where("YEAR(tanggal_survei)", $currentYear)
            ->get()->getResultArray();
        $allRespondentIds = array_column($allRespondents, 'id');
        
        // Calculate Global Stats
        $globalStats = $this->calculateIKM($db, $allRespondentIds, $listUnsur);


        // --- UNIT IKM CALCULATION ---
        $gridUnitData = [];
        // Palette of distinct colors
        $palette = ['blue', 'emerald', 'violet', 'amber', 'rose', 'cyan', 'fuchsia', 'lime', 'sky', 'orange', 'teal', 'indigo', 'pink'];
        $paletteIndex = 0;

        foreach ($listLayanan as $layanan) {
            // Get Respondents for this unit
            $respondents = $db->table('trans_responden')
                ->select('id')
                ->where('jenis_layanan_id', $layanan->id)
                ->where("YEAR(tanggal_survei)", $currentYear)
                ->get()->getResultArray();
            
            $respondentIds = array_column($respondents, 'id');
            
            // Calculate Unit Stats using Helper
            $stats = $this->calculateIKM($db, $respondentIds, $listUnsur);

            // Assign identity color
            $chartColor = $palette[$paletteIndex % count($palette)];
            $paletteIndex++;

            $gridUnitData[] = [
                'id' => $layanan->id,
                'nama' => $layanan->nama_layanan,
                'nrr_values' => array_values($stats['nrr_per_unsur']), 
                'unsur_keys' => array_map(function($u){ return $u->kode_unsur; }, $listUnsur),
                'mutu' => $stats['mutu'],
                'ket'  => $stats['ket'],
                'mutu_color'=> $stats['class_color'], 
                'chart_color' => $chartColor,
                'ikm'  => number_format($stats['ikm_konversi'], 2)
            ];
        }

        // Active Units for Landing Page Selection
        $activeUnits = $layananModel->where('is_active', 1)->orderBy('id', 'ASC')->findAll();

        $data = [
            'title' => 'Portal Survei Kepuasan Masyarakat',
            'units' => $activeUnits, 
            'globalStats'     => $globalStats, // Pass Global Stats
            'chartGender'     => json_encode($genderData),
            'chartPendidikan' => json_encode($pendidikanData),
            'chartPekerjaan'  => json_encode($pekerjaanData),
            'chartUsia'       => json_encode($usiaData),
            'gridUnitData'    => json_encode($gridUnitData),
            'currentYear'     => $currentYear
        ];

        helper('url');
        return view('landing_page', $data);
    }
}
