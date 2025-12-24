<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminActivityModel;

class BaseAdminController extends BaseController
{
    protected $helpers = ['form', 'url'];
    protected $activityModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request, 
        \CodeIgniter\HTTP\ResponseInterface $response, 
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $session = session();
        // DEV MODE: auto-login admin
        if (! $session->get('is_logged_in')) {
            $session->set([
                'id_admin'     => 1,
                'nama'         => 'Dev Admin',
                'username'     => 'devadmin',
                'role'         => 'Super Admin',
                'is_logged_in' => true,
            ]);
        }

        // Load model aktivitas
        $this->activityModel = new AdminActivityModel();
    }

    /**
     * Catat aktivitas admin
     */
    protected function logActivity($action)
    {
        $session = session();
        if ($session->get('id_admin')) {
            $this->activityModel->insert([
                'admin_id'   => $session->get('id_admin'),
                'action'     => $action,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
