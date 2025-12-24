<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'profil' => 'Didirikan pada tahun 2006, merupakan distributor alat laboratorium di Indonesia yang menyediakan berbagai Instruments Life Science, Analytical Chemistry & General Laboratory Instruments, Reagen and Consumables. Kami menyediakan berbagai solusi untuk produk dan layanan untuk bidang penelitian, pendidikan, kendali mutu & pengujian. Genecraft Labs memiliki tim khusus yang akan melayani Anda dengan berbagai keahlian seperti Ilmu Kehidupan, Kultur Sel, Sel Punca, Keamanan Pangan, Penyalahgunaan Forensik & Obat, Lingkungan, Penemuan Farmasi dan Obat, Penelitian Medis, Kontrol Kualitas Produk, dan banyak bidang lain yang berbeda.
                        Kami bangga mewakili para produsen teratas untuk instrumen laboratorium dan bahan habis pakai dari seluruh dunia. Produk-produk tersebut dikembangkan dengan keahlian tingkat tinggi dan manufaktur dengan kontrol kualitas yang ketat untuk memberikan Anda produk berkualitas luar biasa. Sebagai distributor alat laboratorium di Indonesia, kami akan selalu memberikan kualitas yang terbaik untuk Anda.
                        Genecraft Labs berdedikasi tidak hanya untuk menjadi perusahaan yang memimpin pasar dalam distributor alat laboratorium tetapi juga untuk melayani Anda dengan lebih baik dan senang hati. Tim kami berkomitmen untuk memberikan layanan terbaik dan didukung oleh para ilmuwan dan insinyur berpengalaman yang telah dilatih dan disertifikasi oleh semua mitra terbaik & berpengalaman kami. Kepuasan Anda & pengalaman pelanggan yang terjamin.',
            'misi' => 'Memberikan layanan pelanggan yang sangat baik
                        Peningkatan berkelanjutan dalam Kualitas Sumber Daya Manusia
                        Memberikan produk dan solusi terbaik ke pasar
                        Mitra Terbaik untuk pemasok kami',
            'budaya' => 'Kerja tim
                        Integritas
                        Perbaikan yang terus-menerus
                        Saling menghormati',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('about_us')->insert($data);
    }
}

