<?php

namespace App\Controllers;

use \App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $KategoriModel;
    public function __construct()
    {
        $this->KategoriModel = new KategoriModel();
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
            'kategori' => $this->KategoriModel->findAll()
        ];
        return view('kategori/index', $data);
    }

    public function getKategoriById()
    {
        if (!isset($_SESSION['status'])) {
            return redirect()->to('/admin/login');
        } else {
            if ($_SESSION['status'] != 'admin') {
                return redirect()->to('/admin/login');
            }
        }
        $id = $this->request->getVar('id');
        echo json_encode($this->KategoriModel->getKategoriById($id));
    }
}
