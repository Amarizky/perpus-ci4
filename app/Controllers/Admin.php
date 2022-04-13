<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;

class Admin extends BaseController
{
    public function index()
    {
        $bookModel = new BookModel();
        $page = $this->request->getGet('page') ?? 1;
        $bookList = $bookModel->getAllBooks();

        // dd([
        //     'pageTitle' => 'Daftar Buku',
        //     'bookList'  => $bookList->paginate(20),
        //     'pager'     => $bookList->pager,
        //     'page'      => $page,
        // ]);

        return view('admin/book_list', [
            'pageTitle' => 'Daftar Buku',
            'bookList'  => $bookList->paginate(20),
            'pager'     => $bookList->pager,
            'page'      => $page,
        ]);
    }
    public function test()
    {
        $bookModel = new BookModel();
        $page = $this->request->getGet('page') ?? 1;

        dd([
            'pageTitle' => 'Daftar Buku Test',
            'bookList'  => $bookModel->getAllBooksTest()->paginate(20),
            'pager'     => $bookModel->pager
        ]);

        return view('admin/book_list', [
            'pageTitle' => 'Daftar Buku Test',
            'bookList'  => $bookModel->getAllBooksTest(),
            'pager'     => $bookModel->pager
        ]);
    }
}
