<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\BaseController;
use App\Models\RefUnsurPelayananModel;

class Unsur extends BaseController
{
    public function index()
    {
        $model = new RefUnsurPelayananModel();
        $data = [
            'title' => 'Master Unsur Pelayanan',
            'unsur' => $model->orderBy('kode_unsur', 'ASC')->findAll()
        ];

        return view('admin/menu/master/unsur', $data);
    }

    public function update()
    {
        $model = new RefUnsurPelayananModel();
        $id = $this->request->getPost('id');

        if (!$this->validate([
            'nama_unsur' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_unsur' => $this->request->getPost('nama_unsur'),
        ];

        $model->update($id, $data);

        return redirect()->to('admin/menu/master/unsur')->with('success', 'Data unsur pelayanan berhasil diperbarui.');
    }
}
