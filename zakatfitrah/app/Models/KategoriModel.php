<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori_mustahik';
    protected $allowedFields = ['id_kategori', 'nama_kategori', 'jumlah_hak'];

    public function warga()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_mustahik');
        $builder->where('id_kategori <', 4);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function lainnya()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_mustahik');
        $builder->where('id_kategori >', 3);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getKategoriById($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_mustahik');
        $query = $builder->getWhere(['id_kategori' => $id]);
        return $query->getFirstRow('array');
    }

    public function total()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_mustahik');
        $builder->selectCount('id_kategori');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }
}
