<?php

namespace App\Controllers;

use \App\Models\WargaModel;
use \App\Models\MuzakkiModel;
use \App\Models\KategoriModel;
use \App\Models\BayarzakatModel;

class Warga extends BaseController
{
    protected $WargaModel;
    protected $MuzakkiModel;
    protected $KategoriModel;
    protected $BayarzakatModel;

    public function __construct()
    {
        $this->WargaModel = new WargaModel();
        $this->MuzakkiModel = new MuzakkiModel();
        $this->KategoriModel = new KategoriModel();
        $this->BayarzakatModel = new BayarzakatModel();
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
            'data' => $this->WargaModel->getAll()
        ];
        return view('warga/index', $data);
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
            'title' => 'Mustahik Warga',
            'muzakki' => $this->MuzakkiModel->warga(),
            'kategori' => $this->KategoriModel->warga(),
            'validation' => \Config\Services::validation()
        ];
        // dd($data['muzakki'], $data['jenis_bayar']);
        return view('warga/create', $data);
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
                    'required' => 'muzakki harus dipilih'
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

            return redirect()->to('/warga/create')->withInput()->with('validation', $validation);
        }
        $this->WargaModel->tambah($this->request->getVar('nama'), $this->request->getVar('kategori'), $this->request->getVar('hak'), $this->request->getVar('id_muzakki'));

        return redirect()->to('/warga');
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
            'data' => $this->WargaModel->getAllById($id),
            'kategori' => $this->KategoriModel->warga(),
            'validation' => \Config\Services::validation()
        ];

        return view('warga/ubah', $data);
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
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kategori harus dipilih'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/warga/edit/' . $id)->withInput()->with('validation', $validation);
        }

        $kategori = $this->request->getVar('kategori');
        $hak = $this->request->getVar('hak');
        $this->WargaModel->edit($id, $kategori, $hak);
        return redirect()->to('/warga');
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
        $this->WargaModel->hapus($id);
        return redirect()->to('/warga');
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

    public function getBeras()
    {
        if (!isset($_SESSION['status'])) {
            return redirect()->to('/admin/login');
        } else {
            if ($_SESSION['status'] != 'admin') {
                return redirect()->to('/admin/login');
            }
        }
        $haks = (float)$this->request->getVar('hak');
        $beras = (float)$this->BayarzakatModel->getTotalBeras()['total'] + (float)$this->BayarzakatModel->getTotalBerasUang()['beras'];
        $hak = (float)$this->WargaModel->getTotalWarga()['hak'] + (float)$this->WargaModel->getTotalLainnya()['hak'] + $haks;
        echo json_encode(['beras' => $beras, 'hak' => $hak]);
    }
}
