<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin - Genegraft Labs</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg">

    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-1">Buat Akun Admin</h1>
        <p class="text-gray-600 text-sm">Masukkan data lengkap Anda untuk mengelola dashboard.</p>
    </div>

    <!-- Error general -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded mb-3">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- Error validation -->
    <?php $errors = session()->getFlashdata('errors'); ?>
    <?php if (!empty($errors)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded mb-3">
            <ul class="list-disc list-inside text-sm">
                <?php foreach ($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('admin/register') ?>" method="POST" class="space-y-3">
        <?= csrf_field() ?>

        <!-- Nama Lengkap -->
        <div>
            <label for="nama_admin" class="block text-gray-700 text-sm font-semibold mb-1">Nama Lengkap</label>
            <input type="text" id="nama_admin" name="nama_admin" value="<?= old('nama_admin') ?>" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-gray-700 text-sm font-semibold mb-1">Email</label>
            <input type="email" id="email" name="email" value="<?= old('email') ?>" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>

        <!-- Username -->
        <div>
            <label for="username" class="block text-gray-700 text-sm font-semibold mb-1">Username</label>
            <input type="text" id="username" name="username" value="<?= old('username') ?>" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-gray-700 text-sm font-semibold mb-1">Password</label>
            <div class="relative">
                <input type="password" id="password" name="password" required minlength="6"
                       class="w-full px-3 py-2 pr-9 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                <button type="button" class="absolute right-2 top-2 text-gray-400 hover:text-gray-600 toggle-password"
                        data-target="#password">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <!-- Konfirmasi Password -->
        <div>
            <label for="password_confirm" class="block text-gray-700 text-sm font-semibold mb-1">Konfirmasi Password</label>
            <div class="relative">
                <input type="password" id="password_confirm" name="password_confirm" required minlength="6"
                       class="w-full px-3 py-2 pr-9 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                <button type="button" class="absolute right-2 top-2 text-gray-400 hover:text-gray-600 toggle-password"
                        data-target="#password_confirm">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block text-gray-700 text-sm font-semibold mb-1">Role</label>
            <select id="role" name="role" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                <option value="">Pilih Role</option>
                <!-- <option value="Editor" <?= old('role') === 'Editor' ? 'selected' : '' ?>>Editor</option>
                <option value="Manager" <?= old('role') === 'Manager' ? 'selected' : '' ?>>Manager</option> -->
                <option value="Super Admin" <?= old('role') === 'Super Admin' ? 'selected' : '' ?>>Super Admin</option>
            </select>
        </div>

        <div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-700">
                Daftar Sekarang
            </button>
        </div>
    </form>

    <div class="mt-4 text-center text-sm text-gray-600">
        <p>Sudah punya akun?
            <a href="<?= site_url('login') ?>" class="text-blue-600 font-semibold hover:underline">Kembali ke login</a>
        </p>
    </div>

</div>

<script>
document.querySelectorAll('.toggle-password').forEach(btn => {
    btn.addEventListener('click', function() {
        const target = document.querySelector(this.dataset.target);
        target.type = target.type === 'password' ? 'text' : 'password';
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
});
</script>

</body>
</html>
