<?php

namespace App\Controllers;

use \App\Models\BayarzakatModel;
use \App\Models\MuzakkiModel;

class Bayarzakat extends BaseController
{
    protected $BayarzakatModel;
    protected $MuzakkiModel;

    public function __construct()
    {
        $this->BayarzakatModel = new BayarzakatModel();
        $this->MuzakkiModel = new MuzakkiModel();
    }

    public function index()
    {
        if (!isset($_SESSION['status'])) {
            return redirect()->to('/status/login');
        } else {
            if ($_SESSION['status'] != 'admin') {
                return redirect()->to('/admin/login');
            }
        }
        $data = [
            'title' => 'Master Data Muzakki',
            'data' => $this->BayarzakatModel->getAll()
        ];
        // dd($data['data']);
        return view('bayarzakat/index', $data);
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
            'title' => 'Bayar Zakat',
            'muzakki' => $this->MuzakkiModel->addMuzakki(),
            'jenis_bayar' => $this->BayarzakatModel->getJenisBayar(),
            'validation' => \Config\Services::validation()
        ];
        // dd($data['muzakki'], $data['jenis_bayar']);
        return view('bayarzakat/create', $data);
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
            'nama_KK' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'muzakki harus dipilih'
                ]
            ],
            'jenis_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jenis pembayaran harus dipilih'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah harus dipilih'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/bayarzakat/create')->withInput()->with('validation', $validation);
        }

        $this->BayarzakatModel->tambah($this->request->getVar('nama_KK'), $this->request->getVar('jumlah_tanggungan'), $this->request->getVar('jumlah'), $this->request->getVar('jenis_pembayaran'), $this->request->getVar('total'), $this->request->getVar('id_muzakki'));

        return redirect()->to('/bayarzakat');
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
        $this->BayarzakatModel->hapus($id);
        return redirect()->to('/bayarzakat');
    }

    public function getjumlah()
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
        // dd($this->MuzakkiModel->getjumlah($id));
        // echo $this->MuzakkiModel->getjumlah($id)['jumlah_tanggungan'];
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
            'data' => $this->BayarzakatModel->getAllById($id),
            'jenis_bayar' => $this->BayarzakatModel->getJenisBayar(),
            'validation' => \Config\Services::validation()
        ];

        return view('bayarzakat/ubah', $data);
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
            'jenis_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jenis pembayaran harus dipilih'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah harus dipilih'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/bayarzakat/ubah/' . $id)->withInput()->with('validation', $validation);
        }

        $jenis_lama = $this->request->getVar('jenis_lama');
        $jenis_baru = $this->request->getVar('jenis_pembayaran');
        $id_lama = $this->request->getVar('id_lama');
        $total_lama = $this->request->getVar('total_lama');
        $jumlah = $this->request->getVar('jumlah');
        $total = $this->request->getVar('total');

        if ($jenis_lama != $jenis_baru) {
            $this->BayarzakatModel->ubahJenis($id, $jenis_baru, $id_lama, $jumlah, $total);
        } else {
            $this->BayarzakatModel->ubahTotal($id, $jenis_baru, $id_lama, $jumlah, $total);
        }

        return redirect()->to('/bayarzakat');
    }

    public function TotalJiwa()
    {
        return $this->BayarzakatModel->TotalJiwa();
    }
}
