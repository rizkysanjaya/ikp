<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RefPertanyaanPembinaanModel;

class CheckDb extends BaseController
{
    public function index()
    {
        $model = new RefPertanyaanPembinaanModel();
        $questions = $model->findAll();

        echo "<pre>";
        echo "Count: " . count($questions) . "\n";
        print_r($questions);
        echo "</pre>";
    }
}
