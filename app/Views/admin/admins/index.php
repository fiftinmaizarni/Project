<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<!-- HEADER -->
<div class="flex justify-between items-center mb-4">
    <h1 class="text-3xl font-bold text-gray-800">Daftar Admin</h1>
    <a href="<?= site_url('admin/admins/create') ?>" 
       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
        <i class="fas fa-plus mr-2"></i>Tambah Admin
    </a>
</div>


<?php if (session()->getFlashdata('success')): ?>
    <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 flex items-center">
        <i class="fas fa-times-circle mr-2"></i>
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<!-- TABEL ADMIN -->
<div class="bg-white rounded-lg shadow p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    No
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    Nama Admin
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    Username
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    Email
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    Role
                </th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                    Aksi
                </th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
            <?php if (!empty($admins)): ?>
                <?php $no = 1; ?>
                <?php foreach ($admins as $admin): ?>
                    <tr>
                        <td class="px-6 py-4">
                            <?= $no++ ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= esc($admin['nama_admin']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= esc($admin['username']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= esc($admin['email']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= esc($admin['role']) ?>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="<?= site_url('admin/admins/edit/' . $admin['id_admin']) ?>" 
                               class="text-yellow-500 hover:text-yellow-600 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>

                                     <a href="<?= site_url('admin/admins/delete/' . $admin['id_admin']) ?>"
                                         class="text-red-500 hover:text-red-600 confirm-delete"
                                         data-confirm="Yakin ingin menghapus admin ini?">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                        Belum ada admin.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
