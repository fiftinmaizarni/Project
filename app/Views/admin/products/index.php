<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Manajemen Produk</h1>
            <p class="text-gray-600">Kelola semua produk Genegraft</p>
        </div>
        <a href="/admin/products/create" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
            <i class="fas fa-plus mr-2"></i>Tambah Produk
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- Search & Filter -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex space-x-4">
            <div class="flex-1">
                <input
                    type="text"
                    id="searchInput"
                    placeholder="Cari nama produk atau kategori..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>
            <select
                id="categoryFilter"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">All</option>
                <option value="General Lab">General Lab</option>
                <option value="Analytical">Analytical</option>
            </select>
        </div>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

                <?php foreach ($products as $product): ?>
                <tr
                    class="product-row"
                    data-name="<?= strtolower($product['nama_produk']) ?>"
                    data-category="<?= strtolower($product['kategori']) ?>"
                >
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php if ($product['gambar']): ?>
                            <img
                                src="/<?= $product['gambar'] ?>"
                                alt="<?= esc($product['nama_produk']) ?>"
                                class="w-16 h-16 object-cover rounded"
                            >
                        <?php else: ?>
                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                <i class="fas fa-box text-gray-400"></i>
                            </div>
                        <?php endif; ?>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            <?= esc($product['nama_produk']) ?>
                        </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                            <?= esc($product['kategori']) ?>
                        </span>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php
                        $stokClass = $product['stok'] > 3
                            ? 'bg-green-100 text-green-800'
                            : 'bg-yellow-100 text-yellow-800';
                        ?>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full <?= $stokClass ?>">
                            <?= esc($product['stok']) ?> unit
                        </span>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a
                            href="/admin/products/edit/<?= $product['id'] ?>"
                            class="text-blue-600 hover:text-blue-900 mr-4"
                        >
                            <i class="fas fa-edit"></i>
                        </a>

                        <a
                            href="/admin/products/delete/<?= $product['id'] ?>"
                            class="text-red-600 hover:text-red-900 confirm-delete"
                            data-confirm="Yakin ingin menghapus?"
                        >
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<!-- JS FILTER -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const rows = document.querySelectorAll('.product-row');

    function filterProducts() {
        const searchValue = searchInput.value.toLowerCase();
        const categoryValue = categoryFilter.value.toLowerCase();

        rows.forEach(row => {
            const name = row.dataset.name;
            const category = row.dataset.category;

            const matchSearch =
                name.includes(searchValue) || category.includes(searchValue);

            const matchCategory =
                categoryValue === '' || category === categoryValue;

            row.style.display = (matchSearch && matchCategory)
                ? ''
                : 'none';
        });
    }

    searchInput.addEventListener('keyup', filterProducts);
    categoryFilter.addEventListener('change', filterProducts);
});
</script>

<?= $this->endSection() ?>
