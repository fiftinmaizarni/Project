<?php

namespace App\Controllers\Admin;

use App\Models\LocationModel;

class LocationController extends BaseAdminController
{
    protected $locationModel;

    public function __construct()
    {
        $this->locationModel = new LocationModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Lokasi',
            'locations' => $this->locationModel->findAll(),
        ];

        return view('admin/locations/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Lokasi Baru',
        ];

        return view('admin/locations/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_lokasi' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required|valid_email',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);
    
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    
        $jamMulai   = date('h:i A', strtotime($this->request->getPost('jam_mulai')));
        $jamSelesai = date('h:i A', strtotime($this->request->getPost('jam_selesai')));
        $jamKerja   = "Monday–Friday: $jamMulai – $jamSelesai";
    
        $data = [
            'nama_lokasi' => $this->request->getPost('nama_lokasi'),
            'alamat'      => $this->request->getPost('alamat'),
            'telepon'     => $this->request->getPost('telepon'),
            'email'       => $this->request->getPost('email'),
            'jam_kerja'   => $jamKerja,
        ];
    
        $this->locationModel->insert($data);
        return redirect()->to('/admin/locations')->with('success', 'Lokasi berhasil ditambahkan');
    }
    
    

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Lokasi',
            'location' => $this->locationModel->find($id),
        ];

        return view('admin/locations/edit', $data);
    }

    public function update($id)
{
    $validation = \Config\Services::validation();
    $validation->setRules([
        'nama_lokasi' => 'required',
        'alamat' => 'required',
        'telepon' => 'required',
        'email' => 'required|valid_email',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required',
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $jamMulai   = date('h:i A', strtotime($this->request->getPost('jam_mulai')));
    $jamSelesai = date('h:i A', strtotime($this->request->getPost('jam_selesai')));
    $jamKerja   = "Monday–Friday: $jamMulai – $jamSelesai";

    $data = [
        'nama_lokasi' => $this->request->getPost('nama_lokasi'),
        'alamat'      => $this->request->getPost('alamat'),
        'telepon'     => $this->request->getPost('telepon'),
        'email'       => $this->request->getPost('email'),
        'jam_kerja'   => $jamKerja,
    ];

    $this->locationModel->update($id, $data);
    return redirect()->to('/admin/locations')->with('success', 'Lokasi berhasil diupdate');
}


    public function delete($id)
    {
        $this->locationModel->delete($id);
        return redirect()->to('/admin/locations')->with('success', 'Lokasi berhasil dihapus');
    }
}

