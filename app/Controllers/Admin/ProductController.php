<?php

namespace App\Controllers\Admin;

use App\Models\ProductModel;

class ProductController extends BaseAdminController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Produk',
            'products' => $this->productModel->findAll(),
        ];

        return view('admin/products/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Produk',
        ];

        return view('admin/products/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_produk' => 'required',
            'kategori' => 'required',
            'spesifikasi' => 'required',
            'stok' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $file = $this->request->getFile('gambar');
        $gambar = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/products', $newName);
            $gambar = 'uploads/products/' . $newName;
        }

        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'kategori' => $this->request->getPost('kategori'),
            'spesifikasi' => $this->request->getPost('spesifikasi'),
            'stok' => $this->request->getPost('stok'),
            'gambar' => $gambar,
            'deskripsi' => $this->request->getPost('deskripsi'),
            'key_features' => $this->request->getPost('key_features'),
        ];

        $this->productModel->insert($data);

        // Catat aktivitas admin
        $this->logActivity("Menambahkan produk: " . $data['nama_produk']);

        return redirect()->to('/admin/products')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Produk',
            'product' => $this->productModel->find($id),
        ];

        return view('admin/products/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_produk' => 'required',
            'kategori' => 'required',
            'spesifikasi' => 'required',
            'stok' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $product = $this->productModel->find($id);
        $file = $this->request->getFile('gambar');
        $gambar = $product['gambar'];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($gambar && file_exists(ROOTPATH . 'public/' . $gambar)) {
                unlink(ROOTPATH . 'public/' . $gambar);
            }
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/products', $newName);
            $gambar = 'uploads/products/' . $newName;
        }

        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'kategori' => $this->request->getPost('kategori'),
            'spesifikasi' => $this->request->getPost('spesifikasi'),
            'stok' => $this->request->getPost('stok'),
            'gambar' => $gambar,
            'deskripsi' => $this->request->getPost('deskripsi'),
            'key_features' => $this->request->getPost('key_features'),
        ];

        $this->productModel->update($id, $data);

        // Catat aktivitas admin
        $this->logActivity("Mengupdate produk: " . $data['nama_produk']);

        return redirect()->to('/admin/products')->with('success', 'Produk berhasil diupdate');
    }

    public function delete($id)
    {
        $product = $this->productModel->find($id);
        if ($product && $product['gambar'] && file_exists(ROOTPATH . 'public/' . $product['gambar'])) {
            unlink(ROOTPATH . 'public/' . $product['gambar']);
        }

        $this->productModel->delete($id);

        // Catat aktivitas admin
        $this->logActivity("Menghapus produk: " . $product['nama_produk']);

        return redirect()->to('/admin/products')->with('success', 'Produk berhasil dihapus');
    }
}
