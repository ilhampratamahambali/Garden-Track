<?php

namespace App\Models;

use CodeIgniter\Model;

class KebunModel extends Model
{
    protected $table = 'kebun';
    protected $primaryKey = 'id_kebun';
    protected $allowedFields = [
        'id_user',
        'id_tanaman',
        'nama_kebun', 
        'poto_kebun', 
        'status'
    ];
}