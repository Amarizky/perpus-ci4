<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\CategoryModel;

class Admin extends BaseController
{
    public function index()
    {
        $bookModel     = new BookModel();
        $categoryModel = new CategoryModel();

        $page          = $this->request->getGet('page') ?? 1;
        $bookList      = $bookModel->getAllBooks();

        return view('admin/book_list', [
            'pageTitle'   => 'Daftar Buku',
            'bookList'    => $bookList->paginate(20),
            'pager'       => $bookList->pager,
            'page'        => $page,
            'categories'  => $categoryModel->findAll(),
        ]);
    }

    public function book_add()
    {
        $name = $this->request->getPost('name');
        $category_id = $this->request->getPost('category_id');
        $author = $this->request->getPost('author');
        $year = $this->request->getPost('year');

        $bookModel = new BookModel();
        $data      = [
            'name'        => $name,
            'category_id' => $category_id,
            'author'      => $author,
            'year'        => $year,
        ];

        if (!$bookModel->insert($data)) {
            session()->setFlashdata('errors', $bookModel->errors());
            return redirect()->to('/admin#book_add')->withInput();
        }

        return redirect()->to('/admin');
    }

    public function book_edit()
    {
        $bookModel = new BookModel();
        $id        = $this->request->getPost('book_id');
        $data      = [
            'name'        => $this->request->getPost('name'),
            'category_id' => $this->request->getPost('category_id'),
            'author'      => $this->request->getPost('author'),
            'year'        => $this->request->getPost('year'),
        ];

        if (!$bookModel->update($id, $data)) {
            session()->setFlashdata('errors', $bookModel->errors());
            return redirect()->to('/admin#book_edit')->withInput();
        }

        return redirect()->to('/admin');
    }

    public function get_book_data()
    {
        if (!$this->request->isAJAX()) return;

        $bookModel = new BookModel();
        $id        = $this->request->getPost('book_id');
        $res       = $bookModel->find($id);
        $res->csrf = csrf_hash();

        return json_encode($res);
    }
}
