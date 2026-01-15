<?php

namespace App\Models;

use CodeIgniter\Model;

class RefInstansiModel extends Model
{
    protected $table            = 'ref_instansi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'nama_instansi', 'is_active'];
}
