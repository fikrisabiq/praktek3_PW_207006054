<?php

namespace App\Controllers;

use \App\Models\KategoriModel;
use \App\Models\MuzakkiModel;
use \App\Models\WargaModel;
use \App\Models\LainnyaModel;
use \App\Models\BayarzakatModel;


class Home extends BaseController
{
    protected $KategoriModel;
    protected $MuzakkiModel;
    protected $WargaModel;
    protected $LainnyaModel;
    protected $BayarzakatModel;
    public function __construct()
    {
        $this->KategoriModel = new KategoriModel();
        $this->MuzakkiModel = new MuzakkiModel();
        $this->WargaModel = new WargaModel();
        $this->LainnyaModel = new LainnyaModel();
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
            'title' => 'Dashboard',
            'totalBeras' => (float)$this->BayarzakatModel->getTotalBeras()['total'] + (float)$this->BayarzakatModel->getTotalBerasUang()['beras'],
            'beras' => (float)$this->BayarzakatModel->getTotalBeras()['total'],
            'distribusi' => (float)$this->WargaModel->getTotalWarga()['hak'] + (float)$this->WargaModel->getTotalLainnya()['hak'],
            'muzakki' => $this->MuzakkiModel->total(),
            'kategori' => $this->KategoriModel->total(),
            'uang' => $this->BayarzakatModel->getUang()['total']
        ];
        return view('home/index', $data);
    }

    public function warga()
    {
        if (!isset($_SESSION['status'])) {
            return redirect()->to('/admin/login');
        } else {
            if ($_SESSION['status'] != 'admin') {
                return redirect()->to('/admin/login');
            }
        }

        $data = [
            'title' => 'Laporan Distribusi Zakat Fitrah Warga',
            'warga' => $this->WargaModel->lapor()
        ];
        // dd($data['warga']);
        return view('home/warga', $data);
    }

    public function lainnya()
    {
        if (!isset($_SESSION['status'])) {
            return redirect()->to('/admin/login');
        } else {
            if ($_SESSION['status'] != 'admin') {
                return redirect()->to('/admin/login');
            }
        }

        $data = [
            'title' => 'Laporan Distribusi Zakat Fitrah Lainnya',
            'warga' => $this->LainnyaModel->lapor()
        ];
        // dd($data['warga']);
        return view('home/lainnya', $data);
    }
}
