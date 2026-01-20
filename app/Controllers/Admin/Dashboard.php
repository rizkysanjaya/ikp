<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // 1. Cek Login Session
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $db = \Config\Database::connect();

        // ---------------------------------------------------------
        // BAGIAN 1: STATS CARDS (Ringkasan Data)
        // ---------------------------------------------------------

        // Hitung Total Semua Responden
        $totalSurvei = $db->table('trans_responden')->countAll();

        // Hitung Unit Layanan yang Aktif
        $totalUnit   = $db->table('ref_jenis_layanan')->where('is_active', 1)->countAllResults();

        // Hitung Responden yang masuk HARI INI
        $todaySurvei = $db->table('trans_responden')
            ->where('DATE(tanggal_survei)', date('Y-m-d'))
            ->countAllResults();

        // ---------------------------------------------------------
        // BAGIAN 2: PERHITUNGAN IKM PER UNIT (Logic Utama)
        // ---------------------------------------------------------

        // Ambil semua unit layanan aktif
        $units = $db->table('ref_jenis_layanan')->where('is_active', 1)->get()->getResult();
        $unitData = [];

        foreach ($units as $unit) {
            // A. Cari ID Responden milik unit ini
            $respondenQuery = $db->table('trans_responden')
                ->select('id')
                ->where('jenis_layanan_id', $unit->id)
                ->get();

            $respondenIds = array_column($respondenQuery->getResultArray(), 'id');
            $totalResponden = count($respondenIds);

            // B. Set Default Value (Jika belum ada responden)
            $ikmScore = 0;
            $mutu = '-';
            $ket = 'Belum ada data';
            $mutuClass = 'text-gray-400 bg-gray-100'; // Abu-abu netral

            // C. Jika ada responden, mulai hitung IKM
            if ($totalResponden > 0) {

                // Query: Hitung Rata-rata Skor per Unsur (U1 s/d U9)
                // Output: Array berisi avg_skor untuk tiap unsur
                $unsurAvgs = $db->table('trans_detail_jawaban')
                    ->select('ref_soal.unsur_id, AVG(trans_detail_jawaban.nilai_skor) as avg_skor')
                    ->join('ref_soal', 'ref_soal.id = trans_detail_jawaban.soal_id')
                    ->whereIn('trans_detail_jawaban.responden_id', $respondenIds)
                    ->groupBy('ref_soal.unsur_id')
                    ->get()
                    ->getResult();

                $sumAvg = 0;

                // Jumlahkan rata-rata dari semua unsur yang ada
                foreach ($unsurAvgs as $row) {
                    $sumAvg += $row->avg_skor;
                }

                // ---------------------------------------------------
                // REVISI PENTING: PENGUNAAN PEMBAGI TETAP (FIXED DIVISOR)
                // ---------------------------------------------------
                // Sesuai PermenPANRB No 14/2017 (Hal 18), ada 9 Unsur standar.
                // Kita kunci pembagi di angka 9. 
                // Kenapa tidak pakai count($unsurAvgs)? 
                // Jawab: Agar jika ada unsur yang datanya kosong (error), nilai IKM drop (valid),
                // bukannya malah naik tinggi palsu karena pembaginya kecil.

                $fixedCountUnsur = 9;

                // Rumus: (Total Rata2 / 9) * 25
                // Ini setara dengan perkalian bobot 0.11 tapi lebih presisi secara komputer.
                $ikmScore = ($sumAvg / $fixedCountUnsur) * 25;

                // ---------------------------------------------------
                // PENENTUAN MUTU PELAYANAN (Grade)
                // ---------------------------------------------------
                // Sesuai Tabel II (Hal 19) PermenPANRB 14/2017

                if ($ikmScore >= 88.31) {
                    $mutu = 'A';
                    $ket = 'Sangat Baik';
                    $mutuClass = 'text-emerald-600 bg-emerald-100'; // Hijau
                } elseif ($ikmScore >= 76.61) {
                    $mutu = 'B';
                    $ket = 'Baik';
                    $mutuClass = 'text-blue-600 bg-blue-100'; // Biru
                } elseif ($ikmScore >= 65.00) {
                    $mutu = 'C';
                    $ket = 'Kurang Baik';
                    $mutuClass = 'text-yellow-600 bg-yellow-100'; // Kuning
                } else {
                    $mutu = 'D';
                    $ket = 'Tidak Baik'; // REVISI: Istilah resmi adalah "Tidak Baik" (bukan Buruk)
                    $mutuClass = 'text-red-600 bg-red-100'; // Merah
                }
            }

            // D. Masukkan ke array data untuk View
            $unitData[] = [
                'nama_layanan'    => $unit->nama_layanan,
                'total_responden' => $totalResponden,
                'ikm_score'       => number_format($ikmScore, 2), // Format 2 desimal (misal: 85.50)
                'mutu'            => $mutu,
                'ket'             => $ket,
                'mutu_class'      => $mutuClass
            ];
        }

        // ---------------------------------------------------------
        // BAGIAN 3: RETURN VIEW
        // ---------------------------------------------------------

        $data = [
            'title'       => 'Dashboard Admin',
            'username'    => session()->get('name'), // Ambil nama user dari session
            'totalSurvei' => $totalSurvei,
            'totalUnit'   => $totalUnit,
            'todaySurvei' => $todaySurvei,
            'unitData'    => $unitData
        ];

        return view('admin/dashboard', $data);
    }

    // Tambahkan method ini di dalam Class Dashboard
    public function getUpdates()
    {
        if (!session()->get('isLoggedIn')) {
            return $this->response->setStatusCode(401);
        }

        $db = \Config\Database::connect();

        // 1. Hitung Ulang Stats
        $totalSurvei = $db->table('trans_responden')->countAll();
        $totalUnit   = $db->table('ref_jenis_layanan')->where('is_active', 1)->countAllResults();
        $todaySurvei = $db->table('trans_responden')
            ->where('DATE(tanggal_survei)', date('Y-m-d'))
            ->countAllResults();

        // 2. Hitung Ulang Unit Data (Copy logic dari index, atau extract ke private method)
        // Agar ringkas, saya asumsikan logic perhitungan sama persis dengan index()
        // ... (MASUKKAN LOGIKA PERHITUNGAN IKM DI SINI SEPERTI DI FUNCTION INDEX) ...

        // --- MULAI COPY LOGIC PERHITUNGAN DARI INDEX() ---
        $units = $db->table('ref_jenis_layanan')->where('is_active', 1)->get()->getResult();
        $unitData = [];
        foreach ($units as $unit) {
            $respondenQuery = $db->table('trans_responden')->select('id')->where('jenis_layanan_id', $unit->id)->get();
            $respondenIds = array_column($respondenQuery->getResultArray(), 'id');
            $totalResponden = count($respondenIds);

            $ikmScore = 0;
            $mutu = '-';
            $ket = 'Belum ada data';

            if ($totalResponden > 0) {
                $unsurAvgs = $db->table('trans_detail_jawaban')
                    ->select('ref_soal.unsur_id, AVG(trans_detail_jawaban.nilai_skor) as avg_skor')
                    ->join('ref_soal', 'ref_soal.id = trans_detail_jawaban.soal_id')
                    ->whereIn('trans_detail_jawaban.responden_id', $respondenIds)
                    ->groupBy('ref_soal.unsur_id')
                    ->get()->getResult();

                $sumAvg = 0;
                foreach ($unsurAvgs as $row) $sumAvg += $row->avg_skor;
                $ikmScore = ($sumAvg / 9) * 25; // Fixed divisor 9

                if ($ikmScore >= 88.31) {
                    $mutu = 'A';
                    $ket = 'Sangat Baik';
                } elseif ($ikmScore >= 76.61) {
                    $mutu = 'B';
                    $ket = 'Baik';
                } elseif ($ikmScore >= 65.00) {
                    $mutu = 'C';
                    $ket = 'Kurang Baik';
                } else {
                    $mutu = 'D';
                    $ket = 'Tidak Baik';
                }
            }

            $unitData[] = [
                'nama_layanan' => $unit->nama_layanan,
                'total_responden' => $totalResponden,
                'ikm_score' => number_format($ikmScore, 2),
                'mutu' => $mutu,
                'ket' => $ket,
            ];
        }
        // --- SELESAI COPY LOGIC ---

        // 3. Render Partial View menjadi HTML String
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
