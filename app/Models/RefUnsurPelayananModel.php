<?php

namespace App\Models;

use CodeIgniter\Model;

class RefUnsurPelayananModel extends Model
{
    protected $table            = 'ref_unsur_pelayanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['kode_unsur', 'nama_unsur'];
}
