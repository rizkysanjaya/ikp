<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $data = [
            'title'    => 'Dashboard Admin',
            'username' => session()->get('name')
        ];

        return view('admin/dashboard', $data);
    }
}
