<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div>
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Laporan & Unduhan</h1>
    <p class="text-gray-600 mb-8">Unduh laporan data lengkap dalam format CSV untuk analisis lebih lanjut</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Produk -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                <i class="fas fa-box text-blue-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Laporan Data Produk</h3>
            <p class="text-gray-600 text-sm mb-4">Unduh laporan lengkap semua produk dengan detail spesifikasi dan kategori</p>
            <a href="/admin/reports/export-products" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 inline-flex items-center">
                <i class="fas fa-download mr-2"></i>Unduh Laporan
            </a>
        </div>

        <!-- Dokumen -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                <i class="fas fa-file text-blue-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Laporan Data Dokumen</h3>
            <p class="text-gray-600 text-sm mb-4">Unduh laporan semua dokumen produk (Brosur & Manual Book)</p>
            <a href="/admin/reports/export-documents" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 inline-flex items-center">
                <i class="fas fa-download mr-2"></i>Unduh Laporan
            </a>
        </div>

        <!-- Lokasi -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Laporan Data Lokasi</h3>
            <p class="text-gray-600 text-sm mb-4">Unduh laporan semua lokasi kantor dan informasi kontak</p>
            <a href="/admin/reports/export-locations" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 inline-flex items-center">
                <i class="fas fa-download mr-2"></i>Unduh Laporan
            </a>
        </div>

        <!-- Sertifikat -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                <i class="fas fa-certificate text-blue-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Laporan Data Sertifikat</h3>
            <p class="text-gray-600 text-sm mb-4">Unduh laporan semua sertifikat perusahaan</p>
            <a href="/admin/reports/export-certificates" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 inline-flex items-center">
                <i class="fas fa-download mr-2"></i>Unduh Laporan
            </a>
        </div>

        <!-- Aktivitas Admin
        <div class="bg-white rounded-lg shadow p-6">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                <i class="fas fa-history text-blue-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Laporan Aktivitas Admin</h3>
            <p class="text-gray-600 text-sm mb-4">Unduh laporan aktivitas admin: CRUD produk, dokumen, sertifikat, dan login</p>
            <a href="/admin/reports/export-activities" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 inline-flex items-center">
                <i class="fas fa-download mr-2"></i>Unduh Laporan
            </a>
        </div> -->
    </div>
</div>
<?= $this->endSection() ?>
