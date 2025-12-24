<?php

namespace App\Controllers;

use App\Models\LocationModel;

class LocationsController extends BaseController
{
    protected $locationModel;

    public function __construct()
    {
        $this->locationModel = new LocationModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Our Locations',
            'locations' => $this->locationModel->findAll(),
        ];

        return view('frontend/locations', $data);
    }
}

