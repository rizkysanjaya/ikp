<?php

namespace App\Models;

use CodeIgniter\Model;

class SurveyRespondenModel extends Model
{
    protected $table            = 'trans_responden';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'nama_lengkap',
        'tanggal_survei',
        'jenis_layanan_id',
        'instansi_id',
        'pendidikan_id',
        'pekerjaan_id',
        'umur',
        'jenis_kelamin',
        'saran_masukan',
    ];
    protected $useTimestamps = false;
}
