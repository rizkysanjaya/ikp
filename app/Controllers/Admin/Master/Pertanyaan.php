<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\BaseController;
use App\Models\RefPertanyaanModel;
use App\Models\RefJenisLayananModel;
use App\Models\RefUnsurPelayananModel;

class Pertanyaan extends BaseController
{
    public function index()
    {
        $model = new RefPertanyaanModel();
        $layananModel = new RefJenisLayananModel();
        $unsurModel = new RefUnsurPelayananModel();

        // Fetch questions with related data
        $questions = $model->select('ref_soal.*, ref_jenis_layanan.nama_layanan, ref_unsur_pelayanan.nama_unsur, ref_unsur_pelayanan.kode_unsur')
            ->join('ref_jenis_layanan', 'ref_jenis_layanan.id = ref_soal.jenis_layanan_id')
            ->join('ref_unsur_pelayanan', 'ref_unsur_pelayanan.id = ref_soal.unsur_id')
            ->orderBy('ref_jenis_layanan.id', 'ASC')
            ->orderBy('ref_soal.id', 'ASC')
            ->findAll();

        $data = [
            'title' => 'Master Pertanyaan Survei',
            'questions' => $questions,
            'layanan' => $layananModel->where('is_active', 1)->findAll(),
            'unsur' => $unsurModel->findAll()
        ];

        return view('admin/menu/master/pertanyaan', $data);
    }

    public function save()
    {
        $model = new RefPertanyaanModel();
        $id = $this->request->getPost('id');

        if (!$this->validate([
            'jenis_layanan_id' => 'required',
            'unsur_id' => 'required',
            'pertanyaan' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'jenis_layanan_id' => $this->request->getPost('jenis_layanan_id'),
            'unsur_id' => $this->request->getPost('unsur_id'),
            'pertanyaan' => $this->request->getPost('pertanyaan'),
            'is_active' => 1
        ];

        if (!empty($id)) {
            $model->update($id, $data);
            $message = 'Pertanyaan berhasil diperbarui.';
        } else {
            $model->insert($data);
            $message = 'Pertanyaan baru berhasil ditambahkan.';
        }

        return redirect()->to('admin/master/pertanyaan')->with('success', $message);
    }

    public function toggle($id)
    {
        $model = new RefPertanyaanModel();
        $item = $model->find($id);

        if ($item) {
            $newStatus = $item->is_active == 1 ? 0 : 1;
            $model->update($id, ['is_active' => $newStatus]);
            $statusText = $newStatus == 1 ? 'diaktifkan' : 'dinonaktifkan';
            return redirect()->to('admin/master/pertanyaan')->with('success', "Pertanyaan berhasil $statusText.");
        }

        return redirect()->to('admin/master/pertanyaan')->with('errors', ['Data tidak ditemukan.']);
    }

    public function delete($id)
    {
        $model = new RefPertanyaanModel();
        $model->delete($id);
        return redirect()->to('admin/master/pertanyaan')->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
