<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Manajemen Sertifikat</h1>
            <p class="text-gray-600">Kelola sertifikat perusahaan</p>
        </div>
        <a href="/admin/certificates/create" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
            <i class="fas fa-plus mr-2"></i>Tambah Sertifikat
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach ($certificates as $cert): ?>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="mb-4">
                <i class="fas fa-trophy text-yellow-500 text-5xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-4"><?= esc($cert['nama_sertifikat']) ?></h3>
            <a href="/admin/certificates/delete/<?= $cert['id'] ?>" 
                class="inline-block bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                onclick="return confirm('Yakin ingin menghapus?')">
                <i class="fas fa-trash mr-2"></i>Hapus
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>

