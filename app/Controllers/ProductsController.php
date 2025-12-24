<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\DocumentModel;

class ProductsController extends BaseController
{
    protected $productModel;
    protected $documentModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->documentModel = new DocumentModel();
    }

    public function index()
    {
        $kategori = $this->request->getGet('kategori');
        $search   = trim($this->request->getGet('q') ?? '');

        $productQuery = $this->productModel->orderBy('nama_produk', 'ASC');

        if ($kategori && $kategori !== 'all') {
            $productQuery = $productQuery->where('kategori', $kategori);
        }

        if ($search !== '') {
            $productQuery = $productQuery
                ->groupStart()
                ->like('nama_produk', $search)
                ->orLike('deskripsi', $search)
                ->orLike('spesifikasi', $search)
                ->groupEnd();
        }

        $products = $productQuery->findAll();

        $productIds = array_column($products, 'id');
        $documentsByProduct = [];
        if (!empty($productIds)) {
            $documents = $this->documentModel
                ->whereIn('product_id', $productIds)
                ->findAll();

            foreach ($documents as $doc) {
                $documentsByProduct[$doc['product_id']][] = $doc;
            }
        }

        $categoryRows = (new ProductModel())
            ->select('kategori')
            ->groupBy('kategori')
            ->orderBy('kategori', 'ASC')
            ->findAll();
        $categories = array_map(static fn ($row) => $row['kategori'], $categoryRows);

        $data = [
            'title' => 'Our Products',
            'products' => $products,
            'kategori' => $kategori ?? 'all',
            'categories' => $categories,
            'documentsByProduct' => $documentsByProduct,
            'search' => $search,
        ];

        return view('frontend/products/index', $data);
    }

    public function detail($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $documents = $this->documentModel->where('product_id', $id)->findAll();
        $allProducts = $this->productModel->findAll();

        $data = [
            'title' => $product['nama_produk'],
            'product' => $product,
            'documents' => $documents,
            'allProducts' => $allProducts,
            // also provide productsPreview for layout dropdown consistency
            'productsPreview' => $allProducts,
        ];

        return view('frontend/products/detail', $data);
    }
}

