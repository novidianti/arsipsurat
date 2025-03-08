<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';    
    protected $primaryKey = 'id';
    protected $allowedFields    = [
        'disposisi',
        'username',
        'password',
        'status'
    ];

    public function detailUsers()
    {
    $db = \Config\Database::connect();
    $builder = $db->table('users'); // Hanya gunakan nama tabel utama
    $builder->select('users.*, disposisi.jabatan'); // Ambil kolom yang diinginkan
    $builder->join('disposisi', 'disposisi.id = users.disposisi', 'left'); // Join dengan tabel disposisi
    return $builder->get()->getResultArray(); // Mengambil semua hasil sebagai array
    }

}