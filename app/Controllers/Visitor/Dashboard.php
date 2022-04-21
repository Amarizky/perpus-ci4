<?php

namespace App\Controllers\Visitor;

use App\Models\BookModel;
use App\Models\VisitorModel;
use App\Models\CategoryModel;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $bookModel     = new BookModel();
        $categoryModel = new CategoryModel();
        $visitorModel  = new VisitorModel();

        $page          = $this->request->getGet('page') ?? 1;

        $data = [
            'pageTitle'        => 'Statistik Pengguna',
            'borrowedBookList' => $bookModel->getBorrowedBooks()->limit(5)->find(),
            'recentBookList'   => $bookModel->getRecentlyBorrowedBooks()->limit(5)->find(),
            'page'             => $page,
            'categories'       => $categoryModel->findAll(),
            'visitor'          => $visitorModel->getVisitor(),
        ];

        return view('visitor/dashboard', $data);
    }
}
