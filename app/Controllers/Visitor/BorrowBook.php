<?php

namespace App\Controllers\Visitor;

use App\Models\BookModel;
use App\Models\LoanModel;
use App\Models\VisitorModel;
use App\Models\CategoryModel;
use App\Controllers\BaseController;

class BorrowBook extends BaseController
{
    public function index()
    {
        $router = \CodeIgniter\Config\Services::router();
        $bookModel     = new BookModel();
        $categoryModel = new CategoryModel();
        $visitorModel  = new VisitorModel();

        $page          = $this->request->getGet('page') ?? 1;
        $bookList      = $bookModel->getAllBooks()->orderBy('b.title');

        $data = [
            'pageTitle'   => 'Pinjam Buku',
            'bookList'    => $bookList->paginate(20),
            'pager'       => $bookList->pager,
            'page'        => $page,
            'categories'  => $categoryModel->findAll(),
            'visitor'     => $visitorModel->getVisitor(),
        ];

        return view('visitor/borrow', $data);
    }

    public function borrow()
    {
        $loanModel = new LoanModel();
        $book_id   = $this->request->getPost('book_id');

        $loanModel->borrow($book_id);

        return redirect()->to('visitor/borrow');
    }
}
