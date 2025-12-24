<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="max-w-3xl mx-auto mt-10">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Edit Dokumen</h2>
        <p class="text-gray-600 mb-6">Perbarui data dokumen produk</p>

        <?php if(session()->getFlashdata('errors')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    <?php foreach(session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/documents/update/' . $document['id']); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <!-- Pilih Produk -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Pilih Produk</label>
                <select name="product_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    <?php foreach($products as $product): ?>
                        <option value="<?= $product['id'] ?>" <?= $product['id'] == $document['product_id'] ? 'selected' : '' ?>>
                            <?= esc($product['nama_produk']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Jenis Dokumen -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Jenis Dokumen</label>
                <select name="jenis_dokumen" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    <option value="Brosur" <?= $document['jenis_dokumen'] == 'Brosur' ? 'selected' : '' ?>>Brosur</option>
                    <option value="Manual Book" <?= $document['jenis_dokumen'] == 'Manual Book' ? 'selected' : '' ?>>Manual Book</option>
                </select>
            </div>

            <!-- File Saat Ini -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">File Saat Ini</label>
                <p class="text-gray-800 mb-1"><?= esc($document['nama_file']) ?></p>
                <a href="<?= base_url($document['path']) ?>" target="_blank" class="text-blue-600 hover:underline text-sm">Lihat Dokumen</a>
            </div>

            <!-- Upload File Baru -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Upload File Baru (Opsional)</label>
                <input type="file" name="file" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <p class="text-gray-500 text-sm mt-1">Biarkan kosong jika tidak ingin mengganti file.</p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center space-x-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Update Dokumen</button>
                <a href="<?= base_url('admin/documents') ?>" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
