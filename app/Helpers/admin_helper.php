<?php
use App\Models\AdminActivityModel;

if (!function_exists('logAdminActivity')) {
    function logAdminActivity($action) {
        $activityModel = new AdminActivityModel();
        $activityModel->insert([
            'admin_id'   => session()->get('admin_id'),
            'action'     => $action,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
