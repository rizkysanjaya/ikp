<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\BaseController;
use App\Models\RefJawabanModel;
use App\Models\RefPertanyaanModel;

class Jawaban extends BaseController
{
    public function index()
    {
        $model = new RefJawabanModel();
        $pertanyaanModel = new RefPertanyaanModel();

        // Fetch answers with related question data
        $jawaban = $model->select('ref_opsi_jawaban.*, ref_soal.pertanyaan')
            ->join('ref_soal', 'ref_soal.id = ref_opsi_jawaban.soal_id')
            ->orderBy('ref_soal.id', 'ASC')
            ->orderBy('ref_opsi_jawaban.bobot_nilai', 'DESC')
            ->findAll();

        // Fetch questions with unit info for dropdown
        $questions = $pertanyaanModel->select('ref_soal.id, ref_soal.pertanyaan, ref_jenis_layanan.nama_layanan, ref_unsur_pelayanan.nama_unsur')
            ->join('ref_jenis_layanan', 'ref_jenis_layanan.id = ref_soal.jenis_layanan_id')
            ->join('ref_unsur_pelayanan', 'ref_unsur_pelayanan.id = ref_soal.unsur_id')
            ->where('ref_soal.is_active', 1)
            ->orderBy('ref_jenis_layanan.id', 'ASC')
            ->orderBy('ref_soal.id', 'ASC')
            ->findAll();

        $data = [
            'title' => 'Master Opsi Jawaban',
            'jawaban' => $jawaban,
            'pertanyaan' => $questions
        ];

        return view('admin/menu/master/jawaban', $data);
    }

    public function save()
    {
        $model = new RefJawabanModel();
        $id = $this->request->getPost('id');

        if (!$this->validate([
            'soal_id' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Pertanyaan wajib dipilih.']
            ],
            'label_jawaban' => [
                'rules'  => 'required|max_length[255]',
                'errors' => [
                    'required'   => 'Label jawaban wajib diisi.',
                    'max_length' => 'Label jawaban maksimal 255 karakter.'
                ]
            ],
            'bobot_nilai' => [
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Bobot nilai wajib diisi.',
                    'numeric'  => 'Bobot nilai harus berupa angka.'
                ]
            ],
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'soal_id' => $this->request->getPost('soal_id'),
            'label_jawaban' => $this->request->getPost('label_jawaban'),
            'bobot_nilai' => $this->request->getPost('bobot_nilai'),
        ];

        if (!empty($id)) {
            $model->update($id, $data);
            $message = 'Opsi jawaban berhasil diperbarui.';
        } else {
            $model->insert($data);
            $message = 'Opsi jawaban baru berhasil ditambahkan.';
        }

        return redirect()->to('admin/master/jawaban')->with('success', $message);
    }

    public function delete($id)
    {
        $model = new RefJawabanModel();
        $model->delete($id);
        return redirect()->to('admin/master/jawaban')->with('success', 'Opsi jawaban berhasil dihapus.');
    }
}
