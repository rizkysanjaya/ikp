<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // Configuration
        $totalRecords = 100;
        
        // Helper Data
        $names = [
            'Budi Santoso', 'Siti Lestari', 'Ahmad Pratama', 'Rina Kusuma', 'Dewi Wijaya', 
            'Joko Sari', 'Agus Hidayat', 'Citra Putri', 'Dian Saputra', 'Eka Wibowo',
            'Fitri Handayani', 'Gita Susanti', 'Hadi Nugroho', 'Indra Rahmawati'
        ];
        
        $suggestions = [
            'good' => [
                'Terima kasih, pelayanan sangat cepat.',
                'Sangat membantu, sukses terus BKN.',
                'Alur pelayanan sudah jelas.',
                'Petugas ramah dan responsif.'
            ],
            'neutral' => [
                'Cukup baik.',
                'Mohon ruang tunggu diperluas.',
                'Parkiran agak penuh.',
                'Respon chat WA mohon dipercepat.'
            ],
            'bad' => [
                'Sistem sering down.',
                'Proses terlalu lama.',
                'Petugas kurang ramah.',
                'Persyaratan berbelit.',
                'Mohon kejelasan status.'
            ]
        ];

        // Valid IDs (must match MasterDataSeeder)
        $layananIds = [1, 2, 3, 4, 5, 6];
        $instansiIds = ['INS-001', 'INS-002', 'INS-003', 'INS-004'];
        $pendidikanIds = ['kp-001', 'kp-002', 'kp-003', 'kp-004', 'kp-005', 'kp-006', 'kp-007'];
        $pekerjaanIds = [1, 2, 3, 4, 5, 6];

        $respDataBatch = [];
        $detailDataBatch = [];

        for ($i = 0; $i < $totalRecords; $i++) {
            // 1. Generate Profile
            $layananId = $layananIds[array_rand($layananIds)];
            
            // Random Date (Last 90 days, Working Hours)
            $date = new \DateTime();
            $daysMinus = rand(0, 90);
            $date->modify("-{$daysMinus} days");
            
            // Adjust for weekend (skip Sat/Sun)
            $dayOfWeek = $date->format('N'); // 1 (Mon) - 7 (Sun)
            if ($dayOfWeek >= 6) {
                $date->modify("-2 days");
            }

            // Set Time (08:00 - 15:30)
            $hour = rand(8, 15);
            $minute = rand(0, 59);
            $date->setTime($hour, $minute);

            // Determine Satisfaction Type (60% Puas, 30% Netral, 10% Kecewa)
            $rand = rand(1, 100);
            if ($rand <= 60) {
                $type = 'good';
            } elseif ($rand <= 90) {
                $type = 'neutral';
            } else {
                $type = 'bad';
            }

            // Generate Suggestion (Some NULL)
            $saran = null;
            if (rand(1, 100) > 30) { // 70% chance of comment
                $saran = $suggestions[$type][array_rand($suggestions[$type])];
            }

            // Prepare Respondent Data
            $respData = [
                'nama_lengkap' => $names[array_rand($names)],
                'tanggal_survei' => $date->format('Y-m-d H:i:s'),
                'jenis_layanan_id' => $layananId,
                'instansi_id' => $instansiIds[array_rand($instansiIds)],
                'pendidikan_id' => $pendidikanIds[array_rand($pendidikanIds)],
                'pekerjaan_id' => $pekerjaanIds[array_rand($pekerjaanIds)],
                'umur' => rand(25, 58),
                'jenis_kelamin' => (rand(0, 1) ? 'L' : 'P'),
                'saran_masukan' => $saran,
                'created_at' => date('Y-m-d H:i:s')
            ];

            // Insert Respondent & Get ID
            $this->db->table('trans_responden')->insert($respData);
            $respondenId = $this->db->insertID();

            // 2. Generate Answers (Logic from V5)
            // Get Questions for this Service
            $questions = $this->db->table('ref_soal')
                ->where('jenis_layanan_id', $layananId)
                ->where('is_active', 1)
                ->get()->getResultArray();

            foreach ($questions as $q) {
                // Determine Score Target
                $score = 4;
                if ($type == 'good') {
                    $score = (rand(1, 100) <= 80) ? 4 : 3;
                } elseif ($type == 'neutral') {
                    $score = (rand(1, 100) <= 60) ? 3 : 4;
                } else {
                    $score = (rand(1, 100) <= 70) ? 2 : rand(1, 3);
                }

                // Find Option ID matching this score
                $option = $this->db->table('ref_opsi_jawaban')
                    ->where('soal_id', $q['id'])
                    ->where('bobot_nilai', $score)
                    ->get()->getRowArray();
                
                if ($option) {
                    $detailDataBatch[] = [
                        'responden_id' => $respondenId,
                        'soal_id' => $q['id'],
                        'opsi_jawaban_id' => $option['id'],
                        'nilai_skor' => $score
                    ];
                }
            }
        }

        // Batch Insert Details (Efficient)
        foreach (array_chunk($detailDataBatch, 1000) as $chunk) {
            $this->db->table('trans_detail_jawaban')->insertBatch($chunk);
        }
    }
}
