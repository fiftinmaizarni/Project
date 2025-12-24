<?php

namespace App\Controllers\Admin;

use App\Models\ProductModel;
use App\Models\DocumentModel;
use App\Models\LocationModel;
use App\Models\CertificateModel;

class DashboardController extends BaseAdminController
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

    public function index()
    {
        $month = date('m');
        $year  = date('Y');

        $activityDataRaw = $this->activityModel->getWeeklyActivity($month, $year);
        $activityData = [];
        foreach ($activityDataRaw as $weekData) {
            $activityData[] = [
                'week'  => 'Minggu ' . $weekData['week'],
                'count' => $weekData['count']
            ];
        }

        $data = [
            'title'            => 'Dashboard',
            'total_produk'     => $this->productModel->countAllResults(),
            'total_dokumen'    => $this->documentModel->countAllResults(),
            'total_lokasi'     => $this->locationModel->countAllResults(),
            'total_sertifikat' => $this->certificateModel->countAllResults(),
            'activityData'     => $activityData
        ];

        return view('admin/dashboard', $data);
    }
}
