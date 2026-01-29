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

        // 1. Get Layanan Data (Dynamic Lookup)
        $layanan = $this->getLayananBySlug($slug);

        if (!$layanan) {
            return redirect()->to('/')->with('error', 'Unit layanan tidak ditemukan.');
        }

        // Load models
        $pendidikanModel = new RefPendidikanModel();
        $instansiModel = new RefInstansiModel();
        $pekerjaanModel = new RefPekerjaanModel();
        $pertanyaanModel = new RefPertanyaanModel();
        $jawabanModel = new RefJawabanModel();
        // RefJenisLayananModel already used in helper

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
        $layanan = $this->getLayananBySlug($slug);

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

    /**
     * Helper to find layanan by Slug (Kode Layanan) or Name
     * Matches Kode Layanan (exact) or Nama Layanan (slugified)
     */
    private function getLayananBySlug($slug)
    {
        $jenisLayananModel = new RefJenisLayananModel();
        
        // 1. Try finding by Kode Layanan (e.g. KL001)
        $layanan = $jenisLayananModel->where('kode_layanan', $slug)->first();
        if ($layanan) return $layanan;

        // 2. Try finding by Name (e.g. 'sidigi' matches 'Sistem Informasi dan Digitalisasi')
        // We have to iterate because we don't have a slug column
        $allLayanan = $jenisLayananModel->where('is_active', 1)->findAll();
        foreach ($allLayanan as $item) {
            // Using url_title to generate slug from name (e.g. 'Sistem Informasi' -> 'sistem-informasi')
            // Then removing '-' to support 'sisteminformasi' or just 'sidigi' if close? 
            // Actually, let's stick to url_title standard
            $generatedSlug = url_title($item->nama_layanan, '-', true);
            if ($generatedSlug === $slug) {
                return $item;
            }
        }
        
        // 3. Fallback: check if slug is contained in the name (e.g. 'sidigi' might be a manual shortname not in DB?)
        // The previous hardcoded map mapped 'sidigi' => 'KL001'.
        // To support 'sidigi' without hardcoding, the user must update the unit name or code.
        // OR we just support exact code and exact standard slug. 
        // For 'sidigi', if 'KL001' is capable of being accessed via 'sidigi', the system won't know unless 'sidigi' is in the name.
        // Let's assume the user will access via 'KL001' or 'sistem-informasi-dan-digitalisasi'.
        
        return null;
    }
}
