<?php

namespace App\Controllers;

use App\Models\RefInstansiModel;
use App\Models\RefPekerjaanModel;
use App\Models\RefPendidikanModel;

class Survey extends BaseController
{
    public function index($slug = null)
    {
        // If slug is 'index' (default) or null, redirect home
        if ($slug === null || $slug === 'index') {
            return redirect()->to('/');
        }

        // Format the slug to a readable title (e.g., "sistem-informasi" -> "Sistem Informasi")
        $unitName = ucwords(str_replace('-', ' ', $slug));

        $unitMap = [
            'sidigi' => 'Sistem Informasi dan Digitalisasi',
            'mutasi' => 'Pengangkatan dan Mutasi',
            'status' => 'Status dan Pemberhentian',
            'manajemen' => 'Pembinaan Manajemen ASN',
            'pengawasan' => 'Pengawasan dan Pengendalian',
            'narasumber' => 'Narasumber',
        ];

        if (array_key_exists($slug, $unitMap)) {
            $unitName = $unitMap[$slug];
        }

        // Load models
        $pendidikanModel = new RefPendidikanModel();
        $instansiModel = new RefInstansiModel();
        $pekerjaanModel = new RefPekerjaanModel();

        $data = [
            'slug' => $slug,
            'title' => 'Survei Kepuasan - ' . $unitName,
            'unit_name' => $unitName,
            'pendidikan' => $pendidikanModel->where('is_active', 1)->orderBy('id', 'ASC')->findAll(),
            'pekerjaan' => $pekerjaanModel->where('is_active', 1)->orderBy('id', 'ASC')->findAll(),
            'questions' => [
                "Bagaimana kesesuaian persyaratan pelayanan dengan jenis pelayanannya?",
                "Bagaimana kemudahan prosedur pelayanan di unit ini?",
                "Bagaimana kecepatan waktu dalam memberikan pelayanan?",
                "Bagaimana kewajaran biaya/tarif dalam pelayanan?",
                "Bagaimana kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan?",
                "Bagaimana kompetensi/kemampuan petugas dalam memberikan pelayanan?",
                "Bagaimana perilaku petugas dalam memberikan pelayanan terkait kesopanan dan keramahan?",
                "Bagaimana kualitas sarana dan prasarana pendukung pelayanan?",
                "Bagaimana penanganan pengaduan saran dan masukan?",
                "Secara keseluruhan, bagaimana tingkat kepuasan Anda terhadap pelayanan ini?"
            ]
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
