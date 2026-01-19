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

        $data = [
            'title' => 'Portal Survei Kepuasan Masyarakat',
            // Kirim data ke View dalam format JSON agar mudah dibaca JS
            'chartGender'     => json_encode($genderData),
            'chartPendidikan' => json_encode($pendidikanData),
            'chartPekerjaan'  => json_encode($pekerjaanData),
            'chartUsia'       => json_encode($usiaData),
        ];

        helper('url');
        return view('landing_page', $data); // Sesuaikan nama file view Anda

    }
}
