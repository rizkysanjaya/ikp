<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class ResetPertanyaan extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'reset:pertanyaan';
    protected $description = 'Truncates and reseeds ref_pertanyaan_pembinaan';

    public function run(array $params)
    {
        $db = \Config\Database::connect();
        
        CLI::write('Truncating ref_pertanyaan_pembinaan...', 'yellow');
        $db->table('ref_pertanyaan_pembinaan')->truncate();
        
        CLI::write('Reseeding...', 'yellow');
        // Call the seeder
        $seeder = \Config\Database::seeder();
        $seeder->call('PembinaanSeeder');
        
        CLI::write('Done. Verifying count...', 'green');
        $count = $db->table('ref_pertanyaan_pembinaan')->countAll();
        CLI::write("Total questions: " . $count, 'white');
    }
}
