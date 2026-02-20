<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PembinaanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nomor_urut' => 1,
                'pertanyaan' => 'Kesesuaian materi yang disampaikan dengan kebutuhan tugas jabatan',
                'is_active' => 1
            ],
            [
                'nomor_urut' => 2,
                'pertanyaan' => 'Kemampuan narasumber dalam penguasaan materi',
                'is_active' => 1
            ],
            [
                'nomor_urut' => 3,
                'pertanyaan' => 'Kemampuan narasumber dalam sistematika penyajian',
                'is_active' => 1
            ],
            [
                'nomor_urut' => 4,
                'pertanyaan' => 'Ketepatan waktu kehadiran narasumber',
                'is_active' => 1
            ],
            [
                'nomor_urut' => 5,
                'pertanyaan' => 'Penggunaan metode dan alat bantu pembelajaran',
                'is_active' => 1
            ],
            [
                'nomor_urut' => 6,
                'pertanyaan' => 'Empati dan respon terhadap pertanyaan peserta',
                'is_active' => 1
            ],
            [
                'nomor_urut' => 7,
                'pertanyaan' => 'Gaya, sikap, dan perilaku narasumber',
                'is_active' => 1
            ],
            [
                'nomor_urut' => 8,
                'pertanyaan' => 'Pencapaian tujuan pembelajaran',
                'is_active' => 1
            ],
            [
                'nomor_urut' => 9,
                'pertanyaan' => 'Secara umum, bagaimana penilaian Anda terhadap kualitas narasumber?',
                'is_active' => 1
            ],
        ];

        // Using Query Builder
        $this->db->table('ref_pertanyaan_pembinaan')->insertBatch($data);
    }
}
