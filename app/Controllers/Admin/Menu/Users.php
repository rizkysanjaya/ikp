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
            'name'     => [
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required'   => 'Nama lengkap wajib diisi.',
                    'max_length' => 'Nama lengkap maksimal 100 karakter.'
                ]
            ],
            'email'    => [
                'rules'  => 'required|valid_email|max_length[100]|is_unique[users.email,id,' . ($id ?? 0) . ']',
                'errors' => [
                    'required'    => 'Email wajib diisi.',
                    'valid_email' => 'Format email tidak valid (contoh: user@bkn.go.id).',
                    'max_length'  => 'Email maksimal 100 karakter.',
                    'is_unique'   => 'Email ini sudah terdaftar, gunakan email lain.'
                ]
            ],
            'username' => [
                'rules'  => 'required|max_length[100]|is_unique[users.username,id,' . ($id ?? 0) . ']',
                'errors' => [
                    'required'   => 'Username wajib diisi.',
                    'max_length' => 'Username maksimal 100 karakter.',
                    'is_unique'  => 'Username ini sudah digunakan.'
                ]
            ],
        ];

        // Password validation
        $passwordInput = $this->request->getPost('password');

        if (empty($id)) {
            // New User: Required
            $rules['password'] = [
                'rules'  => 'required|min_length[8]',
                'errors' => [
                    'required'   => 'Password wajib diisi.',
                    'min_length' => 'Password minimal terdiri dari 8 karakter untuk keamanan.'
                ]
            ];
        } elseif (!empty($passwordInput)) {
            // Update User: Only validate if password is provided
            $rules['password'] = [
                'rules'  => 'min_length[8]',
                'errors' => [
                    'min_length' => 'Password minimal terdiri dari 8 karakter untuk keamanan.'
                ]
            ];
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
