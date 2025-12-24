<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\AboutUsModel;

class HomeController extends BaseController
{
    protected $productModel;
    protected $aboutUsModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->aboutUsModel = new AboutUsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'about' => $this->aboutUsModel->getAboutUs(),
        ];

        return view('frontend/home', $data);
    }
}

