<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\CategoryModel;
use App\Models\VisitorModel;
use App\Models\LoanModel;

class Visitor extends BaseController
{
    public function index()
    {
        // TODO: Dashboard with 2 tables
        return redirect()->to('visitor/borrow');
    }

    public function borrow()
    {
        $bookModel     = new BookModel();
        $categoryModel = new CategoryModel();
        $visitorModel  = new VisitorModel();

        $page          = $this->request->getGet('page') ?? 1;
        $bookList      = $bookModel->getAllBooks()->orderBy('books.title');

        $data = [
            'pageTitle'   => 'Pinjam Buku',
            'bookList'    => $bookList->paginate(20),
            'pager'       => $bookList->pager,
            'page'        => $page,
            'categories'  => $categoryModel->findAll(),
            'visitor'     => $visitorModel->getVisitor()->getRow(),
        ];

        return view('visitor/borrow', $data);
    }

    public function book_borrow()
    {
        $loanModel     = new LoanModel();
        $book_id = $this->request->getPost('book_id');

        $loanModel->borrow($book_id);

        return redirect()->to('visitor/borrow');
    }

    public function return()
    {
    }

    public function book_return()
    {
        return redirect()->to('visitor/return');
    }
}
