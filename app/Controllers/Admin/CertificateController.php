<?php

namespace App\Controllers\Admin;

use App\Models\CertificateModel;

class CertificateController extends BaseAdminController
{
    protected $certificateModel;

    public function __construct()
    {
        $this->certificateModel = new CertificateModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Sertifikat',
            'certificates' => $this->certificateModel->findAll(),
        ];

        return view('admin/certificates/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Sertifikat Baru',
        ];

        return view('admin/certificates/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_sertifikat' => 'required',
            // max_size dalam KB → 15360 = 15 MB
            'gambar'          => 'uploaded[gambar]|max_size[gambar,15360]|is_image[gambar]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $file = $this->request->getFile('gambar');
        $gambar = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/certificates', $newName);
            $gambar = 'uploads/certificates/' . $newName;
        }

        $data = [
            'nama_sertifikat' => $this->request->getPost('nama_sertifikat'),
            'gambar' => $gambar,
        ];

        $this->certificateModel->insert($data);

        // Catat aktivitas admin
        $this->logActivity("Menambahkan sertifikat: " . $data['nama_sertifikat']);

        return redirect()->to('/admin/certificates')->with('success', 'Sertifikat berhasil ditambahkan');
    }

    public function delete($id)
    {
        $certificate = $this->certificateModel->find($id);
        if ($certificate && $certificate['gambar'] && file_exists(ROOTPATH . 'public/' . $certificate['gambar'])) {
            unlink(ROOTPATH . 'public/' . $certificate['gambar']);
        }

        $this->certificateModel->delete($id);

        // Catat aktivitas admin
        $this->logActivity("Menghapus sertifikat: " . $certificate['nama_sertifikat']);

        return redirect()->to('/admin/certificates')->with('success', 'Sertifikat berhasil dihapus');
    }
}
