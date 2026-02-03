<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\BaseController;
use App\Models\RefPendidikanModel;

class Pendidikan extends BaseController
{
    public function index()
    {
        $model = new RefPendidikanModel();
        $data = [
            'title' => 'Master Data Pendidikan',
            'pendidikan' => $model->orderBy('id', 'ASC')->findAll()
        ];

        return view('admin/menu/master/pendidikan', $data);
    }

    public function save()
    {
        $model = new RefPendidikanModel();
        $originalId = $this->request->getPost('original_id');
        $id = $this->request->getPost('id');

        $rules = [
            'nama_pendidikan' => [
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required'   => 'Nama tingkat pendidikan wajib diisi.',
                    'max_length' => 'Nama tingkat pendidikan maksimal 100 karakter.'
                ]
            ]
        ];

        // Only validate ID uniqueness if creating a new record
        if (empty($originalId)) {
            $rules['id'] = [
                'rules'  => 'required|max_length[10]|is_unique[ref_pendidikan.id]',
                'errors' => [
                    'required'   => 'Kode pendidikan wajib diisi.',
                    'max_length' => 'Kode pendidikan maksimal 10 karakter.',
                    'is_unique'  => 'Kode pendidikan sudah digunakan.',
                ]
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if (!empty($originalId)) {
            $model->update($originalId, [
                'nama_pendidikan' => $this->request->getPost('nama_pendidikan')
            ]);
            $message = 'Data pendidikan berhasil diperbarui.';
        } else {
            $model->insert([
                'id' => $id,
                'nama_pendidikan' => $this->request->getPost('nama_pendidikan'),
                'is_active' => 1
            ]);
            $message = 'Data pendidikan baru berhasil ditambahkan.';
        }

        return redirect()->to('admin/master/pendidikan')->with('success', $message);
    }

    public function toggle($id)
    {
        $model = new RefPendidikanModel();
        $item = $model->find($id);

        if ($item) {
            $newStatus = $item->is_active == 1 ? 0 : 1;
            $model->update($id, ['is_active' => $newStatus]);
            $statusText = $newStatus == 1 ? 'diaktifkan' : 'dinonaktifkan';
            return redirect()->to('admin/master/pendidikan')->with('success', "Data pendidikan berhasil $statusText.");
        }

        return redirect()->to('admin/master/pendidikan')->with('errors', ['Data tidak ditemukan.']);
    }

    public function delete($id)
    {
        $model = new RefPendidikanModel();
        $model->delete($id);
        return redirect()->to('admin/master/pendidikan')->with('success', 'Data pendidikan berhasil dihapus.');
    }
}
