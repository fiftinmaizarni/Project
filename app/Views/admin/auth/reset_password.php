<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset Password</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg">
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-1">Reset Password</h1>
        <p class="text-gray-600 text-sm">Masukkan password baru Anda.</p>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded mb-3">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('admin/reset-password') ?>" method="POST" class="space-y-3">
        <?= csrf_field() ?>
        <input type="hidden" name="token" value="<?= $token ?>">

        <div>
            <label>Password Baru</label>
            <div class="relative">
                <input type="password" name="password" required minlength="6" class="w-full px-3 py-2 pr-9 border rounded-lg">
                <button type="button" class="absolute right-2 top-2 toggle-password"><i class="fas fa-eye"></i></button>
            </div>
        </div>

        <div>
            <label>Konfirmasi Password</label>
            <div class="relative">
                <input type="password" name="password_confirm" required minlength="6" class="w-full px-3 py-2 pr-9 border rounded-lg">
                <button type="button" class="absolute right-2 top-2 toggle-password"><i class="fas fa-eye"></i></button>
            </div>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2.5 rounded-lg">Simpan Password Baru</button>
    </form>
</div>

<script>
document.querySelectorAll('.toggle-password').forEach(btn => {
    btn.addEventListener('click', function() {
        let input = this.parentElement.querySelector("input");
        input.type = input.type === "password" ? "text" : "password";
        this.querySelector("i").classList.toggle("fa-eye");
        this.querySelector("i").classList.toggle("fa-eye-slash");
    });
});
</script>
</body>
</html>
