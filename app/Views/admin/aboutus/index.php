<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Manajemen About Us</h1>
            <link rel="icon" href="/images/logo3.png" type="image/png">
            <p class="text-gray-600">Edit konten halaman About Us</p>
        </div>
        <button onclick="document.getElementById('aboutForm').submit()" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
            Edit Konten
        </button>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div>
            <form id="aboutForm" action="/admin/aboutus/update" method="POST">
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Profil Perusahaan</h2>
                    <textarea name="profil" rows="5" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= esc($about['profil']) ?></textarea>
                </div>

                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Misi</h2>
                    <p class="text-sm text-gray-500 mb-2">Isi satu poin misi per baris (tekan Enter untuk baris baru).</p>
                    <textarea name="visi" rows="3" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= esc($about['visi']) ?></textarea>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Budaya</h2>
                    <p class="text-sm text-gray-500 mb-2">Isi satu poin budaya per baris (tekan Enter untuk baris baru).</p>
                    <textarea name="misi" rows="5" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= esc($about['misi']) ?></textarea>
                </div>
            </form>
        </div>

        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-4">Preview</h2>
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-bold text-blue-600 mb-2">Profil</h3>
                <p class="text-gray-700"><?= esc($about['profil']) ?></p>
            </div>

            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-bold text-blue-600 mb-2">Misi</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                    <?php
                    $misiPreview = preg_split('/\r\n|\r|\n/', $about['visi'] ?? '');
                    foreach ($misiPreview as $item):
                        $item = trim($item);
                        if ($item === '') continue;
                    ?>
                        <li><?= esc($item) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-blue-600 mb-2">Budaya</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                    <?php
                    $budayaPreview = preg_split('/\r\n|\r|\n/', $about['misi'] ?? '');
                    foreach ($budayaPreview as $item):
                        $item = trim($item);
                        if ($item === '') continue;
                    ?>
                        <li><?= esc($item) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

