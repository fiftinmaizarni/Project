<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class AdminUserController extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data['admins'] = $this->adminModel->findAll();
        return view('admin/admins/index', $data);
    }

    public function create()
    {
        return view('admin/admins/create');
    }

    public function store()
    {
        $data = [
            'nama_admin' => $this->request->getPost('nama_admin'),
            'email'      => $this->request->getPost('email'),
            'username'   => $this->request->getPost('username'),
            'password'   => $this->request->getPost('password'), // di-hash di model
            'role'       => $this->request->getPost('role'),
        ];

        $this->adminModel->insert($data);

        return redirect()
            ->to('/admin/admins')
            ->with('success', 'Admin berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['admin'] = $this->adminModel->find($id);
        return view('admin/admins/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'nama_admin' => $this->request->getPost('nama_admin'),
            'email'      => $this->request->getPost('email'),
            'username'   => $this->request->getPost('username'),
            'role'       => $this->request->getPost('role'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password');
        }

        $this->adminModel->update($id, $data);

        return redirect()
            ->to('/admin/admins')
            ->with('success', 'Admin berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->adminModel->delete($id);

        return redirect()
            ->to('/admin/admins')
            ->with('success', 'Admin berhasil dihapus.');
    }
}
