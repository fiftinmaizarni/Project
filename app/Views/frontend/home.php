<?= $this->extend('frontend/layout') ?>

<?= $this->section('content') ?>
<!-- Hero Section -->
<section class="relative bg-cover bg-center h-screen flex items-center" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/images/gambar3.png');">
    <div class="container mx-auto px-4 text-white">
        <h1 class="text-5xl font-bold mb-4">
            Advanced Laboratory<br>
            <span class="text-blue-400">Solutions for Your Research</span>
        </h1>
        <p class="text-lg mb-8 max-w-2xl">
            PT. Genegraft Labs menyediakan rangkaian solusi lengkap untuk kebutuhan life science, alat analisis dan laboratorium,
            mulai dari peralatan, reagen, hingga layanan purna jual untuk mendukung riset dan aktivitas laboratorium Anda.
        </p>
        <a href="/products" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 inline-block">
            Explore Product
        </a>
    </div>
</section>
<?= $this->endSection() ?>

