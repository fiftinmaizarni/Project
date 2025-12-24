<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Admin User',
                'username' => 'admin',
                'email' => 'admin@genegraft.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'Super Admin',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            // [
            //     'nama' => 'Manager Produk',
            //     'username' => 'manager_produk',
            //     'email' => 'manager@genegraft.com',
            //     'password' => password_hash('manager123', PASSWORD_DEFAULT),
            //     'role' => 'Manager',
            //     'created_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'nama' => 'Editor Konten',
            //     'username' => 'editor',
            //     'email' => 'editor@genegraft.com',
            //     'password' => password_hash('editor123', PASSWORD_DEFAULT),
            //     'role' => 'Editor',
            //     'created_at' => date('Y-m-d H:i:s'),
            // ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}

