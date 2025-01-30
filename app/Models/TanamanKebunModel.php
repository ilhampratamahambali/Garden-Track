<?php

namespace App\Models;

use CodeIgniter\Model;

class TanamanKebunModel extends Model
{
    protected $table = 'tanaman_kebun';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_kebun', 'id_tanaman', 'id_user'];
}
