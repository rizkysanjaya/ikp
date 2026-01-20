<?php

namespace App\Controllers\Admin\Menu;

use App\Controllers\BaseController;

class About extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Tentang Aplikasi',
        ];

        return view('admin/menu/about', $data);
    }
}
