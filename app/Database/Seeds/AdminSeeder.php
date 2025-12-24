<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_admin' => 'Admin User',
                'username'   => 'admin',
                'email'      => 'admin@example.com', // tambahkan email
                'password'   => password_hash('admin123', PASSWORD_DEFAULT),
                'role'       => 'Super Admin',
                'created_at' => date('Y-m-d H:i:s'), // opsional, supaya ada timestamp
            ],
        ];

        $this->db->table('admin')->insertBatch($data);
    }
}
