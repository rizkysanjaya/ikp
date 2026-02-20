<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\RefPertanyaanPembinaanModel;

class CheckPertanyaan extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'check:pertanyaan';
    protected $description = 'Displays all questions in ref_pertanyaan_pembinaan';

    public function run(array $params)
    {
        $model = new RefPertanyaanPembinaanModel();
        $questions = $model->findAll();

        CLI::write('Total Questions: ' . count($questions), 'green');
        
        foreach ($questions as $q) {
            CLI::write("ID: {$q->id} | P{$q->nomor_urut}: {$q->pertanyaan}", 'yellow');
        }
    }
}
