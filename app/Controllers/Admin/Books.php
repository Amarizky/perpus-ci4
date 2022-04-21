<?php

namespace App\Controllers\Admin;

use App\Models\BookModel;
use App\Models\CategoryModel;
use App\Controllers\BaseController;

class Books extends BaseController
{
    public function index()
    {
        $bookModel     = new BookModel();
        $categoryModel = new CategoryModel();

        $page          = $this->request->getGet('page') ?? 1;
        $bookList      = $bookModel->getAllBooks()
            ->orderBy('loaned', 'DESC')
            ->orderBy('b.title');

        return view('admin/books', [
            'pageTitle'   => 'Daftar Buku',
            'bookList'    => $bookList->paginate(20),
            'pager'       => $bookList->pager,
            'page'        => $page,
            'categories'  => $categoryModel->findAll(),
        ]);
    }

    public function add()
    {
        $title       = $this->request->getPost('title');
        $category_id = $this->request->getPost('category_id');
        $author      = $this->request->getPost('author');
        $year        = $this->request->getPost('year');

        $bookModel = new BookModel();
        $data      = [
            'title'       => $title,
            'category_id' => $category_id,
            'author'      => $author,
            'year'        => $year,
        ];

        if (!$bookModel->insert($data)) {
            session()->setFlashdata('errorFor', 'add');
            session()->setFlashdata('errors', $bookModel->errors());
            return redirect()->to('/admin#book_add')->withInput();
        }

        session()->setFlashdata('toast', [
            'title' => 'Buku',
            'message' => "Buku berjudul \"{$title}\" berhasil ditambahkan",
        ]);
        return redirect()->to('/admin');
    }

    public function edit()
    {
        $id          = $this->request->getPost('book_id');
        $title       = $this->request->getPost('title');
        $category_id = $this->request->getPost('category_id');
        $author      = $this->request->getPost('author');
        $year        = $this->request->getPost('year');

        $bookModel = new BookModel();
        $data      = [
            'title'        => $title,
            'category_id' => $category_id,
            'author'      => $author,
            'year'        => $year,
        ];

        if (!$bookModel->update($id, $data)) {
            session()->setFlashdata('errorFor', 'edit');
            session()->setFlashdata('errors', $bookModel->errors());
            return redirect()->to('/admin#book_edit')->withInput();
        }

        session()->setFlashdata('toast', [
            'title' => 'Buku',
            'message' => "Buku berjudul \"{$title}\" berhasil diedit",
        ]);
        return redirect()->to('/admin');
    }

    public function delete()
    {
        $id = $this->request->getPost('book_id');

        $bookModel = new BookModel();
        $book = $bookModel->withDeleted()->find($id);

        $bookModel->delete($id);

        session()->setFlashdata('toast', [
            'title' => 'Buku',
            'message' => "Buku berjudul \"{$book->title}\" berhasil dihapus",
        ]);
        return redirect()->to('/admin');
    }

    public function get_data()
    {
        if (!$this->request->isAJAX()) return;

        $bookModel = new BookModel();
        $id        = $this->request->getPost('book_id');
        $res       = $bookModel->getBook($id);
        $res->csrf = csrf_hash();

        return json_encode($res);
    }
}
