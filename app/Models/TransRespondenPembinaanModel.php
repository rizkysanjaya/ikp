<?php

namespace App\Models;

use CodeIgniter\Model;

class TransRespondenPembinaanModel extends Model
{
    protected $table            = 'trans_responden_pembinaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; // Use array for easier inserts
    protected $useTimestamps    = true; // We added created_at, updated_at
    protected $allowedFields    = [
        'tanggal_survei',
        'nama_lengkap',
        'instansi_id',
        'layanan_id',
        'kelompok_usia',
        'jenis_kelamin',
        'pendidikan_id',
        'pekerjaan_id',
        'tempat_pelaksanaan',
        'tanggal_pelaksanaan',
        'metode_penyampaian',
        'tema_kegiatan',
        'saran_masukan'
    ];
}
