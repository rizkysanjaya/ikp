<?php

namespace App\Controllers;

use App\Models\RefPertanyaanPembinaanModel;
use App\Models\TransRespondenPembinaanModel;
use App\Models\TransJawabanPembinaanModel;
use App\Models\RefInstansiModel; // Added this line

class Pembinaan extends BaseController
{
    public function index()
    {
        // 1. Fetch Questions
        $pertanyaanModel = new RefPertanyaanPembinaanModel();
        $instansiModel = new RefInstansiModel(); // Added this line

        $questions = $pertanyaanModel->where('is_active', 1)
            ->orderBy('nomor_urut', 'ASC')
            ->findAll();
        
        $instansi = $instansiModel->orderBy('nama_instansi', 'ASC')->findAll(); // Added this line

        $selectedUnit = $this->request->getGet('unit'); // Get 'unit' from URL

        // Enforce Unit Selection
        if (!$selectedUnit) {
            return redirect()->to(base_url('/#unit-layanan'))->with('error', 'Silakan pilih unit layanan terlebih dahulu.');
        }

        $data = [
            'title' => 'Survei Pembinaan Kepegawaian',
            'questions' => $questions,
            'instansi' => $instansi, // Added this line
            'selected_unit' => $selectedUnit // Pass to view
        ];

        return view('pembinaan/form', $data);
    }

    public function submit()
    {
        // 1. Validation
        if (!$this->validate([
            'unit_kerja_terkait'  => 'required',
            'tema_kegiatan'       => 'required',
            'tanggal_pelaksanaan' => 'required|valid_date',
            'tempat_pelaksanaan'  => 'required',
            'metode_penyampaian'  => 'required',
            'kelompok_usia'       => 'required',
            'jenis_kelamin'       => 'required',
            'pendidikan_terakhir' => 'required',
            'jawaban'             => 'required'
            // instansi_id or nama_instansi are handled via conditional check or frontend required
        ])) {
            return redirect()->back()->withInput()->with('error', 'Mohon lengkapi semua isian wajib.');
        }

        // 2. Save Respondent Data
        $respondenModel = new TransRespondenPembinaanModel();
        $dataResponden = [
            'nama_lengkap'        => $this->request->getPost('nama_lengkap'), // Manual Input
            'instansi_terpilih'   => $this->request->getPost('instansi_id'),   // Dropdown Selection
            'unit_kerja_terkait'  => $this->request->getPost('unit_kerja_terkait'),
            'tema_kegiatan'       => $this->request->getPost('tema_kegiatan'),
            'tanggal_pelaksanaan' => $this->request->getPost('tanggal_pelaksanaan'),
            'tempat_pelaksanaan'  => $this->request->getPost('tempat_pelaksanaan'),
            'metode_penyampaian'  => $this->request->getPost('metode_penyampaian'),
            'kelompok_usia'       => $this->request->getPost('kelompok_usia'),
            'jenis_kelamin'       => $this->request->getPost('jenis_kelamin'),
            'pendidikan_terakhir' => $this->request->getPost('pendidikan_terakhir'),
            'saran_masukan'       => $this->request->getPost('saran_masukan'),
            'tanggal_survei'      => date('Y-m-d H:i:s')
        ];

        $respondenModel->insert($dataResponden);
        $respondenId = $respondenModel->getInsertID();

        // 3. Save Answers
        $jawabanModel = new TransJawabanPembinaanModel();
        $jawaban = $this->request->getPost('jawaban'); // Array [soal_id => skor]
        $dataJawaban = [];

        if (is_array($jawaban)) {
            foreach ($jawaban as $soalId => $skor) {
                $dataJawaban[] = [
                    'responden_pembinaan_id'  => $respondenId,
                    'pertanyaan_pembinaan_id' => $soalId,
                    'skor_jawaban'            => $skor
                ];
            }
            if (!empty($dataJawaban)) $jawabanModel->insertBatch($dataJawaban);
        }

        // 4. Show Success
        return view('survey/success'); // Reuse existing success page
    }
}
