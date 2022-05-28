<?php

namespace App\Controllers;

use \App\Models\LainnyaModel;
use \App\Models\MuzakkiModel;
use \App\Models\KategoriModel;

class Lainnya extends BaseController
{
    protected $LainnyaModel;
    protected $MuzakkiModel;
    protected $KategoriModel;

    public function __construct()
    {
        $this->LainnyaModel = new LainnyaModel();
        $this->MuzakkiModel = new MuzakkiModel();
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
            'data' => $this->LainnyaModel->getAll()
        ];
        return view('lainnya/index', $data);
    }

    public function create()
    {
        if (!isset($_SESSION['status'])) {
            return redirect()->to('/admin/login');
        } else {
            if ($_SESSION['status'] != 'admin') {
                return redirect()->to('/admin/login');
            }
        }
        $data = [
            'title' => 'Distribusi Mustahik',
            'kategori' => $this->KategoriModel->lainnya(),
            'validation' => \Config\Services::validation()
        ];
        // dd($data['muzakki'], $data['jenis_bayar']);
        return view('lainnya/create', $data);
    }

    public function tambah()
    {
        if (!isset($_SESSION['status'])) {
            return redirect()->to('/admin/login');
        } else {
            if ($_SESSION['status'] != 'admin') {
                return redirect()->to('/admin/login');
            }
        }
        // validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mustahik harus diisi'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kategori harus dipilih'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/lainnya/create')->withInput()->with('validation', $validation);
        }
        $this->LainnyaModel->tambah($this->request->getVar('nama'), $this->request->getVar('kategori'), $this->request->getVar('hak'));

        return redirect()->to('/lainnya');
    }

    public function getKategori()
    {
        if (!isset($_SESSION['status'])) {
            return redirect()->to('/admin/login');
        } else {
            if ($_SESSION['status'] != 'admin') {
                return redirect()->to('/admin/login');
            }
        }
        $id = $this->request->getVar('id');
        echo json_encode($this->MuzakkiModel->getjumlah($id));
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
            'title' => 'Bayar Zakat',
            'data' => $this->LainnyaModel->getAllById($id),
            'kategori' => $this->KategoriModel->lainnya(),
            'validation' => \Config\Services::validation()
        ];

        return view('lainnya/ubah', $data);
    }

    public function edit($id)
    {
        if (!isset($_SESSION['status'])) {
            return redirect()->to('/admin/login');
        } else {
            if ($_SESSION['status'] != 'admin') {
                return redirect()->to('/admin/login');
            }
        }
        // validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama harus dipilih'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kategori harus dipilih'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/lainnya/edit/' . $id)->withInput()->with('validation', $validation);
        }

        $kategori = $this->request->getVar('kategori');
        $hak = $this->request->getVar('hak');
        $nama = $this->request->getVar('nama');
        $this->LainnyaModel->edit($id, $kategori, $hak, $nama);
        return redirect()->to('/lainnya');
    }

    public function hapus($id)
    {
        if (!isset($_SESSION['status'])) {
            return redirect()->to('/admin/login');
        } else {
            if ($_SESSION['status'] != 'admin') {
                return redirect()->to('/admin/login');
            }
        }
        $this->LainnyaModel->hapus($id);
        return redirect()->to('/lainnya');
    }

    public function detail($id)
    {
        if (!isset($_SESSION['status'])) {
            return redirect()->to('/admin/login');
        } else {
            if ($_SESSION['status'] != 'admin') {
                return redirect()->to('/admin/login');
            }
        }
        $data = [
            'title' => 'Detail Mustahik',
            'data' => $this->LainnyaModel->getAllById($id),
            'validation' => \Config\Services::validation()
        ];
        // dd('makan');
        return view('lainnya/detail', $data);
    }
}
