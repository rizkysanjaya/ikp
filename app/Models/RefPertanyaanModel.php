<?php

namespace App\Models;

use CodeIgniter\Model;

class RefPertanyaanModel extends Model
{
    protected $table            = 'ref_soal';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['jenis_layanan_id', 'unsur_id', 'pertanyaan', 'is_active'];
    protected $returnType       = 'object';
}
