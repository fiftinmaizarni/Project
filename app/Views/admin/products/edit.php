<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div>
    <a href="/admin/products" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
    
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Produk</h1>
    <p class="text-gray-600 mb-8">Ubah informasi produk di bawah</p>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="/admin/products/update/<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Produk <span class="text-red-500">*</span></label>
                <input type="text" name="nama_produk" value="<?= esc($product['nama_produk']) ?>" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Kategori <span class="text-red-500">*</span></label>
                <select name="kategori" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="General Lab" <?= $product['kategori'] == 'General Lab' ? 'selected' : '' ?>>General Lab</option>
                    <option value="Analytical" <?= $product['kategori'] == 'Analytical' ? 'selected' : '' ?>>Analytical</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Spesifikasi <span class="text-red-500">*</span></label>
                <textarea name="spesifikasi" rows="5" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= esc($product['spesifikasi']) ?></textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= esc($product['deskripsi'] ?? '') ?></textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Key Features</label>
                <textarea name="key_features" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= esc($product['key_features'] ?? '') ?></textarea>
                <p class="text-xs text-gray-500 mt-2">Gunakan koma atau baris baru untuk memisahkan setiap fitur.</p>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Stok <span class="text-red-500">*</span></label>
                <input type="number" name="stok" value="<?= $product['stok'] ?>" required min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Upload Gambar</label>
                <?php if ($product['gambar']): ?>
                    <img src="/<?= $product['gambar'] ?>" alt="Current Image" class="mb-4 w-32 h-32 object-cover rounded">
                <?php endif; ?>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                    <i class="fas fa-arrow-up text-gray-400 text-3xl mb-4"></i>
                    <p class="text-gray-600">Klik untuk upload atau drag & drop</p>
                    <input type="file" name="gambar" accept="image/*" class="mt-4">
                </div>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                    Simpan Perubahan
                </button>
                <a href="/admin/products" class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

