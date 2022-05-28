<?php

namespace App\Models;

use CodeIgniter\Model;

class MuzakkiModel extends Model
{
    protected $table = 'muzakki';
    protected $allowedFields = ['id_muzakki', 'nama_muzakki', 'jumlah_tanggungan', 'keterangan'];

    public function getjumlah($id)
    {
        $builder = $this->table('muzakki');
        $builder->select('id_muzakki,jumlah_tanggungan');
        $query = $builder->getWhere(['id_muzakki' => $id]);
        return $query->getFirstRow('array');
    }

    public function tambahMuzakki($nama, $jumlah)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('muzakki');
        $builder->insert([
            'nama_muzakki' => $nama,
            'jumlah_tanggungan' => $jumlah,
            'keterangan' => ''
        ]);
    }

    public function total()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('muzakki');
        $builder->selectCount('id_muzakki');
        $builder->selectSum('jumlah_tanggungan');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function addMuzakki()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('muzakki');
        $builder->join('bayarzakat', 'bayarzakat.nama_KK = muzakki.nama_muzakki', 'left');
        $builder->select('muzakki.id_muzakki,nama_muzakki,muzakki.jumlah_tanggungan');
        $builder->where('bayarzakat.nama_KK is NULL');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function warga()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('muzakki');
        $builder->join('mustahik_warga', 'mustahik_warga.nama = muzakki.nama_muzakki', 'left');
        $builder->select('muzakki.id_muzakki,nama_muzakki,muzakki.jumlah_tanggungan');
        $builder->where('mustahik_warga.nama is NULL');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
