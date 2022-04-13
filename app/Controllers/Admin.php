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

        return view('admin/book_list', [
            'pageTitle' => 'Daftar Buku',
            'bookList'  => $bookList->paginate(20),
            'pager'     => $bookList->pager,
            'page'      => $page,
        ]);
    }
}
