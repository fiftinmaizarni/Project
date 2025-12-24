<?php

namespace App\Controllers\Admin;

use App\Models\AboutUsModel;

class AboutUsController extends BaseAdminController
{
    protected $aboutUsModel;

    public function __construct()
    {
        $this->aboutUsModel = new AboutUsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen About Us',
            'about' => $this->aboutUsModel->getAboutUs(),
        ];

        return view('admin/aboutus/index', $data);
    }

    public function update()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'profil' => 'required',
            'visi' => 'required',
            'misi' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $about = $this->aboutUsModel->first();
        $data = [
            'profil' => $this->request->getPost('profil'),
            'visi' => $this->request->getPost('visi'),
            'misi' => $this->request->getPost('misi'),
            'budaya' => $this->request->getPost('budaya'),
        ];

        if ($about) {
            $this->aboutUsModel->update($about['id'], $data);
        } else {
            $this->aboutUsModel->insert($data);
        }

        return redirect()->to('/admin/aboutus')->with('success', 'About Us berhasil diupdate');
    }
}

