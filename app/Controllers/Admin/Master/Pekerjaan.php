<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\BaseController;
use App\Models\RefPekerjaanModel;

class Pekerjaan extends BaseController
{
    public function index()
    {
        $model = new RefPekerjaanModel();
        $data = [
            'title' => 'Master Data Pekerjaan',
            'pekerjaan' => $model->orderBy('id', 'ASC')->findAll()
        ];

        return view('admin/menu/master/pekerjaan', $data);
    }

    public function save()
    {
        $model = new RefPekerjaanModel();
        $id = $this->request->getPost('id');

        if (!$this->validate([
            'nama_pekerjaan' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_pekerjaan' => $this->request->getPost('nama_pekerjaan'),
            'is_active'      => 1
        ];

        if (!empty($id)) {
            $model->update($id, $data);
            $message = 'Data pekerjaan berhasil diperbarui.';
        } else {
            $model->insert($data);
            $message = 'Data pekerjaan baru berhasil ditambahkan.';
        }

        return redirect()->to('admin/master/pekerjaan')->with('success', $message);
    }

    public function toggle($id)
    {
        $model = new RefPekerjaanModel();
        $item = $model->find($id);

        if ($item) {
            $newStatus = $item->is_active == 1 ? 0 : 1;
            $model->update($id, ['is_active' => $newStatus]);
            $statusText = $newStatus == 1 ? 'diaktifkan' : 'dinonaktifkan';
            return redirect()->to('admin/master/pekerjaan')->with('success', "Data pekerjaan berhasil $statusText.");
        }

        return redirect()->to('admin/master/pekerjaan')->with('errors', ['Data tidak ditemukan.']);
    }

    public function delete($id)
    {
        $model = new RefPekerjaanModel();
        $model->delete($id);
        return redirect()->to('admin/master/pekerjaan')->with('success', 'Data pekerjaan berhasil dihapus.');
    }
}
