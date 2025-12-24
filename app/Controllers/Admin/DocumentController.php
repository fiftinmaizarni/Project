<?php

namespace App\Controllers\Admin;

use App\Models\DocumentModel;
use App\Models\ProductModel;

class DocumentController extends BaseAdminController
{
    protected $documentModel;
    protected $productModel;

    public function __construct()
    {
        $this->documentModel = new DocumentModel();
        $this->productModel  = new ProductModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Dokumen',
            'documents' => $this->documentModel->getDocumentsWithProduct(),
        ];

        return view('admin/documents/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Upload Dokumen',
            'products' => $this->productModel->findAll(),
        ];

        return view('admin/documents/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'product_id'    => 'required',
            'jenis_dokumen' => 'required',
            'file'          => 'uploaded[file]|max_size[file,15360]|ext_in[file,pdf]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $file = $this->request->getFile('file');
        $newName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads/documents', $newName);

        $data = [
            'product_id'    => $this->request->getPost('product_id'),
            'jenis_dokumen' => $this->request->getPost('jenis_dokumen'),
            'nama_file'     => $file->getClientName(),
            'ukuran'        => $this->formatBytes($file->getSize()),
            'path'          => 'uploads/documents/' . $newName,
        ];

        $this->documentModel->insert($data);

        // Catat aktivitas admin
        $this->logActivity("Mengupload dokumen: " . $data['nama_file']);


        return redirect()->to('/admin/documents')->with('success', 'Dokumen berhasil diupload');
    }

    public function edit($id)
    {
        $document = $this->documentModel->find($id);
        if (!$document) {
            return redirect()->to('/admin/documents')->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Dokumen',
            'document' => $document,
            'products' => $this->productModel->findAll(),
        ];

        return view('admin/documents/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'product_id'    => 'required',
            'jenis_dokumen' => 'required',
            'file'          => 'ext_in[file,pdf]|max_size[file,15360]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $document = $this->documentModel->find($id);
        if (!$document) {
            return redirect()->to('/admin/documents')->with('error', 'Data tidak ditemukan');
        }

        $file = $this->request->getFile('file');
        $path = $document['path'];
        $updateData = [
            'product_id'    => $this->request->getPost('product_id'),
            'jenis_dokumen' => $this->request->getPost('jenis_dokumen')
        ];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($document['path'] && file_exists(ROOTPATH . 'public/' . $document['path'])) {
                unlink(ROOTPATH . 'public/' . $document['path']);
            }

            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/documents', $newName);

            $updateData['nama_file'] = $file->getClientName();
            $updateData['ukuran']    = $this->formatBytes($file->getSize());
            $updateData['path']      = 'uploads/documents/' . $newName;
        }

        $this->documentModel->update($id, $updateData);

        // Catat aktivitas admin
        $namaFile = $updateData['nama_file'] ?? $document['nama_file'];
        $this->logActivity("Mengupdate dokumen: " . $namaFile);


        return redirect()->to('/admin/documents')->with('success', 'Dokumen berhasil diperbarui');
    }

    public function delete($id)
    {
        $document = $this->documentModel->find($id);

        if ($document && $document['path'] && file_exists(ROOTPATH . 'public/' . $document['path'])) {
            unlink(ROOTPATH . 'public/' . $document['path']);
        }

        $this->documentModel->delete($id);

        // Catat aktivitas admin
        $this->logActivity("Menghapus dokumen: " . $document['nama_file']);

        return redirect()->to('/admin/documents')->with('success', 'Dokumen berhasil dihapus');
    }

    private function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = ['B', 'KB', 'MB', 'GB'];
        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }
}
