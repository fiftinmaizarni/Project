<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin Panel') ?> - Genegraft Labs</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .sidebar-active {
            background-color: #3b82f6;
        }

        /* Sidebar collapse */
        .sidebar {
            width: 16rem;
            transition: all 0.3s ease;
        }

        .sidebar-collapsed {
            width: 4rem !important;
        }

        .sidebar-collapsed .menu-text {
            display: none !important;
        }

        .sidebar-collapsed .logo-container img {
            display: none !important;
        }

        .sidebar-collapsed .menu-item {
            justify-content: center !important;
        }
    </style>
</head>

<body class="bg-gray-100">
<div class="flex h-screen">

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar bg-blue-900 text-white flex flex-col">

       <!-- LOGO CENTER -->
        <div class="p-6 logo-container">
            <div class="flex justify-center">
                <img src="<?= base_url('images/logo2.png') ?>" class="h-16 w-auto cursor-default">
            </div>
        </div>


        <!-- MENU -->
        <nav class="flex-1 px-4">

            <a href="<?= site_url('admin/dashboard') ?>" class="menu-item flex items-center space-x-3 px-4 py-3 rounded mb-2 hover:bg-blue-800 
                <?= (uri_string() == 'admin/dashboard') ? 'sidebar-active' : '' ?>">
                <i class="fas fa-chart-bar"></i>
                <span class="menu-text">Dashboard</span>
            </a>

            <a href="<?= site_url('admin/products') ?>" class="menu-item flex items-center space-x-3 px-4 py-3 rounded mb-2 hover:bg-blue-800 
                <?= (strpos(uri_string(), 'admin/products') !== false) ? 'sidebar-active' : '' ?>">
                <i class="fas fa-box"></i>
                <span class="menu-text">Produk</span>
            </a>

            <a href="<?= site_url('admin/documents') ?>" class="menu-item flex items-center space-x-3 px-4 py-3 rounded mb-2 hover:bg-blue-800 
                <?= (strpos(uri_string(), 'admin/documents') !== false) ? 'sidebar-active' : '' ?>">
                <i class="fas fa-file"></i>
                <span class="menu-text">Dokumen</span>
            </a>

            <a href="<?= site_url('admin/locations') ?>" class="menu-item flex items-center space-x-3 px-4 py-3 rounded mb-2 hover:bg-blue-800 
                <?= (strpos(uri_string(), 'admin/locations') !== false) ? 'sidebar-active' : '' ?>">
                <i class="fas fa-map-marker-alt"></i>
                <span class="menu-text">Lokasi</span>
            </a>

            <a href="<?= site_url('admin/certificates') ?>" class="menu-item flex items-center space-x-3 px-4 py-3 rounded mb-2 hover:bg-blue-800 
                <?= (strpos(uri_string(), 'admin/certificates') !== false) ? 'sidebar-active' : '' ?>">
                <i class="fas fa-certificate"></i>
                <span class="menu-text">Sertifikat</span>
            </a>

            <a href="<?= site_url('admin/aboutus') ?>" class="menu-item flex items-center space-x-3 px-4 py-3 rounded mb-2 hover:bg-blue-800 
                <?= (strpos(uri_string(), 'admin/aboutus') !== false) ? 'sidebar-active' : '' ?>">
                <i class="fas fa-info-circle"></i>
                <span class="menu-text">About Us</span>
            </a>

            <a href="<?= site_url('admin/admins') ?>" class="menu-item flex items-center space-x-3 px-4 py-3 rounded mb-2 hover:bg-blue-800 
                <?= (strpos(uri_string(), 'admin/admins') !== false) ? 'sidebar-active' : '' ?>">
                <i class="fas fa-users"></i>
                <span class="menu-text">Admin</span>
            </a>

            <a href="<?= site_url('admin/reports') ?>" class="menu-item flex items-center space-x-3 px-4 py-3 rounded mb-2 hover:bg-blue-800 
                <?= (strpos(uri_string(), 'admin/reports') !== false) ? 'sidebar-active' : '' ?>">
                <i class="fas fa-download"></i>
                <span class="menu-text">Laporan</span>
            </a>

        </nav>

        <!-- Collapse Button -->
        <div class="p-4">
            <button id="toggleSidebar" class="w-full h-10 bg-blue-800 rounded flex items-center justify-center hover:bg-blue-700">
                <i class="fas fa-times"></i>
            </button>
        </div>

    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- HEADER -->
        <header class="bg-white shadow-sm px-8 py-4">
            <div class="flex justify-between items-center">
            
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Admin Panel</h1>
                    <p class="text-sm text-gray-600">Kelola konten dan data Genegraft Labs</p>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-user-circle text-gray-600"></i>
                        <span class="text-gray-800"><?= session()->get('nama') ?></span>
                    </div>

                    <!-- FIX: logout link -->
                    <a href="<?= site_url('admin/logout') ?>" class="text-red-600 hover:text-red-800">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>

            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="flex-1 overflow-y-auto p-8">
            <?= $this->renderSection('content') ?>
        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<!-- Sidebar Collapse Script -->
<script>
    const sidebar = document.getElementById('sidebar');
    const toggleSidebar = document.getElementById('toggleSidebar');

    toggleSidebar.addEventListener('click', function () {
        sidebar.classList.toggle('sidebar-collapsed');
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-times');
        icon.classList.toggle('fa-bars');
    });
</script>

<!-- Global confirm modal -->
<div id="confirmModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
        <div class="px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-800">Konfirmasi</h3>
        </div>
        <div class="px-6 py-2 text-gray-700" id="confirmModalMessage">Apakah Anda yakin?</div>
        <div class="px-6 py-4 flex justify-end space-x-2">
            <button id="confirmCancel" class="px-4 py-2 bg-gray-200 rounded">Batal</button>
            <button id="confirmOk" class="px-4 py-2 bg-blue-600 text-white rounded">Oke</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let modal = document.getElementById('confirmModal');
    let msgEl = document.getElementById('confirmModalMessage');
    let okBtn = document.getElementById('confirmOk');
    let cancelBtn = document.getElementById('confirmCancel');
    let pendingAction = null;

    function openConfirm(message, action) {
        msgEl.textContent = message || 'Apakah Anda yakin?';
        pendingAction = action;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeConfirm() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        pendingAction = null;
    }

    cancelBtn.addEventListener('click', function () {
        closeConfirm();
    });

    okBtn.addEventListener('click', function () {
        if (!pendingAction) return closeConfirm();

        // If action is a link, navigate
        if (pendingAction.tagName === 'A') {
            window.location = pendingAction.getAttribute('href');
            return;
        }

        // If action is a button inside a form, submit the form
        if (pendingAction.tagName === 'BUTTON' || pendingAction.tagName === 'INPUT') {
            let form = pendingAction.closest('form');
            if (form) form.submit();
            else pendingAction.click();
            return;
        }

        // Fallback: if provided a function
        if (typeof pendingAction === 'function') pendingAction();
    });

    // Delegate for delete links
    document.body.addEventListener('click', function (e) {
        const el = e.target.closest('.confirm-delete');
        if (!el) return;
        e.preventDefault();
        const message = el.getAttribute('data-confirm') || 'Yakin ingin menghapus?';
        openConfirm(message, el);
    });

    // Delegate for save buttons
    document.body.addEventListener('click', function (e) {
        const el = e.target.closest('.confirm-save');
        if (!el) return;
        // Only handle submit buttons (type=submit) or anchors that submit
        if (el.tagName === 'BUTTON' || el.tagName === 'INPUT') {
            e.preventDefault();
            const message = el.getAttribute('data-confirm') || 'Yakin ingin menyimpan perubahan?';
            openConfirm(message, el);
        }
    });
});
</script>

<?= $this->renderSection('scripts') ?>

</body>
</html>
