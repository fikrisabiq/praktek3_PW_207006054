<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $allowedFields = ['id', 'username', 'password'];
    public function getjumlah($id)
    {
        $builder = $this->table('muzakki');
        $builder->select('id_muzakki,jumlah_tanggungan');
        $query = $builder->getWhere(['id_muzakki' => $id]);
        return $query->getFirstRow('array');
    }

    public function tambah($nama, $jumlah)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('muzakki');
        $builder->insert([
            'nama_muzakki' => $nama,
            'jumlah_tanggungan' => $jumlah,
            'keterangan' => ''
        ]);
    }

    public function login($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('admin');
        $query = $builder->getWhere(['username' => $username]);
        return $query->getFirstRow('array');
    }
}
