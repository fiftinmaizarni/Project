<?php

namespace App\Controllers;

use App\Models\DocumentModel;
use CodeIgniter\Controller;

class DownloadController extends Controller
{
    public function document($id)
    {
        $documentModel = new DocumentModel();
        $doc = $documentModel->find($id);

        if (!$doc) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $filePath = WRITEPATH . '../public/' . $doc['path'];

        if (!file_exists($filePath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // ⬇️ INI PENTING: nama file SESUAI input admin
        return $this->response->download(
            $filePath,
            null
        )->setFileName($doc['nama_file']);
    }
}
