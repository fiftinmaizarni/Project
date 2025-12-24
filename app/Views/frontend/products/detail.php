<?= $this->extend('frontend/layout') ?>

<?= $this->section('content') ?>
<?php
    $featureTokens = array_filter(array_map('trim', preg_split('/[\n,;]+/', $product['key_features'] ?? '')));
    $documentsByType = [
        'Brosur' => null,
        'Manual Book' => null,
    ];
    foreach ($documents as $doc) {
        $documentsByType[$doc['jenis_dokumen']] = $doc;
    }
?>
<section class="bg-blue-50 py-12">
    <div class="container mx-auto px-4">

        <div class="mb-6">
            <a href="/products" class="text-blue-600 font-semibold hover:underline flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali ke Produk
            </a>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">

            <!-- Sidebar Produk Lain -->
            <aside class="bg-white rounded-3xl p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Produk Lainnya</h2>

                <div class="space-y-2 max-h-96 overflow-y-auto pr-1">
                    <?php foreach ($allProducts as $p): ?>
                        <a href="/products/<?= $p['id'] ?>"
                           class="block px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200
                           <?= $p['id'] == $product['id']
                                ? 'bg-blue-600 text-white shadow'
                                : 'bg-gray-100 text-gray-700 hover:bg-blue-600 hover:text-white hover:shadow' ?>">
                            <?= esc($p['nama_produk']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </aside>

            <!-- Detail Produk -->
            <div class="xl:col-span-3 space-y-8">

                <div class="bg-white rounded-3xl p-8 shadow-sm">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                        <!-- Informasi Produk -->
                        <div>
                            <span class="inline-flex items-center px-4 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold uppercase tracking-widest mb-4">
                                <?= esc($product['kategori']) ?>
                            </span>

                            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                                <?= esc($product['nama_produk']) ?>
                            </h1>

                            <p class="text-gray-600 mb-6 leading-relaxed">
                                <?= esc($product['deskripsi'] ?? 'Spesifikasi akan segera tersedia.') ?>
                            </p>

                            <!-- Key Features -->
                            <?php if (!empty($featureTokens)): ?>
                                <div class="flex flex-wrap gap-3 mb-6">
                                    <?php foreach ($featureTokens as $feature): ?>
                                        <span class="px-4 py-2 rounded-2xl bg-blue-100 text-blue-700 text-xs font-semibold">
                                            <?= esc($feature) ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Tombol -->
                            <div class="flex flex-wrap gap-3">
                                <a href="#specifications" class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 text-white rounded-2xl font-semibold hover:bg-blue-700">
                                    <i class="fas fa-eye"></i> View Specifications
                                </a>

                                <?php foreach ($documentsByType as $label => $doc): ?>
                                    <?php if ($doc): ?>
                                        <a href="/<?= $doc['path'] ?>" target="_blank"
                                           class="inline-flex items-center gap-2 px-5 py-3 border border-gray-200 rounded-2xl text-gray-700 hover:border-blue-400 hover:text-blue-600">
                                            <i class="fas <?= $label === 'Brosur' ? 'fa-download' : 'fa-book' ?>"></i>
                                            <?= $label ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-2 px-5 py-3 border border-dashed border-gray-200 rounded-2xl text-gray-400">
                                            <i class="fas <?= $label === 'Brosur' ? 'fa-download' : 'fa-book' ?>"></i>
                                            <?= $label ?>
                                        </span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Gambar -->
                        <div class="bg-white rounded-3xl h-full flex items-center justify-center">
                            <?php if (!empty($product['gambar'])): ?>
                                <img src="/<?= $product['gambar'] ?>"
                                     alt="<?= esc($product['nama_produk']) ?>"
                                     class="w-full h-full object-contain rounded-3xl">
                            <?php else: ?>
                                <i class="fas fa-box text-gray-300 text-6xl"></i>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

                <!-- Spesifikasi -->
                <div id="specifications" class="bg-white rounded-3xl p-8 shadow-sm">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Specifications</h2>
                    <div class="text-gray-700 leading-relaxed text-left">
                        <?= nl2br(esc($product['spesifikasi'])) ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
