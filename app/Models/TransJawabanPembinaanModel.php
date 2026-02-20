<?php

namespace App\Models;

use CodeIgniter\Model;

class TransJawabanPembinaanModel extends Model
{
    protected $table            = 'trans_jawaban_pembinaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['responden_pembinaan_id', 'pertanyaan_pembinaan_id', 'opsi_jawaban_id'];
}
