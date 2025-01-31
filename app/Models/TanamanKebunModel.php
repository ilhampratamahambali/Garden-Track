<?php

namespace App\Models;

use CodeIgniter\Model;

class TanamanKebunModel extends Model{
    protected $table = 'tanaman_kebun';
    protected $primaryKey = 'id_tanaman';
    protected $allowedFields = [
        'nama_tanaman',
        'benih', 
        'cara_menanam',
        'kondisi_tanah',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi'
    ];

    public function search($keyword)
    {
        return $this->like('nama_tanaman', $keyword)->findAll();
    }
}
