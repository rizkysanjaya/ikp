<?php

namespace App\Controllers;

use App\Models\RefInstansiModel;
use App\Models\RefPekerjaanModel;
use App\Models\RefPendidikanModel;
use App\Models\RefPertanyaanModel;
use App\Models\RefJawabanModel;
use App\Models\RefJenisLayananModel;

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
        // Logic to save to database will go here
        // $data = $this->request->getPost();

        return redirect()->to('/')->with('message', 'Terima kasih, survei Anda telah berhasil dikirim.');
    }
}
