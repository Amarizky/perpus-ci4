<?php

namespace App\Controllers\Visitor;

use App\Models\BookModel;
use App\Models\LoanModel;
use App\Models\VisitorModel;
use App\Models\CategoryModel;
use App\Controllers\BaseController;

class ReturnBook extends BaseController
{
    public function index()
    {
        $bookModel     = new BookModel();
        $categoryModel = new CategoryModel();
        $visitorModel  = new VisitorModel();

        $page          = $this->request->getGet('page') ?? 1;
        $bookList      = $bookModel->getBorrowedBooks();

        $data = [
            'pageTitle'   => 'Kembalikan Buku',
            'bookList'    => $bookList->get()->getResult(),
            'page'        => $page,
            'categories'  => $categoryModel->findAll(),
            'visitor'     => $visitorModel->getVisitor(),
        ];

        return view('visitor/return', $data);
    }

    public function return()
    {
        $loanModel = new LoanModel();
        $book_id   = $this->request->getPost('book_id');

        $loanModel->return($book_id);

        return redirect()->to('visitor/return');
    }
}
