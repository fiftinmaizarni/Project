<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\ProductModel;

abstract class BaseController extends Controller
{
    protected $request;
    protected $session;

    protected $helpers = ['url', 'form', 'session'];

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // Session
        $this->session = \Config\Services::session();

        // ====================================================================
        // GLOBAL DATA: Products untuk dropdown & footer
        // ====================================================================
        $productModel = new ProductModel();

        $productsPreview = $productModel
            ->orderBy('nama_produk', 'ASC')
            ->findAll();

        // Gunakan renderer untuk kirim data global ke semua view
        $renderer = \Config\Services::renderer();
        $renderer->setData([
            'productsPreview' => $productsPreview
        ], 'raw');
    }
}
