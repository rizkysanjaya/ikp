<?php

namespace App\Models;

use CodeIgniter\Model;

class RefPekerjaanModel extends Model
{
    protected $table            = 'ref_pekerjaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_pekerjaan', 'is_active'];
}
