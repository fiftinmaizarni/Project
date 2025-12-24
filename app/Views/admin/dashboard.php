<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div>
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard</h1>
    <p class="text-gray-600 mb-8">Pantau dan kelola semua data Genegraft Labs dengan mudah</p>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Produk</p>
                    <p class="text-3xl font-bold text-blue-600"><?= $total_produk ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-box text-blue-600 text-xl"></i>
                </div>
                
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Dokumen</p>
                    <p class="text-3xl font-bold text-blue-600"><?= $total_dokumen ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-file text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Lokasi</p>
                    <p class="text-3xl font-bold text-blue-600"><?= $total_lokasi ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Sertifikat</p>
                    <p class="text-3xl font-bold text-blue-600"><?= $total_sertifikat ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-certificate text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Tren Aktivitas Admin (4 Minggu)</h2>
            <canvas id="activityChart"></canvas>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Distribusi Konten</h2>
            <canvas id="distributionChart"></canvas>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// ==================== DISTRIBUSI KONTEN ====================
const distCtx = document.getElementById('distributionChart').getContext('2d');

new Chart(distCtx, {
    type: 'pie',
    data: {
        labels: ['Dokumen', 'Produk', 'Lokasi', 'Sertifikat'],
        datasets: [{
            data: [
                <?= $total_dokumen ?>,
                <?= $total_produk ?>,
                <?= $total_lokasi ?>,
                <?= $total_sertifikat ?>
            ],
            backgroundColor: ['#1E3A8A', '#3B82F6', '#60A5FA', '#93C5FD']
        }]
    },
    options: { responsive: true }
});

// ==================== TREN AKTIVITAS ADMIN ====================
const activityData = <?= json_encode($activityData) ?>;
const labels = activityData.map(item => item.week);
const counts = activityData.map(item => item.count);

const actCtx = document.getElementById('activityChart').getContext('2d');

new Chart(actCtx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Jumlah Aktivitas Admin',
            data: counts,
            borderColor: '#3b82f6',
            backgroundColor: 'rgba(59,130,246,0.2)',
            borderWidth: 2,
            tension: 0.4,
            fill: true,
            pointRadius: 6,
            pointBackgroundColor: '#3b82f6',
            pointBorderWidth: 2
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 }
            }
        }
    }
});
</script>
<?= $this->endSection() ?>
