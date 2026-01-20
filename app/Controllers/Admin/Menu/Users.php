<?php

namespace App\Controllers\Admin\Menu;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data = [
            'title' => 'Manajemen User',
            'users' => $model->orderBy('created_at', 'DESC')->findAll()
        ];

        return view('admin/menu/users', $data);
    }

    public function save()
    {
        $model = new UserModel();
        $id = $this->request->getPost('id');

        $rules = [
            'name'     => 'required',
            'email'    => 'required|valid_email|is_unique[users.email,id,' . ($id ?? 0) . ']',
            'username' => 'required|is_unique[users.username,id,' . ($id ?? 0) . ']',
        ];

        // Password validation: required only for new users
        if (empty($id)) {
            $rules['password'] = 'required|min_length[6]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
        ];

        // Only update password if input is not empty
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if (!empty($id)) {
            $model->update($id, $data);
            $message = 'User berhasil diperbarui.';
        } else {
            $model->insert($data);
            $message = 'User baru berhasil ditambahkan.';
        }

        return redirect()->to('admin/users')->with('success', $message);
    }

    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);
        return redirect()->to('admin/users')->with('success', 'User berhasil dihapus.');
    }
}
