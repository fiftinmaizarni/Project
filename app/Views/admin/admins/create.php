<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="max-w-3xl mx-auto">
    <a href="<?= site_url('admin/admins') ?>" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
    
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Tambah Admin</h1>
    <p class="text-gray-600 mb-6">Isi form di bawah untuk menambah admin baru</p>

    <?php if(session()->getFlashdata('errors')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc pl-5">
                <?php foreach(session()->getFlashdata('errors') as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="<?= site_url('admin/admins') ?>" method="post">

            <?= csrf_field() ?>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Admin *</label>
                <input type="text" name="nama_admin" value="<?= old('nama_admin') ?>" required
                    class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Username *</label>
                <input type="text" name="username" value="<?= old('username') ?>" required
                    class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email *</label>
                <input type="email" name="email" value="<?= old('email') ?>" required
                    class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Password *</label>

            <div class="relative">
                <input type="password" name="password" id="password" required minlength="6"
                    class="w-full px-4 py-2 border rounded-lg">

                <!-- Eye Icon -->
                <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer" onclick="togglePassword()">
                    <i id="eyeIcon" class="fas fa-eye text-gray-500"></i>
                </span>
            </div>
        </div>

        <script>
        function togglePassword() {
            const pass = document.getElementById("password");
            const icon = document.getElementById("eyeIcon");
            
            if (pass.type === "password") {
                pass.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                pass.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
        </script>


            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Role *</label>
                <select name="role" required class="w-full px-4 py-2 border rounded-lg">
                    <!-- <option value="Editor">Editor</option>
                    <option value="Manager">Manager</option> -->
                    <option value="Super Admin">Super Admin</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">Simpan Admin</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
