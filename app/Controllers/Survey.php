<?php

namespace App\Controllers;

use App\Models\RefInstansiModel;
use App\Models\RefPekerjaanModel;
use App\Models\RefPendidikanModel;
use App\Models\RefPertanyaanModel;
use App\Models\RefJawabanModel;
use App\Models\RefJenisLayananModel;
use App\Models\SurveyRespondenModel;
use App\Models\SurveyJawabanModel;

class Survey extends BaseController
{
    public function index($slug = null)
    {
        // If slug is 'index' (default) or null, redirect home
        if ($slug === null || $slug === 'index') {
            return redirect()->to('/');
        }

        // 1. Map Slug to Kode Layanan
        // You can add other mappings here as needed
        $slugToKodeMap = [
            'sidigi'     => 'KL001',
            'mutasi'     => 'KL002',
            'status'     => 'KL003',
            'manajemen'  => 'KL004',
            'pengawasan' => 'KL005',
            'narasumber' => 'KL006',
        ];

        $kodeLayanan = $slugToKodeMap[$slug] ?? null;

        if (!$kodeLayanan) {
            return redirect()->to('/')->with('error', 'Unit layanan tidak ditemukan.');
        }

        // Load models
        $pendidikanModel = new RefPendidikanModel();
        $instansiModel = new RefInstansiModel();
        $pekerjaanModel = new RefPekerjaanModel();
        $pertanyaanModel = new RefPertanyaanModel();
        $jawabanModel = new RefJawabanModel();
        $jenisLayananModel = new RefJenisLayananModel();

        // 2. Get Layanan Data from DB
        $layanan = $jenisLayananModel->where('kode_layanan', $kodeLayanan)->first();

        if (!$layanan) {
            return redirect()->to('/')->with('error', 'Data layanan belum tersedia.');
        }

        // Check if unit is active
        if ($layanan->is_active == 0) {
            return view('survey/unavailable');
        }

        $unitName = $layanan->nama_layanan;

        // 3. Fetch questions based on jenis_layanan_id
        $questions = $pertanyaanModel->where('jenis_layanan_id', $layanan->id)
            ->where('is_active', 1)
            ->orderBy('id', 'ASC')
            ->findAll();

        // 4. Fetch options for these questions
        $questionIds = array_column($questions, 'id');
        $optionsMap = [];

        if (!empty($questionIds)) {
            // Note: Using 'soal_id' and 'bobot_nilai' based on your RefJawabanModel
            $options = $jawabanModel->whereIn('soal_id', $questionIds)->orderBy('bobot_nilai', 'ASC')->findAll();
            foreach ($options as $opt) {
                $optionsMap[$opt->soal_id][] = $opt;
            }
        }

        // 3. Attach options to each question object
        foreach ($questions as $q) {
            $q->options = $optionsMap[$q->id] ?? [];
        }

        $data = [
            'slug' => $slug,
            'title' => 'Survei Kepuasan - ' . $unitName,
            'unit_name' => $unitName,
            'pendidikan' => $pendidikanModel->where('is_active', 1)->orderBy('id', 'ASC')->findAll(),
            'pekerjaan' => $pekerjaanModel->where('is_active', 1)->orderBy('id', 'ASC')->findAll(),
            'questions' => $questions
        ];

        return view('survey/form', $data);
    }

    public function getInstansi()
    {
        $instansiModel = new RefInstansiModel();
        $searchTerm = $this->request->getVar('searchTerm');

        if ($searchTerm) {
            $instansi = $instansiModel->like('nama_instansi', $searchTerm)
                ->where('is_active', 1)
                ->findAll(100);
        } else {
            $instansi = $instansiModel->where('is_active', 1)
                ->findAll(100);
        }

        $data = [];
        foreach ($instansi as $row) {
            $data[] = [
                'id'   => $row->id,
                'text' => $row->nama_instansi,
            ];
        }

        return $this->response->setJSON($data);
    }

    public function submit()
    {
        // 1. Validasi Input
        if (!$this->validate([
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'umur'          => 'required|numeric',
            'pendidikan'    => 'required',
            'pekerjaan'     => 'required',
            'instansi'      => 'required',
            'unit_slug'     => 'required',
            'jawaban'       => 'required',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Mohon lengkapi semua isian wajib.');
        }

        // 2. Ambil Data Layanan (untuk mendapatkan ID Layanan)
        $slug = $this->request->getPost('unit_slug');
        $slugToKodeMap = [
            'sidigi'     => 'KL001',
            'mutasi' => 'KL002',
            'status' => 'KL003',
            'manajemen'  => 'KL004',
            'pengawasan' => 'KL005',
            'narasumber' => 'KL006',
        ];
        $kodeLayanan = $slugToKodeMap[$slug] ?? null;

        $jenisLayananModel = new RefJenisLayananModel();
        $layanan = $jenisLayananModel->where('kode_layanan', $kodeLayanan)->first();

        if (!$layanan) {
            return redirect()->back()->with('error', 'Unit layanan tidak valid.');
        }

        // 3. Simpan Data Responden
        $respondenModel = new SurveyRespondenModel();
        $dataResponden = [
            'nama_lengkap'     => $this->request->getPost('nama'),
            'jenis_kelamin'    => $this->request->getPost('jenis_kelamin'),
            'umur'             => $this->request->getPost('umur'),
            'pendidikan_id'    => $this->request->getPost('pendidikan'),
            'pekerjaan_id'     => $this->request->getPost('pekerjaan'),
            'instansi_id'      => $this->request->getPost('instansi'),
            'jenis_layanan_id' => $layanan->id,
            'saran_masukan'    => $this->request->getPost('saran_masukan'),
            'tanggal_survei'   => date('Y-m-d H:i:s')
        ];

        $respondenModel->insert($dataResponden);
        $respondenId = $respondenModel->getInsertID();

        // 4. Simpan Jawaban Survei
        $jawabanModel = new SurveyJawabanModel();
        $refJawabanModel = new RefJawabanModel();

        $jawaban = $this->request->getPost('jawaban'); // Array [soal_id => opsi_jawaban_id]
        $dataJawaban = [];

        if (is_array($jawaban)) {
            foreach ($jawaban as $soalId => $opsiId) {
                // Lookup score based on option ID
                $opsi = $refJawabanModel->find($opsiId);
                if ($opsi) {
                    $dataJawaban[] = [
                        'responden_id'    => $respondenId,
                        'soal_id'         => $soalId,
                        'opsi_jawaban_id' => $opsiId,
                        'nilai_skor'      => $opsi->bobot_nilai
                    ];
                }
            }
            if (!empty($dataJawaban)) $jawabanModel->insertBatch($dataJawaban);
        }

        // 5. Tampilkan Halaman Sukses
        return view('survey/success');
    }
}
