<?php

namespace App\Controllers;

use \App\Models\AdminModel;

class Admin extends BaseController
{
    protected $AdminModel;
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
    }

    public function index()
    {
        if (!isset($_SESSION['status'])) {
            return redirect()->to('/admin/login');
        } else {
            if ($_SESSION['status'] != 'admin') {
                return redirect()->to('/admin/login');
            }
        }
        $data = [
            'title' => 'Master Data Muzakki',
            'admin' => $this->AdminModel->findAll()
        ];
        return view('admin/index', $data);
    }

    public function create()
    {
        // if (!isset($_SESSION['status'])) {
        //     return redirect()->to('/admin/login');
        // } else {
        //     if ($_SESSION['status'] != 'admin') {
        //         return redirect()->to('/admin/login');
        //     }
        // }
        $data = [
            'title' => 'Master Data Muzakki',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/create', $data);
    }

    public function tambah()
    {
        // if (!isset($_SESSION['status'])) {
        //     return redirect()->to('/admin/login');
        // } else {
        //     if ($_SESSION['status'] != 'admin') {
        //         return redirect()->to('/admin/login');
        //     }
        // }
        // validasi input
        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[admin.username]',
                'errors' => [
                    'required' => 'useranme harus diisi',
                    'is_unique' => 'username sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'password harus diisi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/admin/create')->withInput()->with('validation', $validation);
        }

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $password = password_hash($password, PASSWORD_DEFAULT);

        $this->AdminModel->save([
            'username' => $username,
            'password' => $password
        ]);

        return redirect()->to('/admin');
    }

    public function ubah($id)
    {
        if (!isset($_SESSION['status'])) {
            return redirect()->to('/admin/login');
        } else {
            if ($_SESSION['status'] != 'admin') {
                return redirect()->to('/admin/login');
            }
        }
        $data = [
            'title' => 'Master Data Muzakki',
            'admin' => $this->AdminModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/ubah', $data);
    }

    public function edit($id)
    {
        // validasi input
        $usernameLama = $this->request->getVar('usernameLama');
        $usernameLama = $this->AdminModel->find($id)['username'];
        $usernameBaru = $this->request->getVar('username');

        if ($usernameLama == $usernameBaru) {
            $rules = 'required';
        } else {
            $rules = 'required|is_unique[admin.username]';
        }

        if (!$this->validate([
            'username' => [
                'rules' => $rules,
                'errors' => [
                    'required' => 'useranme harus diisi',
                    'is_unique' => 'username sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'password harus diisi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/admin/ubah')->withInput()->with('validation', $validation);
        }

        $password = $this->request->getVar('password');
        $password = password_hash($password, PASSWORD_DEFAULT);

        $this->AdminModel->save([
            'id' => $id,
            'username' => $usernameBaru,
            'password' => $password
        ]);

        return redirect()->to('/admin');
    }

    public function login()
    {
        $data = ['title' => 'login'];
        return view('admin/login', $data);
    }

    public function valid()
    {
        // dd('makan');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        if ($this->AdminModel->login($username) != null) {
            $pass = $this->AdminModel->login($username)['password'];
            if (password_verify($password, $pass)) {
                $_SESSION['status'] = 'admin';
                $_SESSION['username'] = $username;
                return redirect()->to('/');
            } else {
                return redirect()->to('/admin/login');
            }
        } else {
            return redirect()->to('/admin/login');
        }
    }

    public function logout()
    {
        $_SESSION = [];
        session_unset();
        session_destroy();
        return redirect()->to('/admin/login');
    }
}
