<?php

namespace App\Models;

use CodeIgniter\Model;

class RefJenisLayananModel extends Model
{
    protected $table            = 'ref_jenis_layanan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['kode_layanan', 'nama_layanan', 'is_active'];
    protected $returnType       = 'object';
}
