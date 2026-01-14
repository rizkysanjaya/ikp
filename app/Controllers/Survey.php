<?php

namespace App\Controllers;

class Survey extends BaseController
{
    public function index($slug = null)
    {
        if ($slug === null) {
            return redirect()->to('/');
        }

        // Format the slug to a readable title (e.g., "sistem-informasi" -> "Sistem Informasi")
        $unitName = ucwords(str_replace('-', ' ', $slug));

        $data = [
            'slug' => $slug,
            'title' => 'Survei Kepuasan - ' . $unitName,
            'unit_name' => $unitName,
            // These questions will eventually come from the database based on $slug
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

    public function submit()
    {
        // Logic to save to database will go here
        // $data = $this->request->getPost();

        return redirect()->to('/')->with('message', 'Terima kasih, survei Anda telah berhasil dikirim.');
    }
}
