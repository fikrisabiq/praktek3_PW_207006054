<?php

namespace App\Controllers;

use \App\Models\MuzakkiModel;

class Muzakki extends BaseController
{
    protected $MuzakkiModel;
    public function __construct()
    {
        $this->MuzakkiModel = new MuzakkiModel();
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
            'muzakki' => $this->MuzakkiModel->findAll()
        ];
        return view('muzakki/index', $data);
    }
}
