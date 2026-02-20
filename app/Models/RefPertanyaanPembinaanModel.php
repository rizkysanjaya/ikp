<?php

namespace App\Models;

use CodeIgniter\Model;

class RefPertanyaanPembinaanModel extends Model
{
    protected $table            = 'ref_pertanyaan_pembinaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['nomor_urut', 'pertanyaan', 'is_active'];
}
