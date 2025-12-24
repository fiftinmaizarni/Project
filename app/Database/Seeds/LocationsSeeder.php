<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LocationsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_lokasi' => 'HEAD QUARTERS - JAKARTA',
                'alamat' => 'Rukan Jl. Business Park Blok G8, Jl. Menteng Raya No.88, Menteng Utara, Jakarta Selatan - 12610',
                'telepon' => '(62-21) 5890319',
                'email' => 'sales@genecraftlabs.com',
                'jam_kerja' => 'Monday - Friday: 09.00 AM - 5.00 PM',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_lokasi' => 'CIKARANG OFFICE',
                'alamat' => 'CBD Jababeka Blok A-8 2, Niaga Raya Cibitung, Bekasi - Jawa Barat',
                'telepon' => '(62-21) 29049934',
                'email' => 'sales@genecraftlabs.com',
                'jam_kerja' => 'Monday - Friday: 09.00 AM - 5.00 PM',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_lokasi' => 'SURABAYA OFFICE',
                'alamat' => 'Jaffa Industrial Center, Jaffa Tower II Lt. 5 Blok 2, Panglima Sudirman No. 12-14, Surabaya 60271',
                'telepon' => '(62-31) 5316770',
                'email' => 'sales@genecraftlabs.com',
                'jam_kerja' => 'Monday - Friday: 09.00 AM - 5.00 PM',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_lokasi' => 'MEDAN OFFICE',
                'alamat' => 'Regus Forum Nine, 9th Floor Jl. Imam Bonjol No.9, Medan 20112',
                'telepon' => '(62-61) 8010331',
                'email' => 'sales@genecraftlabs.com',
                'jam_kerja' => 'Monday - Friday: 09.00 AM - 5.00 PM',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('locations')->insertBatch($data);
    }
}

