<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Visitor extends BaseController
{
    public function index()
    {
        // TODO: Dashboard with 2 tables
    }

    public function borrow()
    {
        $data = [
            'pageTitle' => 'Perpustakaan',
        ];

        return view('visitor/borrow', $data);
    }

    public function return()
    {
    }
}
