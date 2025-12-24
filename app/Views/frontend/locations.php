<?= $this->extend('frontend/layout') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Our Locations</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($locations as $location): ?>
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">

            <div class="flex justify-center mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                </div>
            </div>

            <h3 class="text-lg font-bold text-gray-800 mb-4"><?= esc($location['nama_lokasi']) ?></h3>

            <div class="space-y-2 text-sm text-gray-600 mb-4 text-left">
                <p><span class="font-semibold">Address:</span> <?= esc($location['alamat']) ?></p>
                <p><span class="font-semibold">Email:</span> <?= esc($location['email']) ?></p>
                <p><span class="font-semibold">Phone:</span> <?= esc($location['telepon']) ?></p>
                <?php if ($location['jam_kerja']): ?>
                <p><span class="font-semibold">Working Hours:</span> <?= esc($location['jam_kerja']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Get Directions Button -->
            <a href="https://www.google.com/maps?q=<?= urlencode($location['alamat']) ?>" 
               target="_blank"
               class="w-full bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 block text-center">
               Get Directions
            </a>

        </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>
