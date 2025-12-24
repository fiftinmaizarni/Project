<?= $this->extend('frontend/layout') ?>

<?= $this->section('content') ?>

<style>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    scrollbar-width: none;
}

/* ===== CERTIFICATE READABLE SIZE ===== */
.cert-image-wrapper {
    height: 520px;                 /* NAIK: terbaca */
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background: #f9fafb;
    border-radius: 10px;
}

.cert-image {
    max-height: 520px;
    max-width: 400px;
    object-fit: contain;           /* WAJIB */
}

.cert-card {
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    transform-origin: center center;   /* PENTING: cegah efek maju */
    will-change: transform;
}
</style>

<!-- Hero Section -->
<section class="relative bg-cover bg-center h-64 flex items-center"
         style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/images/gambar3.png');">
    <div class="container mx-auto px-4 text-white">
        <h1 class="text-4xl font-bold">About Us</h1>
    </div>
</section>

<!-- About Content -->
<section class="py-12">
<div class="container mx-auto px-4">

    <!-- Profil -->
    <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">About Us</h2>
        <h3 class="text-2xl font-bold text-blue-600 mb-6">Genegraft Labs</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <p class="text-gray-700 leading-relaxed mb-4">
                    <?= esc($about['profil'] ?? 'PT. Genegraft Labs didirikan pada tahun 2006 sebagai distributor alat laboratorium dan life science terkemuka di Indonesia.') ?>
                </p>
            </div>

            <div>
                <img src="/images/gambar2.png"
                     alt="Lab"
                     class="w-full rounded-lg shadow-lg">
            </div>
        </div>
    </div>

    <!-- Mission & Culture -->
    <div class="bg-blue-900 text-white py-12 rounded-lg mb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-6">

            <!-- Misi -->
            <div>
                <h3 class="text-2xl font-bold mb-4">Misi Kami</h3>
                <ul class="space-y-2">
                    <?php
                    foreach (preg_split('/\r\n|\r|\n/', $about['visi'] ?? '') as $item):
                        $item = trim($item);
                        if ($item === '') continue;
                    ?>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mr-2 mt-1"></i>
                            <span><?= esc($item) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Budaya -->
            <div>
                <h3 class="text-2xl font-bold mb-4">Budaya Kami</h3>
                <ul class="space-y-2">
                    <?php
                    foreach (preg_split('/\r\n|\r|\n/', $about['misi'] ?? '') as $item):
                        $item = trim($item);
                        if ($item === '') continue;
                    ?>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mr-2 mt-1"></i>
                            <span><?= esc($item) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
    </div>

    <!-- ================= CERTIFICATE SECTION ================= -->
    <div class="mt-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
            Our Certificate
        </h2>

        <div id="cert-slider"
             class="flex gap-6 overflow-x-auto pb-6 scrollbar-hide snap-x snap-mandatory">

            <?php foreach ($certificates as $cert): ?>
            <div class="cert-card bg-white rounded-xl shadow-md p-4 text-center
            w-[380px] flex-none snap-center">

                <div class="cert-image-wrapper mb-3">
                    <?php if ($cert['gambar']): ?>
                        <img src="/<?= esc($cert['gambar']) ?>"
                             alt="<?= esc($cert['nama_sertifikat']) ?>"
                             class="cert-image">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center bg-gray-100 rounded-lg">
                            <i class="fas fa-certificate text-gray-400 text-3xl"></i>
                        </div>
                    <?php endif; ?>
                </div>

                <h3 class="font-medium text-gray-800 text-sm leading-tight">
                    <?= esc($cert['nama_sertifikat']) ?>
                </h3>
            </div>
            <?php endforeach; ?>

        </div>
    </div>

</div>
</section>

<?= $this->endSection() ?>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const slider = document.getElementById("cert-slider");
    const cards = document.querySelectorAll(".cert-card");

    function updateZoom() {
        const sliderRect = slider.getBoundingClientRect();
        const sliderCenter = sliderRect.left + sliderRect.width / 2;

        cards.forEach(card => {
            const rect = card.getBoundingClientRect();
            const cardCenter = rect.left + rect.width / 2;

            const distance = Math.abs(sliderCenter - cardCenter);

            /* ===== TUNING HALUS ===== */
            let scale = 1.0;

            if (distance < 120) {
                scale = 1.06;   // MAJU HALUS
            }

            card.style.transform = `scale(${scale})`;
            card.style.boxShadow =
                scale > 1
                    ? "0 18px 40px rgba(0,0,0,0.18)"
                    : "0 6px 14px rgba(0,0,0,0.08)";
        });
    }

    slider.addEventListener("scroll", updateZoom);
    window.addEventListener("resize", updateZoom);
    updateZoom();
});
</script>
