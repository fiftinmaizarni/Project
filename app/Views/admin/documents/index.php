<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2"><?= esc($title) ?></h1>
            <p class="text-gray-600">Kelola dokumen produk (Brosur & Manual Book)</p>
        </div>
        <a href="<?= base_url('admin/documents/create'); ?>" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
            <i class="fas fa-plus mr-2"></i>Upload Dokumen
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- SEARCH & FILTER -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex gap-4">
            <!-- Search -->
            <input
                type="text"
                id="searchInput"
                placeholder="Cari nama produk atau nama file..."
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
            >

            <!-- Filter -->
            <select
                id="typeFilter"
                class="w-56 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
            >
                <option value="">All</option>
                <option value="manual book">Manual Book</option>
                <option value="brosur">Brosur</option>
            </select>
        </div>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Dokumen</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama File</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ukuran</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

                <?php foreach ($documents as $doc): ?>
                <tr class="doc-row"
                    data-product="<?= strtolower($doc['nama_produk']) ?>"
                    data-file="<?= strtolower($doc['nama_file']) ?>"
                    data-type="<?= strtolower($doc['jenis_dokumen']) ?>"
                >
                    <td class="px-6 py-4 text-sm text-gray-900"><?= esc($doc['nama_produk']) ?></td>

                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                            <?= esc($doc['jenis_dokumen']) ?>
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <i class="fas fa-file-pdf text-red-600 mr-2"></i>
                            <span class="text-sm text-gray-900"><?= esc($doc['nama_file']) ?></span>
                        </div>
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-500"><?= esc($doc['ukuran']) ?></td>

                    <td class="px-6 py-4 text-center text-sm font-medium">
                        <a href="<?= base_url('admin/documents/edit/' . $doc['id']); ?>" 
                           class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= base_url('admin/documents/delete/' . $doc['id']); ?>" 
                           class="text-red-600 hover:text-red-900"
                           onclick="return confirm('Yakin ingin menghapus dokumen ini?')" title="Hapus">
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
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const typeFilter  = document.getElementById('typeFilter');
    const rows        = document.querySelectorAll('.doc-row');

    function filterDocs() {
        const search = searchInput.value.toLowerCase();
        const type   = typeFilter.value.toLowerCase();

        rows.forEach(row => {
            const product = row.dataset.product;
            const file    = row.dataset.file;
            const docType = row.dataset.type;

            const matchSearch =
                product.includes(search) || file.includes(search);

            const matchType =
                type === '' || docType === type;

            row.style.display = (matchSearch && matchType) ? '' : 'none';
        });
    }

    searchInput.addEventListener('keyup', filterDocs);
    typeFilter.addEventListener('change', filterDocs);
});
</script>

<?= $this->endSection() ?>
