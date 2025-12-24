<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div>
    <a href="/admin/certificates" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
    
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Tambah Sertifikat Baru</h1>
    <p class="text-gray-600 mb-8">Isi form di bawah untuk menambah sertifikat baru</p>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="/admin/certificates" method="POST" enctype="multipart/form-data">
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Sertifikat <span class="text-red-500">*</span></label>
                <input type="text" name="nama_sertifikat" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan nama sertifikat">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Upload Gambar Sertifikat <span class="text-red-500">*</span></label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                    <i class="fas fa-arrow-up text-gray-400 text-3xl mb-4"></i>
                    <p class="text-gray-600">Klik untuk upload atau drag & drop</p>
                    <input type="file" name="gambar" accept="image/*" required class="mt-4">
                </div>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                    Simpan Sertifikat
                </button>
                <a href="/admin/certificates" class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

