<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    public function run()
    {
        // 1. ref_instansi (Sample, as original dump had empty logic for this usually, but we add default)
        $this->db->table('ref_instansi')->ignore(true)->insertBatch([
            ['id' => 'INS-001', 'nama_instansi' => 'Badan Kepegawaian Negara', 'is_active' => 1],
            ['id' => 'INS-002', 'nama_instansi' => 'Kementerian Dalam Negeri', 'is_active' => 1],
            ['id' => 'INS-003', 'nama_instansi' => 'Pemerintah Provinsi Jawa Barat', 'is_active' => 1],
            ['id' => 'INS-004', 'nama_instansi' => 'Pemerintah Kota Bandung', 'is_active' => 1],
        ]);

        // 2. ref_jenis_layanan (Matching existing IDs in landing page)
        $this->db->table('ref_jenis_layanan')->ignore(true)->insertBatch([
            ['id' => 1, 'kode_layanan' => 'KL001', 'nama_layanan' => 'Sistem Informasi dan Digitalisasi Data Kepegawaian', 'is_active' => 1],
            ['id' => 2, 'kode_layanan' => 'KL002', 'nama_layanan' => 'Pengangkatan CPNS/PNS dan Mutasi Lainnya', 'is_active' => 1],
            ['id' => 3, 'kode_layanan' => 'KL003', 'nama_layanan' => 'Status Kepegawaian, Pemberhentian, dan Pensiun', 'is_active' => 1],
            ['id' => 4, 'kode_layanan' => 'KL004', 'nama_layanan' => 'Pengembangan Kompetensi, Penilaian Kinerja, dan Disiplin', 'is_active' => 1],
            ['id' => 5, 'kode_layanan' => 'KL005', 'nama_layanan' => 'Pengawasan dan Pengendalian Norma, Standar, Prosedur, dan Kriteria', 'is_active' => 1],
            ['id' => 6, 'kode_layanan' => 'KL006', 'nama_layanan' => 'Fasilitasi Kinerja', 'is_active' => 1],
        ]);

        // 3. ref_pekerjaan
        $this->db->table('ref_pekerjaan')->ignore(true)->insertBatch([
            ['id' => 1, 'nama_pekerjaan' => 'PNS', 'is_active' => 1],
            ['id' => 2, 'nama_pekerjaan' => 'TNI/POLRI', 'is_active' => 1],
            ['id' => 3, 'nama_pekerjaan' => 'Pegawai Swasta', 'is_active' => 1],
            ['id' => 4, 'nama_pekerjaan' => 'Wiraswasta/Usahawan', 'is_active' => 1],
            ['id' => 5, 'nama_pekerjaan' => 'Pelajar/Mahasiswa', 'is_active' => 1],
            ['id' => 6, 'nama_pekerjaan' => 'Lainnya', 'is_active' => 1],
        ]);

        // 4. ref_pendidikan
        $this->db->table('ref_pendidikan')->ignore(true)->insertBatch([
            ['id' => 'kp-001', 'nama_pendidikan' => 'SD / Sederajat', 'is_active' => 1],
            ['id' => 'kp-002', 'nama_pendidikan' => 'SMP / Sederajat', 'is_active' => 1],
            ['id' => 'kp-003', 'nama_pendidikan' => 'SMA / Sederajat', 'is_active' => 1],
            ['id' => 'kp-004', 'nama_pendidikan' => 'D3', 'is_active' => 1],
            ['id' => 'kp-005', 'nama_pendidikan' => 'S1 / D4', 'is_active' => 1],
            ['id' => 'kp-006', 'nama_pendidikan' => 'S2', 'is_active' => 1],
            ['id' => 'kp-007', 'nama_pendidikan' => 'S3', 'is_active' => 1],
        ]);

        // 5. ref_unsur_pelayanan (SKM Standards)
        $this->db->table('ref_unsur_pelayanan')->ignore(true)->insertBatch([
            ['id' => 1, 'kode_unsur' => 'U1', 'nama_unsur' => 'Persyaratan'],
            ['id' => 2, 'kode_unsur' => 'U2', 'nama_unsur' => 'Sistem, Mekanisme, dan Prosedur'],
            ['id' => 3, 'kode_unsur' => 'U3', 'nama_unsur' => 'Waktu Penyelesaian'],
            ['id' => 4, 'kode_unsur' => 'U4', 'nama_unsur' => 'Biaya / Tarif'],
            ['id' => 5, 'kode_unsur' => 'U5', 'nama_unsur' => 'Produk Spesifikasi Jenis Pelayanan'],
            ['id' => 6, 'kode_unsur' => 'U6', 'nama_unsur' => 'Kompetensi Pelaksana'],
            ['id' => 7, 'kode_unsur' => 'U7', 'nama_unsur' => 'Perilaku Pelaksana'],
            ['id' => 8, 'kode_unsur' => 'U8', 'nama_unsur' => 'Penanganan Pengaduan, Saran dan Masukan'],
            ['id' => 9, 'kode_unsur' => 'U9', 'nama_unsur' => 'Sarana dan Prasarana'],
        ]);

        // 6. ref_soal (Generic Set for all 6 Services - 9 Questions each based on elements)
        // Creating 54 Questions (9 elements * 6 services)
        $soalData = [];
        $unsurMap = [
            1 => 'Bagaimana pendapat saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya?',
            2 => 'Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di unit ini?',
            3 => 'Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan?',
            4 => 'Bagaimana pendapat Saudara tentang kewajaran biaya/tarif dalam pelayanan? (Gratis jika berlaku)',
            5 => 'Bagaimana pendapat Saudara tentang kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan?',
            6 => 'Bagaimana pendapat Saudara tentang kompetensi/kemampuan petugas dalam pelayanan?',
            7 => 'Bagaimana pendapat saudara perilaku petugas dalam pelayanan terkait kesopanan dan keramahan?',
            8 => 'Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana?',
            9 => 'Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan?',
        ];

        $idCounter = 1;
        for ($layanan = 1; $layanan <= 6; $layanan++) {
            foreach ($unsurMap as $unsurId => $pertanyaan) {
                $soalData[] = [
                    'id' => $idCounter++,
                    'jenis_layanan_id' => $layanan,
                    'unsur_id' => $unsurId,
                    'pertanyaan' => $pertanyaan,
                    'urutan' => $unsurId,
                    'is_active' => 1
                ];
            }
        }
        $this->db->table('ref_soal')->ignore(true)->insertBatch($soalData);

        // 7. ref_opsi_jawaban (4 options for each question)
        // Total 216 options (54 questions * 4 options)
        // Using efficient chunk insert
        $opsiData = [];
        $opsiCounter = 1;
        foreach ($soalData as $soal) {
            $opsiData[] = ['id' => $opsiCounter++, 'soal_id' => $soal['id'], 'label_jawaban' => 'Sangat Baik / Sangat Sesuai', 'bobot_nilai' => 4];
            $opsiData[] = ['id' => $opsiCounter++, 'soal_id' => $soal['id'], 'label_jawaban' => 'Baik / Sesuai', 'bobot_nilai' => 3];
            $opsiData[] = ['id' => $opsiCounter++, 'soal_id' => $soal['id'], 'label_jawaban' => 'Kurang Baik / Kurang Sesuai', 'bobot_nilai' => 2];
            $opsiData[] = ['id' => $opsiCounter++, 'soal_id' => $soal['id'], 'label_jawaban' => 'Tidak Baik / Tidak Sesuai', 'bobot_nilai' => 1];
        }
        
        // Split into chunks to avoid query limits
        foreach (array_chunk($opsiData, 500) as $chunk) {
            $this->db->table('ref_opsi_jawaban')->ignore(true)->insertBatch($chunk);
        }

        // 8. Default User
        $this->db->table('users')->ignore(true)->insert([
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_BCRYPT),
            'name' => 'Administrator',
            'email' => 'admin@bkn.go.id',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
