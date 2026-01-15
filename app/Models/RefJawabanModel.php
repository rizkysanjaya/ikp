<?php

namespace App\Models;

use CodeIgniter\Model;

class RefJawabanModel extends Model
{
    protected $table            = 'ref_jawaban';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['pertanyaan_id', 'jawaban', 'nilai'];
    protected $returnType       = 'object';
}
