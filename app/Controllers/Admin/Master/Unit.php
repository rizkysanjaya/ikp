<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\BaseController;
use App\Models\RefJenisLayananModel;

class Unit extends BaseController
{
    public function index()
    {
        $model = new RefJenisLayananModel();
        $data = [
            'title' => 'Master Unit Layanan',
            'units' => $model->orderBy('kode_layanan', 'ASC')->findAll()
        ];

        return view('admin/menu/master/unit', $data);
    }

    public function save()
    {
        $model = new RefJenisLayananModel();
        $id = $this->request->getPost('id');

        $rules = [
            'kode_layanan' => 'required|is_unique[ref_jenis_layanan.kode_layanan,id,' . ($id ?? 0) . ']',
            'nama_layanan' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'kode_layanan' => $this->request->getPost('kode_layanan'),
            'nama_layanan' => $this->request->getPost('nama_layanan'),
        ];

        if (!empty($id)) {
            $model->update($id, $data);
            $message = 'Unit layanan berhasil diperbarui.';
        } else {
            $data['is_active'] = 1;
            $model->insert($data);
            $message = 'Unit layanan baru berhasil ditambahkan.';
        }

        return redirect()->to('admin/master/unit')->with('success', $message);
    }

    public function toggle($id)
    {
        $model = new RefJenisLayananModel();
        $item = $model->find($id);

        if ($item) {
            $newStatus = $item->is_active == 1 ? 0 : 1;
            $model->update($id, ['is_active' => $newStatus]);
            $statusText = $newStatus == 1 ? 'diaktifkan' : 'dinonaktifkan';
            return redirect()->to('admin/master/unit')->with('success', "Unit layanan berhasil $statusText.");
        }

        return redirect()->to('admin/master/unit')->with('errors', ['Data tidak ditemukan.']);
    }

    public function delete($id)
    {
        $model = new RefJenisLayananModel();
        $model->delete($id);
        return redirect()->to('admin/master/unit')->with('success', 'Unit layanan berhasil dihapus.');
    }
}
