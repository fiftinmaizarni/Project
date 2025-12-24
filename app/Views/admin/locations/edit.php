<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div>
    <a href="/admin/locations" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
    
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Lokasi</h1>
    <p class="text-gray-600 mb-8">Ubah informasi lokasi kantor di bawah</p>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="/admin/locations/update/<?= $location['id'] ?>" method="POST">
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lokasi <span class="text-red-500">*</span></label>
                <input type="text" name="nama_lokasi" value="<?= esc($location['nama_lokasi']) ?>" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Alamat <span class="text-red-500">*</span></label>
                <textarea name="alamat" rows="3" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= esc($location['alamat']) ?></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Telepon <span class="text-red-500">*</span></label>
                    <input type="text" name="telepon" value="<?= esc($location['telepon']) ?>" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="<?= esc($location['email']) ?>" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Jam Kerja Monday-Friday -->
            <?php
                // Split jam kerja jika sudah tersimpan
                $jam_mulai = '08:00';
                $jam_selesai = '17:00';
                if(!empty($location['jam_kerja'])){
                    if(preg_match('/(\d{2}:\d{2})\s*(AM|PM).*–\s*(\d{2}:\d{2})\s*(AM|PM)/i', $location['jam_kerja'], $matches)){
                        $jam_mulai = date('H:i', strtotime($matches[1].' '.$matches[2]));
                        $jam_selesai = date('H:i', strtotime($matches[3].' '.$matches[4]));
                    }
                }
            ?>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Jam Kerja (Monday–Friday)</label>
                <div class="grid grid-cols-2 gap-4 items-center">
                    <div>
                        <label class="block text-sm">Jam Mulai</label>
                        <input type="time" name="jam_mulai" value="<?= $jam_mulai ?>" class="w-full border px-2 py-1 rounded">
                    </div>
                    <div>
                        <label class="block text-sm">Jam Selesai</label>
                        <input type="time" name="jam_selesai" value="<?= $jam_selesai ?>" class="w-full border px-2 py-1 rounded">
                    </div>
                </div>
                <p class="text-gray-500 text-sm mt-1">Saturday & Sunday dianggap libur</p>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                    Simpan Perubahan
                </button>
                <a href="/admin/locations" class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
