<?php

namespace App\Models;

use CodeIgniter\Model;

class WargaModel extends Model
{
    protected $table = 'bayarzakat';
    protected $allowedFields = ['id_zakat', 'nama_KK', 'jumlah_tanggungan', 'id_jenis'];

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

    public function delMuzakki($id_muzakki)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('muzakki');
        $builder->delete(['id_muzakki' => $id_muzakki]);
    }

    public function tambah($nama, $kateogri, $hak, $id_muzakki)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('mustahik_warga');
        $builder->insert([
            'nama' => $nama,
            'id_kategori' => $kateogri,
            'hak' => $hak
        ]);
    }

    public function getTotalWarga()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('mustahik_warga');
        $builder->selectSum('hak');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function getTotalLainnya()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('mustahik_lainnya');
        $builder->selectSum('hak');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function getAllById($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('mustahik_warga');
        $builder->join('kategori_mustahik', 'kategori_mustahik.id_kategori = mustahik_warga.id_kategori');
        $query = $builder->getWhere(['id_mustahikwarga' => $id]);
        return $query->getFirstRow('array');
    }

    public function getAll()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('mustahik_warga');
        $builder->join('kategori_mustahik', 'kategori_mustahik.id_kategori = mustahik_warga.id_kategori');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function hapus($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('mustahik_warga');
        $builder->delete(['id_mustahikwarga' => $id]);
    }

    public function edit($id, $kategori, $hak)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('mustahik_warga');
        $builder->where('id_mustahikwarga', $id);
        $builder->update(['id_kategori' => $kategori, 'hak' => $hak]);
    }

    public function lapor()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori_mustahik');
        $builder->select('kategori_mustahik.nama_kategori,kategori_mustahik.jumlah_hak');
        $builder->selectCount('mustahik_warga.id_mustahikwarga');
        $builder->selectSum('mustahik_warga.hak');
        $builder->join('mustahik_warga', 'mustahik_warga.id_kategori = kategori_mustahik.id_kategori', 'left');
        $builder->where('kategori_mustahik.id_kategori <', 4);
        $builder->groupBy('kategori_mustahik.id_kategori');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
