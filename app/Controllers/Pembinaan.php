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
        $instansiModel = new RefInstansiModel();
        $pendidikanModel = new \App\Models\RefPendidikanModel();
        $pekerjaanModel = new \App\Models\RefPekerjaanModel();

        $questions = $pertanyaanModel->where('is_active', 1)
            ->orderBy('nomor_urut', 'ASC')
            ->findAll();
        
        $instansi = $instansiModel->orderBy('nama_instansi', 'ASC')->findAll();
        $pendidikan = $pendidikanModel->where('is_active', 1)->orderBy('id', 'ASC')->findAll();
        $pekerjaan = $pekerjaanModel->where('is_active', 1)->orderBy('nama_pekerjaan', 'ASC')->findAll();

        $selectedUnit = $this->request->getGet('unit'); // Get 'unit' from URL

        // Enforce Unit Selection
        if (!$selectedUnit) {
            return redirect()->to(base_url('/#unit-layanan'))->with('error', 'Silakan pilih unit layanan terlebih dahulu.');
        }

        // Fetch Unit ID
        $layananModel = new \App\Models\RefJenisLayananModel();
        $unitData = $layananModel->where('nama_layanan', $selectedUnit)->first();
        if (!$unitData) {
            return redirect()->to(base_url('/#unit-layanan'))->with('error', 'Unit layanan tidak valid.');
        }

        $data = [
            'title' => 'Survei Pembinaan Kepegawaian',
            'questions' => $questions,
            'instansi' => $instansi,
            'pendidikan' => $pendidikan,
            'pekerjaan' => $pekerjaan,
            'selected_unit' => $selectedUnit, // Pass string for display
            'layanan_id' => is_array($unitData) ? $unitData['id'] : $unitData->id // Pass ID for DB storage
        ];

        return view('pembinaan/form', $data);
    }

    public function submit()
    {
        // 1. Validation
        if (!$this->validate([
            'tema_kegiatan'       => 'required',
            'tanggal_pelaksanaan' => 'required|valid_date',
            'tempat_pelaksanaan'  => 'required',
            'metode_penyampaian'  => 'required',
            'kelompok_usia'       => 'required',
            'jenis_kelamin'       => 'required',
            'pendidikan_id'       => 'required',
            'pekerjaan_id'        => 'required',
            'instansi_id'         => 'required',
            'layanan_id'          => 'required',
            'jawaban'             => 'required'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Mohon lengkapi semua isian wajib.');
        }

        // 2. Save Respondent Data
        $respondenModel = new TransRespondenPembinaanModel();
        $dataResponden = [
            'nama_lengkap'        => $this->request->getPost('nama_lengkap'),
            'instansi_id'         => $this->request->getPost('instansi_id'),
            'layanan_id'          => $this->request->getPost('layanan_id'),
            'tema_kegiatan'       => $this->request->getPost('tema_kegiatan'),
            'tanggal_pelaksanaan' => $this->request->getPost('tanggal_pelaksanaan'),
            'tempat_pelaksanaan'  => $this->request->getPost('tempat_pelaksanaan'),
            'metode_penyampaian'  => $this->request->getPost('metode_penyampaian'),
            'kelompok_usia'       => $this->request->getPost('kelompok_usia'),
            'jenis_kelamin'       => $this->request->getPost('jenis_kelamin'),
            'pendidikan_id'       => $this->request->getPost('pendidikan_id'),
            'pekerjaan_id'        => $this->request->getPost('pekerjaan_id'),
            'saran_masukan'       => $this->request->getPost('saran_masukan'),
            'tanggal_survei'      => date('Y-m-d H:i:s')
        ];

        $respondenModel->insert($dataResponden);
        $respondenId = $respondenModel->getInsertID();

        // 3. Save Answers
        $jawabanModel = new TransJawabanPembinaanModel();
        $jawaban = $this->request->getPost('jawaban'); // Array [soal_id => skor]
        $dataJawaban = [];

        // Pre-fetch generic opsi_jawaban_id mapping
        $db = \Config\Database::connect();
        $opsiQuery = $db->table('ref_opsi_jawaban')
           ->where('soal_id', null)
           ->get()->getResult();
        
        $scoreToOpsiId = [];
        foreach($opsiQuery as $opt) {
            if (!isset($scoreToOpsiId[$opt->bobot_nilai])) {
                 $scoreToOpsiId[$opt->bobot_nilai] = $opt->id;
            }
        }

        if (is_array($jawaban)) {
            foreach ($jawaban as $soalId => $skor) {
                $opsiId = $scoreToOpsiId[$skor] ?? null;

                $dataJawaban[] = [
                    'responden_pembinaan_id'  => $respondenId,
                    'pertanyaan_pembinaan_id' => $soalId,
                    'opsi_jawaban_id'         => $opsiId
                ];
            }
            if (!empty($dataJawaban)) $jawabanModel->insertBatch($dataJawaban);
        }

        // 4. Show Success
        return view('survey/success'); // Reuse existing success page
    }
}
