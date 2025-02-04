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

    public function getDetailTanaman($id_tanaman_kebun)
    {
        return $this->db->table('tanaman_kebun')
            ->select('kebun.id_kebun, kebun.nama_kebun, tanaman_kebun.id AS id_tanaman_kebun, tanaman_kebun.benih, tanaman.id_tanaman, tanaman.common_name, tanaman.scientific_name, tanaman.family, tanaman.genus, tanaman_kebun.cara_menanam, tanaman_kebun.kondisi_matahari, tanaman_kebun.tanggal_mulai, tanaman_kebun.tanggal_selesai, tanaman_kebun.deskripsi')
            ->join('kebun', 'kebun.id_kebun = tanaman_kebun.id_kebun')
            ->join('tanaman', 'tanaman.id_tanaman = tanaman_kebun.id_tanaman')
            ->where('tanaman_kebun.id', $id_tanaman_kebun)
            ->get()
            ->getRowArray();
    }
    public function getKebunOrangLain($id_user)
{
    return $this->db->table('kebun')
        ->select('kebun.id_kebun, kebun.nama_kebun, users.nama AS pemilik')
        ->join('users', 'users.id_user = kebun.id_user')
        ->where('kebun.id_user !=', $id_user) // Ambil kebun selain milik user login
        ->get()
        ->getResultArray();
}

public function getTanamanByKebun($id_kebun)
{
    return $this->db->table('tanaman_kebun')
        ->select('tanaman_kebun.*, tanaman.common_name, tanaman.scientific_name')
        ->join('tanaman', 'tanaman.id_tanaman = tanaman_kebun.id_tanaman')
        ->where('tanaman_kebun.id_kebun', $id_kebun)
        ->get()
        ->getResultArray();
}

}