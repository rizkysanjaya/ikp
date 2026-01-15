<?php

namespace App\Models;

use CodeIgniter\Model;

class RefJawabanModel extends Model
{
    protected $table            = 'ref_opsi_jawaban';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['soal_id', 'label_jawaban', 'bobot_nilai'];
    protected $returnType       = 'object';
}
