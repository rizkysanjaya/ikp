<?php

namespace App\Models;

use CodeIgniter\Model;

class RefPendidikanModel extends Model
{
    protected $table            = 'ref_pendidikan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'nama_pendidikan', 'is_active'];
}
