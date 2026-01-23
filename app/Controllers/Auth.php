<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // If already logged in, redirect to dashboard (we will create dashboard later)
        if (session()->get('isLoggedIn')) {
            return redirect()->to('dashboard');
        }

        $data = [
            'title' => 'Login Administrator'
        ];
        return view('auth/login', $data);
    }

    public function attemptLogin()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // 1. Check if user exists
        $user = $userModel->where('username', $username)->first();

        if ($user) {
            // 2. Verify Password
            if (password_verify((string)$password, $user->password)) {
                $sessData = [
                    'id'        => $user->id,
                    'username'  => $user->username,
                    'name'      => $user->name,
                    'isLoggedIn' => true
                ];
                $session->set($sessData);
                return redirect()->to('dashboard');
            } else {
                return redirect()->back()->withInput()->with('error', 'Password salah.');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Username tidak ditemukan.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
