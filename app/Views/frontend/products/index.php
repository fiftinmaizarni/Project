<?= $this->extend('frontend/layout') ?>

<?= $this->section('content') ?>
<section class="bg-blue-50">
    <div class="container mx-auto px-4 py-16">

        <!-- HEADER -->
        <div class="text-center max-w-3xl mx-auto mb-12">
            <p class="text-sm uppercase tracking-widest text-blue-500 mb-3">Products</p>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our Products</h1>
            <p class="text-gray-600 text-lg">
                Eksplorasi rangkaian produk Genegraft Labs untuk kebutuhan riset, laboratorium, dan layanan kesehatan Anda.
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-10">

            <!-- CATEGORY TABS -->
            <div class="flex flex-wrap justify-center gap-3 mb-10">
                <?php
                    $tabs = ['all' => 'All'];
                    foreach (array_unique($categories ?? []) as $cat) {
                        if ($cat) $tabs[$cat] = $cat;
                    }
                ?>
                <?php foreach ($tabs as $value => $label): ?>
                    <?php
                        $query = ['kategori' => $value];
                        if (!empty($search)) $query['q'] = $search;
                        $active = ($kategori === $value) || ($value === 'all' && $kategori === 'all');
                    ?>
                    <a href="/products?<?= http_build_query($query) ?>"
                       class="px-5 py-2 rounded-full text-sm font-medium border
                       <?= $active
                            ? 'bg-blue-600 border-blue-600 text-white shadow'
                            : 'border-gray-200 text-gray-600 hover:border-blue-400 hover:text-blue-600' ?>">
                        <?= esc($label) ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <?php if (empty($products)): ?>
                <div class="text-center py-16">
                    <i class="fas fa-box-open text-5xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-800">Produk tidak ditemukan</h3>
                </div>
            <?php else: ?>

                <!-- PRODUCT GRID -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                <?php foreach ($products as $product): ?>
                    <?php
                        // DOCUMENT MAP
                        $docs = $documentsByProduct[$product['id']] ?? [];
                        $docMap = ['Brosur' => null, 'Manual Book' => null];
                        foreach ($docs as $doc) {
                            $docMap[$doc['jenis_dokumen']] = $doc;
                        }

                        // FEATURES
                        $features = array_filter(array_map(
                            'trim',
                            preg_split('/[\n,;]+/', $product['key_features'] ?? '')
                        ));

                        // DESCRIPTION (FULL, NOT CUT)
                        $description = trim($product['deskripsi'] ?? '');
                        if ($description === '') {
                            $description = trim(strip_tags($product['spesifikasi'] ?? ''));
                        }
                    ?>

                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm flex flex-col overflow-hidden">

                        <!-- PRODUCT TITLE -->
                        <div class="text-center pt-6 pb-3">
                            <h3 class="text-blue-600 font-bold text-lg">
                                <?= esc($product['nama_produk']) ?>
                            </h3>
                        </div>

                        <!-- IMAGE (SELALU DI BAWAH JUDUL) -->
                        <div class="flex justify-center items-center h-60 bg-white px-6">
                            <?php if (!empty($product['gambar'])): ?>
                                <img src="/<?= esc($product['gambar']) ?>"
                                     alt="<?= esc($product['nama_produk']) ?>"
                                     class="max-h-52 object-contain">
                            <?php else: ?>
                                <i class="fas fa-image text-5xl text-gray-300"></i>
                            <?php endif; ?>
                        </div>

                        <!-- CONTENT -->
                        <div class="p-6 flex flex-col h-full">

                            <div class="flex justify-between text-sm text-gray-500 mb-3">
                                <span><?= esc($product['kategori']) ?></span>
                                <span class="font-semibold text-green-600">
                                    Stok <?= esc($product['stok']) ?>
                                </span>
                            </div>

                            <!-- FULL DESCRIPTION -->
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                <?= esc($description ?: 'Spesifikasi akan segera tersedia.') ?>
                            </p>

                            <!-- FEATURES -->
                            <?php if (!empty($features)): ?>
                                <div class="flex flex-wrap gap-2 mb-6">
                                    <?php foreach ($features as $f): ?>
                                        <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold">
                                            <?= esc($f) ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <div class="mt-auto space-y-3">

                                <!-- VIEW SPECIFICATIONS BUTTON -->
                                <a href="/products/<?= $product['id'] ?>"
                                   class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700">
                                    <i class="fas fa-eye"></i> View Specifications
                                </a>

                                <!-- DOWNLOAD BUTTONS -->
                                <div class="flex gap-3 text-sm">
                                    <?php foreach ($docMap as $label => $doc): ?>
                                        <?php if ($doc): ?>
                                            <a href="/download/document/<?= $doc['id'] ?>"
                                               class="flex-1 inline-flex items-center justify-center gap-2 border border-gray-200 rounded-xl py-2 hover:border-blue-500 hover:text-blue-600">
                                                <i class="fas <?= $label === 'Brosur' ? 'fa-download' : 'fa-book' ?>"></i>
                                                <?= $label ?>
                                            </a>
                                        <?php else: ?>
                                            <span class="flex-1 inline-flex items-center justify-center gap-2 border border-dashed border-gray-200 rounded-xl py-2 text-gray-400">
                                                <i class="fas fa-ban"></i> <?= $label ?>
                                            </span>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<?= $this->endSection() ?>
