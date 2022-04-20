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

    public function borrow()
    {
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

    public function book_borrow()
    {
        $loanModel = new LoanModel();
        $book_id   = $this->request->getPost('book_id');

        $loanModel->borrow($book_id);

        return redirect()->to('visitor/borrow');
    }

    public function return()
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

    public function book_return()
    {
        $loanModel = new LoanModel();
        $book_id   = $this->request->getPost('book_id');

        $loanModel->return($book_id);

        return redirect()->to('visitor/return');
    }
}
