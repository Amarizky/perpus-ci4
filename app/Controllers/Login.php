<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    protected $request;

    public function __construct()
    {
        $this->request = \Config\Services::request();
    }
    public function index()
    {
        $data = [
            'pageTitle' => 'Perpustakaan',
        ];

        return view('login', $data);
    }

    public function login_visitor()
    {
        $name      = ucwords($this->request->getPost('name'));
        $classroom = strtoupper($this->request->getPost('classroom'));

        $visitorModel = new \App\Models\VisitorModel();
        $visitorModel->visit($name, $classroom);

        return redirect()->to('/visitor');
    }

    public function login_admin()
    {
        $username  = $this->request->getPost('username');
        $password  = $this->request->getPost('password');

        $adminModel = new \App\Models\AdminModel();
        if ($adminModel->verifyLogin($username, $password)) {
            return redirect()->to('/admin/books');
        } else {
            session()->setFlashdata([
                'alert' => [
                    'status' => 'danger',
                    'message' => 'Kata sandi salah! Silahkan coba lagi!',
                ]
            ]);
            return redirect('/')->withInput();
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
