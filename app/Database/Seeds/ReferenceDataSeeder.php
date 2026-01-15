<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ReferenceDataSeeder extends Seeder
{
    public function run()
    {
        // ref_jenis_layanan
        $this->db->table('ref_jenis_layanan')->insertBatch([
            ['id' => 1, 'nama_layanan' => 'Layanan Kenaikan Pangkat', 'is_active' => 1],
            ['id' => 2, 'nama_layanan' => 'Layanan Pensiun', 'is_active' => 1],
            ['id' => 3, 'nama_layanan' => 'Layanan Mutasi / Pindah Instansi', 'is_active' => 1],
            ['id' => 4, 'nama_layanan' => 'Layanan Status Kepegawaian', 'is_active' => 1],
        ]);

        // ref_unsur_pelayanan
        $this->db->table('ref_unsur_pelayanan')->insertBatch([
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

        // ref_pekerjaan
        $this->db->table('ref_pekerjaan')->insertBatch([
            ['id' => 1, 'nama_pekerjaan' => 'PNS', 'is_active' => 1],
            ['id' => 2, 'nama_pekerjaan' => 'TNI/POLRI', 'is_active' => 1],
            ['id' => 3, 'nama_pekerjaan' => 'Pegawai Swasta', 'is_active' => 1],
            ['id' => 4, 'nama_pekerjaan' => 'Wiraswasta/Usahawan', 'is_active' => 1],
            ['id' => 5, 'nama_pekerjaan' => 'Pelajar/Mahasiswa', 'is_active' => 1],
        ]);

        // ref_pendidikan
        $this->db->table('ref_pendidikan')->insertBatch([
            ['id' => 'kp-001', 'nama_pendidikan' => 'SD / Sederajat', 'is_active' => 1],
            ['id' => 'kp-002', 'nama_pendidikan' => 'SMP / Sederajat', 'is_active' => 1],
            ['id' => 'kp-003', 'nama_pendidikan' => 'SMA / Sederajat', 'is_active' => 1],
            ['id' => 'kp-004', 'nama_pendidikan' => 'D3', 'is_active' => 1],
            ['id' => 'kp-005', 'nama_pendidikan' => 'S1 / D4', 'is_active' => 1],
            ['id' => 'kp-006', 'nama_pendidikan' => 'S2', 'is_active' => 1],
            ['id' => 'kp-007', 'nama_pendidikan' => 'S3', 'is_active' => 1],
        ]);

        // ref_soal
        $this->db->table('ref_soal')->insertBatch([
            ['id' => 1, 'jenis_layanan_id' => 1, 'unsur_id' => 1, 'pertanyaan' => 'Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya?', 'urutan' => 1, 'is_active' => 1],
            ['id' => 2, 'jenis_layanan_id' => 1, 'unsur_id' => 2, 'pertanyaan' => 'Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di unit ini?', 'urutan' => 2, 'is_active' => 1],
            ['id' => 3, 'jenis_layanan_id' => 1, 'unsur_id' => 3, 'pertanyaan' => 'Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan?', 'urutan' => 3, 'is_active' => 1],
            ['id' => 4, 'jenis_layanan_id' => 2, 'unsur_id' => 1, 'pertanyaan' => 'Apakah persyaratan pengajuan pensiun diinformasikan dengan jelas?', 'urutan' => 1, 'is_active' => 1],
            ['id' => 5, 'jenis_layanan_id' => 2, 'unsur_id' => 3, 'pertanyaan' => 'Apakah SK Pensiun diterima tepat waktu sesuai standar pelayanan?', 'urutan' => 2, 'is_active' => 1],
        ]);

        // ref_opsi_jawaban
        $this->db->table('ref_opsi_jawaban')->insertBatch([
            ['id' => 1, 'soal_id' => 1, 'label_jawaban' => 'Sangat Sesuai', 'bobot_nilai' => 4],
            ['id' => 2, 'soal_id' => 1, 'label_jawaban' => 'Sesuai', 'bobot_nilai' => 3],
            ['id' => 3, 'soal_id' => 1, 'label_jawaban' => 'Kurang Sesuai', 'bobot_nilai' => 2],
            ['id' => 4, 'soal_id' => 1, 'label_jawaban' => 'Tidak Sesuai', 'bobot_nilai' => 1],
            ['id' => 5, 'soal_id' => 2, 'label_jawaban' => 'Sangat Mudah', 'bobot_nilai' => 4],
            ['id' => 6, 'soal_id' => 2, 'label_jawaban' => 'Mudah', 'bobot_nilai' => 3],
            ['id' => 7, 'soal_id' => 2, 'label_jawaban' => 'Kurang Mudah', 'bobot_nilai' => 2],
            ['id' => 8, 'soal_id' => 2, 'label_jawaban' => 'Tidak Mudah', 'bobot_nilai' => 1],
            ['id' => 9, 'soal_id' => 3, 'label_jawaban' => 'Sangat Cepat', 'bobot_nilai' => 4],
            ['id' => 10, 'soal_id' => 3, 'label_jawaban' => 'Cepat', 'bobot_nilai' => 3],
            ['id' => 11, 'soal_id' => 3, 'label_jawaban' => 'Kurang Cepat', 'bobot_nilai' => 2],
            ['id' => 12, 'soal_id' => 3, 'label_jawaban' => 'Tidak Cepat', 'bobot_nilai' => 1],
            ['id' => 13, 'soal_id' => 4, 'label_jawaban' => 'Sangat Jelas', 'bobot_nilai' => 4],
            ['id' => 14, 'soal_id' => 4, 'label_jawaban' => 'Jelas', 'bobot_nilai' => 3],
            ['id' => 15, 'soal_id' => 4, 'label_jawaban' => 'Kurang Jelas', 'bobot_nilai' => 2],
            ['id' => 16, 'soal_id' => 4, 'label_jawaban' => 'Tidak Jelas', 'bobot_nilai' => 1],
            ['id' => 17, 'soal_id' => 5, 'label_jawaban' => 'Tepat Waktu', 'bobot_nilai' => 4],
            ['id' => 18, 'soal_id' => 5, 'label_jawaban' => 'Cukup Tepat', 'bobot_nilai' => 3],
            ['id' => 19, 'soal_id' => 5, 'label_jawaban' => 'Terlambat', 'bobot_nilai' => 2],
            ['id' => 20, 'soal_id' => 5, 'label_jawaban' => 'Sangat Terlambat', 'bobot_nilai' => 1],
        ]);
    }
}
