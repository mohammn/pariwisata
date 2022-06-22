<?php

namespace App\Models;

use CodeIgniter\Model;

class WisataModel extends Model
{

    protected $table = "wisata";
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'alamat', 'deskripsi', 'foto', 'latitude', 'longitude', 'operator'];
}
