<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\BaseController;
use App\Models\RefInstansiModel;

class Instansi extends BaseController
{
    public function index()
    {
        $model = new RefInstansiModel();
        // Fetch all data for client-side pagination/search
        $instansi = $model->orderBy('id', 'ASC')->findAll();

        $data = [
            'title' => 'Master Data Instansi',
            'instansi' => $instansi,
        ];

        return view('admin/menu/master/instansi', $data);
    }

    public function save()
    {
        $model = new RefInstansiModel();
        $originalId = $this->request->getPost('original_id');
        $id = $this->request->getPost('id');

        $rules = [
            'nama_instansi' => 'required',
        ];

        if (empty($originalId)) {
            $rules['id'] = 'required|is_unique[ref_instansi.id]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if (!empty($originalId)) {
            $model->update($originalId, [
                'nama_instansi' => $this->request->getPost('nama_instansi')
            ]);
            $message = 'Data instansi berhasil diperbarui.';
        } else {
            $model->insert([
                'id' => $id,
                'nama_instansi' => $this->request->getPost('nama_instansi'),
                'is_active' => 1
            ]);
            $message = 'Data instansi baru berhasil ditambahkan.';
        }

        return redirect()->to('admin/master/instansi')->with('success', $message);
    }

    public function toggle($id)
    {
        $model = new RefInstansiModel();
        $item = $model->find($id);

        if ($item) {
            $newStatus = $item->is_active == 1 ? 0 : 1;
            $model->update($id, ['is_active' => $newStatus]);
            $statusText = $newStatus == 1 ? 'diaktifkan' : 'dinonaktifkan';
            return redirect()->to('admin/master/instansi')->with('success', "Data instansi berhasil $statusText.");
        }

        return redirect()->to('admin/master/instansi')->with('errors', ['Data tidak ditemukan.']);
    }

    public function delete($id)
    {
        $model = new RefInstansiModel();
        $model->delete($id);
        return redirect()->to('admin/master/instansi')->with('success', 'Data instansi berhasil dihapus.');
    }
}
