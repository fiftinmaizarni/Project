<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admin';
    protected $primaryKey       = 'id_admin';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $protectFields    = true;

    protected $allowedFields = [
        'nama_admin',
        'email',
        'username',
        'password',
        'role',
        'reset_token',
        'reset_expires',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true; // otomatis isi created_at & updated_at

    // Hook untuk hash password
    protected $beforeInsert = ['hashPasswordOnInsert'];
    protected $beforeUpdate = ['hashPasswordOnUpdate'];

    // Hash password saat insert
    protected function hashPasswordOnInsert(array $data)
    {
        if (!empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    // Hash password saat update
    protected function hashPasswordOnUpdate(array $data)
    {
        if (!empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}
