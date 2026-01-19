<?php

namespace App\Models;

use CodeIgniter\Model;

class SurveyJawabanModel extends Model
{
    protected $table            = 'trans_detail_jawaban';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['responden_id', 'soal_id', 'opsi_jawaban_id', 'nilai_skor'];
}
