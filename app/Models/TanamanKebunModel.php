<?php

namespace App\Models;

use CodeIgniter\Model;

class TanamanKebunModel extends Model{
    protected $table = 'tanaman_kebun';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_tanaman',
        'id_kebun',
        'id_user',
        'benih',
        'cara_menanam',
        'kondisi_matahari',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
    ];

    public function search($keyword)
    {
        return $this->like('nama_tanaman', $keyword)->findAll();
    }
}