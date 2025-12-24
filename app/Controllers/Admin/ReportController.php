<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\DocumentModel;
use App\Models\LocationModel;
use App\Models\CertificateModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class ReportController extends BaseController
{
    protected $productModel;
    protected $documentModel;
    protected $locationModel;
    protected $certificateModel;

    public function __construct()
    {
        $this->productModel     = new ProductModel();
        $this->documentModel    = new DocumentModel();
        $this->locationModel    = new LocationModel();
        $this->certificateModel = new CertificateModel();
    }

    // ======================
    // HALAMAN REPORT
    // ======================
    public function index()
    {
        return view('admin/reports/index');
    }

    // ======================
    // EXPORT PRODUK
    // ======================
    public function exportProducts()
    {
        $data = $this->productModel->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray([
            ['ID', 'Nama Produk', 'Kategori', 'Stok', 'Spesifikasi', 'Deskripsi']
        ], null, 'A1');

        $row = 2;
        foreach ($data as $item) {
            $sheet->fromArray([
                $item['id'],
                $item['nama_produk'],
                $item['kategori'],
                $item['stok'],
                $item['spesifikasi'],
                $item['deskripsi'] ?? ''
            ], null, 'A' . $row++);
        }

        $this->downloadCsv($spreadsheet, 'laporan_produk.csv');
    }

    // ======================
    // EXPORT DOKUMEN
    // ======================
    public function exportDocuments()
    {
        $data = $this->documentModel
            ->select('documents.*, products.nama_produk')
            ->join('products', 'products.id = documents.product_id')
            ->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray([
            ['ID', 'Nama Produk', 'Jenis Dokumen', 'Nama File', 'Ukuran']
        ], null, 'A1');

        $row = 2;
        foreach ($data as $item) {
            $sheet->fromArray([
                $item['id'],
                $item['nama_produk'],
                $item['jenis_dokumen'],
                $item['nama_file'],
                $item['ukuran']
            ], null, 'A' . $row++);
        }

        $this->downloadCsv($spreadsheet, 'laporan_dokumen.csv');
    }

    // ======================
    // EXPORT LOKASI
    // ======================
    public function exportLocations()
    {
        $data = $this->locationModel->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray([
            ['ID', 'Nama Lokasi', 'Alamat', 'Telepon', 'Email', 'Jam Kerja']
        ], null, 'A1');

        $row = 2;
        foreach ($data as $item) {
            $sheet->fromArray([
                $item['id'],
                $item['nama_lokasi'],
                $item['alamat'],
                $item['telepon'],
                $item['email'],
                $item['jam_kerja'] ?? ''
            ], null, 'A' . $row++);
        }

        $this->downloadCsv($spreadsheet, 'laporan_lokasi.csv');
    }

    // ======================
    // EXPORT SERTIFIKAT
    // ======================
    // ======================
// EXPORT SERTIFIKAT
// ======================
public function exportCertificates()
{
    $data = $this->certificateModel->findAll();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->fromArray([
        ['ID', 'Nama Sertifikat', 'Nama File']
    ], null, 'A1');

    $row = 2;
    foreach ($data as $item) {
        $namaFile = $item['gambar']
            ? basename($item['gambar'])
            : '';

        $sheet->fromArray([
            $item['id'],
            $item['nama_sertifikat'],
            $namaFile
        ], null, 'A' . $row++);
    }

    $this->downloadCsv($spreadsheet, 'laporan_sertifikat.csv');
}


    // ======================
    // HELPER DOWNLOAD CSV
    // ======================
    private function downloadCsv(Spreadsheet $spreadsheet, string $filename)
{
    $writer = new Csv($spreadsheet);

    // PENTING UNTUK EXCEL INDONESIA
    $writer->setDelimiter(';');   // ← WAJIB TITIK KOMA
    $writer->setEnclosure('"');
    $writer->setUseBOM(true);     // ← supaya UTF-8 & Excel aman
    $writer->setSheetIndex(0);

    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit;
}

}
