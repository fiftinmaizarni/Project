<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Genegraft Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-blue-600 flex items-center justify-center min-h-screen">

    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-md">

        <!-- Header & Logo -->
        <div class="text-center mb-6">
            <div class="flex justify-center mb-4">
                <a href="/">
                    <img src="/images/logo.png" alt="Genegraft Logo" class="h-12 w-auto">
                </a>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-2">Genegraft Admin</h1>
            <p class="text-gray-600 text-sm mb-1">Sistem Pengenalan Produk Kepada Customers</p>
            <p class="text-gray-600 text-sm">PT. Genegraft Labs - Distributor Life Science</p>
        </div>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form action="<?= site_url('admin/login') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?> <!-- Penting untuk keamanan -->

            <!-- Username -->
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-1" for="username">Username</label>
                <div class="relative">
                    <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="username" name="username" placeholder="Masukkan Username" required
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-1" for="password">Password</label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="password" id="password" name="password" placeholder="Masukkan Password" required
                        class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    
                    <!-- Toggle password -->
                    <button type="button"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none toggle-password"
                        data-target="#password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Lupa Password -->
            <div class="text-right">
                <a href="<?= site_url('admin/forgot-password') ?>" class="text-sm text-blue-600 hover:underline font-semibold">
                    Lupa Password?
                </a>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition">
                Masuk ke Dashboard
            </button>
        </form>

        <!-- Link ke register -->
        <div class="mt-4 text-center text-sm text-gray-600">
            <p>Belum punya akun admin? 
                <a href="<?= site_url('admin/register') ?>" class="text-blue-600 font-semibold hover:underline">
                    Daftar sekarang
                </a>
            </p>
        </div>

    </div>

    <!-- Script toggle password -->
    <script>
        document.querySelectorAll('.toggle-password').forEach(function(btn){
            btn.addEventListener('click', function(){
                const target = document.querySelector(this.dataset.target);
                if(target.type === 'password') target.type = 'text';
                else target.type = 'password';
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        });
    </script>

</body>
</html>

