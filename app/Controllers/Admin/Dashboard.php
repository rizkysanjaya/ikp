<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $currentYear = date('Y');

        // ---------------------------------------------------------
        // BAGIAN 1: STATS CARDS (Ringkasan Data)
        // ---------------------------------------------------------

        // Hitung Total Semua Responden
        $totalSurvei = $db->table('trans_responden')->countAll();
        // Hitung Unit Layanan yang Aktif
        $totalUnit   = $db->table('ref_jenis_layanan')->where('is_active', 1)->countAllResults();
        // Hitung Responden yang masuk HARI INI
        $todaySurvei = $db->table('trans_responden')->where('DATE(tanggal_survei)', date('Y-m-d'))->countAllResults();

        // ---------------------------------------------------------
        // BAGIAN 2: GLOBAL IKM (ALL UNITS - CURRENT YEAR)
        // ---------------------------------------------------------
        $listUnsur = $db->table('ref_unsur_pelayanan')->get()->getResult();

        // Get ALL Respondents for this year
        $allRespondents = $db->table('trans_responden')
            ->select('id')
            ->where("YEAR(tanggal_survei)", $currentYear)
            ->get()->getResultArray();
        $allRespondentIds = array_column($allRespondents, 'id');
        
        // Calculate Global Stats using BaseController Helper
        $globalStats = $this->calculateIKM($db, $allRespondentIds, $listUnsur);


        // ---------------------------------------------------------
        // BAGIAN 3: PERHITUNGAN IKM PER UNIT (Logic Utama)
        // ---------------------------------------------------------

        // Ambil semua unit layanan aktif
        $units = $db->table('ref_jenis_layanan')->where('is_active', 1)->get()->getResult();
        $unitData = [];

        foreach ($units as $unit) {
            // A. Cari ID Responden milik unit ini
            $respondenQuery = $db->table('trans_responden')
                ->select('id')
                ->where('jenis_layanan_id', $unit->id)
                ->where("YEAR(tanggal_survei)", $currentYear) // Filter per tahun juga
                ->get();

            $respondenIds = array_column($respondenQuery->getResultArray(), 'id');
            
            // B. Calculate Unit Stats using Shared Helper
            $stats = $this->calculateIKM($db, $respondenIds, $listUnsur);

            // D. Masukkan ke array data untuk View
            $unitData[] = [
                'nama_layanan'    => $unit->nama_layanan,
                'total_responden' => $stats['total_responden'],
                'ikm_score'       => $stats['ikm_formatted'],
                'mutu'            => $stats['mutu'],
                'ket'             => $stats['ket'],
                'mutu_class'      => 'text-' . $stats['class_color'] . '-600 bg-' . $stats['class_color'] . '-100' // Map helper generic color to Tailwind class
            ];
        }

        // ---------------------------------------------------------
        // BAGIAN 4: RETURN VIEW
        // ---------------------------------------------------------

        $data = [
            'title'       => 'Dashboard Admin',
            'username'    => session()->get('name'), 
            'totalSurvei' => $totalSurvei,
            'totalUnit'   => $totalUnit,
            'todaySurvei' => $todaySurvei,
            'unitData'    => $unitData,
            'globalStats' => $globalStats, // Pass Global Stats
            'currentYear' => $currentYear
        ];

        return view('admin/dashboard', $data);
    }
    
    public function getUpdates()
    {
        if (!$this->request->isAJAX()) {
             // Optional: Block non-AJAX or just return 404
        }
        
        $db = \Config\Database::connect();
        $currentYear = date('Y');

        // 1. Re-calculate Header Stats
        $totalSurvei = $db->table('trans_responden')->countAll();
        $totalUnit   = $db->table('ref_jenis_layanan')->where('is_active', 1)->countAllResults();
        $todaySurvei = $db->table('trans_responden')->where('DATE(tanggal_survei)', date('Y-m-d'))->countAllResults();

        // 2. Re-calculate Unit Stats
        $listUnsur = $db->table('ref_unsur_pelayanan')->get()->getResult();
        $units = $db->table('ref_jenis_layanan')->where('is_active', 1)->get()->getResult();
        $unitData = [];

        foreach ($units as $unit) {
            $respondenQuery = $db->table('trans_responden')
                ->select('id')
                ->where('jenis_layanan_id', $unit->id)
                ->where("YEAR(tanggal_survei)", $currentYear)
                ->get();

            $respondenIds = array_column($respondenQuery->getResultArray(), 'id');
            $stats = $this->calculateIKM($db, $respondenIds, $listUnsur);

            $unitData[] = [
                'nama_layanan'    => $unit->nama_layanan,
                'total_responden' => $stats['total_responden'],
                'ikm_score'       => $stats['ikm_formatted'],
                'mutu'            => $stats['mutu'],
                'ket'             => $stats['ket'],
                'mutu_class'      => 'text-' . $stats['class_color'] . '-600 bg-' . $stats['class_color'] . '-100'
            ];
        }

        // 3. Render Partial HTML
        $htmlUnits = view('admin/partials/unit_cards', ['unitData' => $unitData]);

        // 4. Return JSON
        return $this->response->setJSON([
            'totalSurvei' => number_format($totalSurvei),
            'totalUnit'   => number_format($totalUnit),
            'todaySurvei' => number_format($todaySurvei),
            'htmlUnits'   => $htmlUnits
        ]);
    }
}
