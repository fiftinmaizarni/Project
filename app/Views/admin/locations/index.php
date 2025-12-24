<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Manajemen Lokasi</h1>
            <p class="text-gray-600">Kelola lokasi kantor Genegraft</p>
        </div>
        <a href="/admin/locations/create" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
            <i class="fas fa-plus mr-2"></i>Tambah Lokasi
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php if(!empty($locations)): ?>
            <?php foreach ($locations as $location): ?>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800"><?= esc($location['nama_lokasi']) ?></h3>
                    </div>
                    <div class="flex space-x-2">
                        <a href="/admin/locations/edit/<?= $location['id'] ?>" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="/admin/locations/delete/<?= $location['id'] ?>" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
                <div class="space-y-2 text-sm text-gray-600">
                    <p><span class="font-semibold">Alamat:</span> <?= esc($location['alamat']) ?></p>
                    <p><span class="font-semibold">Telepon:</span> <?= esc($location['telepon']) ?></p>
                    <p><span class="font-semibold">Email:</span> <?= esc($location['email']) ?></p>
                    <p><span class="font-semibold">Working Hours:</span> 
                        <?php
                        if (!empty($location['jam_kerja'])) {
                            // Pisahkan berdasarkan titik koma
                            $parts = explode(';', $location['jam_kerja']);
                            $workingHours = [];

                            foreach ($parts as $part) {
                                $part = trim($part);
                                // Hanya ambil bagian weekday (Monday–Friday)
                                if (stripos($part, 'saturday') === false && stripos($part, 'sunday') === false) {
                                    $workingHours[] = $part;
                                }
                            }

                            echo !empty($workingHours) ? esc(implode('; ', $workingHours)) : 'Belum diatur';
                        } else {
                            echo 'Belum diatur';
                        }
                        ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-500 col-span-2">Belum ada lokasi tersedia. Silakan tambah lokasi baru.</p>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
