<?php

namespace App\Models;

use CodeIgniter\Model;

class LainnyaModel extends Model
{
    protected $table = 'bayarzakat';
    protected $allowedFields = ['id_zakat', 'nama_KK', 'jumlah_tanggungan', 'id_jenis'];

    public function getAll()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('mustahik_lainnya');
        $builder->join('kategori_mustahik', 'kategori_mustahik.id_kategori = mustahik_lainnya.id_kategori');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getAllById($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('mustahik_lainnya');
        $builder->join('kategori_mustahik', 'kategori_mustahik.id_kategori = mustahik_lainnya.id_kategori');
        $query = $builder->getWhere(['id_mustahiklainnya' => $id]);
        return $query->getFirstRow('array');
    }

    public function getLastRow()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('bayarzakat');
        $builder->selectMax('id_zakat');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function tambahzakat($nama, $jumlah_tanggungan, $jumlah, $jenis_pembayaran)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('bayarzakat');
        $builder->insert([
            'nama_KK' => $nama,
            'jumlah_tanggungan' => $jumlah_tanggungan,
            'jumlah_tanggunganyangdibayar' => $jumlah,
            'id_jenis' => $jenis_pembayaran
        ]);
    }

    public function tambah($nama, $kateogri, $hak)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('mustahik_lainnya');
        $builder->insert([
            'nama' => $nama,
            'id_kategori' => $kateogri,
            'hak' => $hak
        ]);
    }

    public function hapus($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('mustahik_lainnya');
        $builder->delete(['id_mustahiklainnya' => $id]);
    }

    public function edit($id, $kategori, $hak, $nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('mustahik_lainnya');
        $builder->where('id_mustahiklainnya', $id);
        $builder->update(['id_kategori' => $kategori, 'hak' => $hak, 'nama' => $nama]);
    }

    public function getTotalBeras()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('bayar_beras');
        $builder->selectSum('total');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function getTotalBerasUang()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('bayar_uang');
        $builder->selectSum('beras');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function lapor()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_mustahik');
        $builder->select('kategori_mustahik.nama_kategori,kategori_mustahik.jumlah_hak');
        $builder->selectCount('mustahik_lainnya.id_mustahiklainnya');
        $builder->selectSum('mustahik_lainnya.hak');
        $builder->join('mustahik_lainnya', 'mustahik_lainnya.id_kategori = kategori_mustahik.id_kategori', 'left');
        $builder->where('kategori_mustahik.id_kategori >', 3);
        $builder->groupBy('kategori_mustahik.id_kategori');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
