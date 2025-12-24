<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Genegraft Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg">

    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-1">Lupa Password</h1>
        <p class="text-gray-600 text-sm">Masukkan email admin Anda untuk mereset password.</p>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded mb-3">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded mb-3">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('admin/forgot-password') ?>" method="POST" class="space-y-3">

        <?= csrf_field() ?>

        <!-- Email -->
        <div>
            <label for="email" class="block text-gray-700 text-sm font-semibold mb-1">Email Admin</label>
            <div class="relative">
                <input type="email" id="email" name="email" required
                       class="w-full px-3 py-2 pr-9 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                <i class="fas fa-envelope absolute right-3 top-3 text-gray-400"></i>
            </div>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-700">
            Kirim Link Reset Password
        </button>
    </form>

    <div class="mt-4 text-center text-sm text-gray-600">
        <p>
            <a href="<?= site_url('admin/login') ?>" class="text-blue-600 font-semibold hover:underline">
                Kembali ke login
            </a>
        </p>
    </div>

</div>

</body>
</html>
