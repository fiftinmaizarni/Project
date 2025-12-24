<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Craft Bio') ?> - Genecraft Labs</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Tailwind 2 group-hover fix */
        .group:hover .group-hover\:block {
            display: block;
        }
        .transition-all {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body class="bg-white">

<!-- ======================== NAVBAR ======================== -->
<header class="bg-white shadow-sm">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">

            <!-- Logo -->
            <a href="/" class="flex items-center space-x-3">
                <img src="/images/logo.png" alt="Craft Bio Logo" class="h-16 w-auto">
            </a>

            <!-- Menu -->
            <nav class="hidden md:flex items-center space-x-6">
                <a href="/" class="text-gray-700 hover:text-blue-600">Home</a>

                <!-- Products Dropdown -->
                <?php $dropdownProducts = $productsPreview ?? ($allProducts ?? []); ?>
                <div class="relative group">
                    <a href="/products" class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium">Products</a>

                    <!-- FULL-WIDTH DROPDOWN -->
                    <div class="absolute top-full hidden group-hover:block hover:block
                                bg-white shadow-xl rounded-xl border border-gray-200 p-6 z-50 mt-2
                                left-1/2 transform -translate-x-1/2 w-screen max-w-7xl">
                        <?php // Debug: show count of dropdown products in HTML source ?>
                        <?php if (isset($dropdownProducts)): ?>
                            <?= '<!-- dropdownProducts: ' . count($dropdownProducts) . ' -->' ?>
                        <?php else: ?>
                            <?= '<!-- dropdownProducts: not set -->' ?>
                        <?php endif; ?>
                        
                        <div class="flex gap-6 mx-auto items-start">

                            <!-- Product List -->
                            <div class="w-1/4">
                                <h4 class="font-semibold text-gray-800 mb-2">Products</h4>
                                <ul class="text-sm text-gray-700 space-y-2 ml-2">
                                    <?php foreach ($dropdownProducts as $p): ?>
                                        <li>
                                            <a href="javascript:void(0);" 
                                               class="hover:text-blue-600 cursor-pointer block p-1 rounded hover:bg-gray-50 font-medium"
                                               onclick="showProductDetail('<?= $p['id'] ?>')">
                                                <?= esc($p['nama_produk']) ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- Product Image -->
                            <div class="w-1/3 flex flex-col items-center">
                                <h4 class="font-semibold text-gray-800 mb-2 text-center">Product Image</h4>
                                <?php foreach ($dropdownProducts as $p): ?>
                                    <?php $imgPath = '/' . ltrim($p['gambar'] ?? 'images/default-product.png', '/'); ?>
                                    <div id="product-<?= $p['id'] ?>-image" class="product-image hidden transition-all">
                                        <img src="<?= esc($imgPath) ?>" 
                                            alt="<?= esc($p['nama_produk']) ?>" 
                                            class="w-80 h-80 object-contain">
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Product Specifications -->
                            <div class="w-5/12 flex flex-col items-center">
                                <h4 class="font-semibold text-gray-800 mb-2 text-center">Specifications</h4>
                                <?php foreach ($dropdownProducts as $p): ?>
                                    <div id="product-<?= $p['id'] ?>-spec" 
                                         class="product-spec text-sm text-gray-700 border rounded-lg p-4 w-full hidden transition-all mb-2">
                                        <strong><?= esc($p['nama_produk']) ?>:</strong><br>
                                        <?= nl2br(esc($p['spesifikasi'] ?? 'No specifications available')) ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>
                </div>

                <a href="/about" class="text-gray-700 hover:text-blue-600">About Us</a>
                <a href="/locations" class="text-gray-700 hover:text-blue-600">Locations</a>
            </nav>

            <!-- Search -->
            <div class="flex items-center space-x-4">
                <form action="/products" method="get"
                      class="hidden md:flex items-center border border-gray-300 rounded-lg px-4 py-2 bg-gray-50">
                    <i class="fas fa-search text-gray-400 mr-2"></i>
                    <input type="text" name="q" placeholder="Search"
                           class="outline-none bg-transparent text-sm text-gray-700 w-52">
                </form>
            </div>
        </div>
    </div>
</header>

<!-- ======================== MAIN CONTENT ======================== -->
<main>
    <?= $this->renderSection('content') ?>
</main>

<!-- ======================== FOOTER ======================== -->
<footer class="bg-blue-50 py-12">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-between gap-8">

            <!-- Logo Footer -->
            <div class="flex-1 min-w-[250px]">
                <a href="/" class="flex items-center space-x-3 mb-4">
                    <img src="/images/logo.png" alt="Craft Bio Logo" class="h-16 w-auto">
                </a>
                <p class="text-gray-600 text-sm mb-4">
                    PT. Genecraft Labs, established in 2006, is a leading Life Science, Analytical & Laboratory Instruments, Reagents and Consumables Distributor in Indonesia. We provide a wide range of solutions for research, education, quality control & testing field.
                </p>
                <a href="/about" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 inline-block">
                    About Us
                </a>
            </div>

            <!-- Our Products -->
            <div class="flex-1 min-w-[200px]">
                <h3 class="font-bold text-gray-800 mb-4">Our Products</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <?php if (!empty($productsPreview)): ?>
                        <?php foreach ($productsPreview as $p): ?>
                            <li>
                                <a href="/products/<?= $p['id'] ?>" class="hover:text-blue-600">
                                    <?= esc($p['nama_produk']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="text-gray-500">No products available</li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Quick Link -->
            <div class="flex-1 min-w-[150px]">
                <h3 class="font-bold text-gray-800 mb-4">Quick Link</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li><a href="/" class="hover:text-blue-600">Home</a></li>
                    <li><a href="/products" class="hover:text-blue-600">Products</a></li>
                    <li><a href="/about" class="hover:text-blue-600">About Us</a></li>
                    <li><a href="/locations" class="hover:text-blue-600">Locations</a></li>
                </ul>
            </div>

        </div>

        <div class="border-t border-gray-300 mt-8 pt-8 text-center text-sm text-gray-600">
            All Rights Reserved © GeneCraftLabs.com
        </div>
    </div>
</footer>

<!-- ======================== SCRIPT ======================== -->
<script>
// Tampilkan gambar & spesifikasi hanya saat klik
function showProductDetail(id) {
    // Sembunyikan semua gambar dan spesifikasi
    document.querySelectorAll('.product-image').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.product-spec').forEach(el => el.classList.add('hidden'));

    // Tampilkan yang diklik
    const imageEl = document.getElementById('product-' + id + '-image');
    const specEl = document.getElementById('product-' + id + '-spec');
    if (imageEl) imageEl.classList.remove('hidden');
    if (specEl) specEl.classList.remove('hidden');
}
</script>

<?= $this->renderSection('scripts') ?>

</body>
</html>
