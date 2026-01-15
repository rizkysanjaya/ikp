<?php

namespace App\Models;

use CodeIgniter\Model;

class RefPertanyaanModel extends Model
{
    protected $table            = 'ref_pertanyaan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['pertanyaan', 'unit', 'is_active'];
    protected $returnType       = 'object';
}
