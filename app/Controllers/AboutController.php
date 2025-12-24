<?php

namespace App\Controllers;

use App\Models\AboutUsModel;
use App\Models\CertificateModel;

class AboutController extends BaseController
{
    protected $aboutUsModel;
    protected $certificateModel;

    public function __construct()
    {
        $this->aboutUsModel = new AboutUsModel();
        $this->certificateModel = new CertificateModel();
    }

    public function index()
    {
        $data = [
            'title' => 'About Us',
            'about' => $this->aboutUsModel->getAboutUs(),
            'certificates' => $this->certificateModel->findAll(),
        ];

        return view('frontend/about', $data);
    }
}

