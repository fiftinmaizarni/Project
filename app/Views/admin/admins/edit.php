<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<style>
    .password-wrapper {
        position: relative;
    }

    .eye-btn {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
        font-size: 18px;
        line-height: 1;
    }
</style>

<div class="max-w-3xl mx-auto">
    <a href="<?= site_url('admin/admins') ?>" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>

    <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Admin</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="<?= site_url('admin/admins/update/' . $admin['id_admin']) ?>" method="POST">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label class="block">Nama Admin *</label>
                <input type="text" name="nama_admin" value="<?= esc($admin['nama_admin']) ?>" required
                    class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block">Username *</label>
                <input type="text" name="username" value="<?= esc($admin['username']) ?>" required
                    class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block">Email *</label>
                <input type="email" name="email" value="<?= esc($admin['email']) ?>" required
                    class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block">Password (Kosongkan jika tidak diubah)</label>

                <div class="flex items-center border rounded-lg px-4">
                    <input type="password" id="password" name="password"
                        class="w-full py-2 focus:outline-none" />

                    <span class="cursor-pointer" onclick="togglePassword()">
                        <i id="eye-icon" class="fas fa-eye text-gray-600"></i>
                    </span>
                </div>
            </div>

            <div class="mb-6">
                <label class="block">Role *</label>
                <select name="role" class="w-full px-4 py-2 border rounded-lg" required>
                    <!-- <option value="Editor" <?= $admin['role']=='Editor'?'selected':'' ?>>Editor</option>
                    <option value="Manager" <?= $admin['role']=='Manager'?'selected':'' ?>>Manager</option> -->
                    <option value="Super Admin" <?= $admin['role']=='Super Admin'?'selected':'' ?>>Super Admin</option>
                </select>
            </div>

            <button class="bg-blue-500 text-white px-6 py-2 rounded-lg">Update</button>

        </form>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const icon  = document.getElementById('eye-icon');

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>

<?= $this->endSection() ?>
