<?php

namespace App\Models;

use CodeIgniter\Model;

class BayarzakatModel extends Model
{
    protected $table = 'bayarzakat';
    protected $allowedFields = ['id_zakat', 'nama_KK', 'jumlah_tanggungan', 'id_jenis'];

    public function getAll()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('bayarzakat');
        $builder->join('bayar_beras', 'bayar_beras.id_zakat = bayarzakat.id_zakat', 'left');
        $builder->join('bayar_uang', 'bayar_uang.id_zakat = bayarzakat.id_zakat', 'left');
        $builder->join('jenis_bayar', 'bayarzakat.id_jenis = jenis_bayar.id_jenis');
        $builder->select('bayarzakat.id_zakat,bayarzakat.nama_KK,bayarzakat.jumlah_tanggungan,bayarzakat.jumlah_tanggunganyangdibayar,bayarzakat.id_jenis,bayar_beras.total as beras,bayar_uang.total as uang,jenis_bayar.id_jenis,jenis_bayar.nama_jenis');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getAllById($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('bayarzakat');
        $builder->join('bayar_beras', 'bayar_beras.id_zakat = bayarzakat.id_zakat', 'left');
        $builder->join('bayar_uang', 'bayar_uang.id_zakat = bayarzakat.id_zakat', 'left');
        $builder->join('jenis_bayar', 'bayarzakat.id_jenis = jenis_bayar.id_jenis');
        $builder->select('bayarzakat.id_zakat,bayarzakat.nama_KK,bayarzakat.jumlah_tanggungan,bayarzakat.jumlah_tanggunganyangdibayar,bayarzakat.id_jenis,bayar_beras.total as beras,bayar_uang.total as uang,jenis_bayar.id_jenis,jenis_bayar.nama_jenis,jenis_bayar.id_jenis as id_bayar,bayar_beras.id_bayar_beras,bayar_uang.id_bayar_uang');
        $query = $builder->getWhere(['bayarzakat.id_zakat' => $id]);
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

    public function delMuzakki($id_muzakki)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('muzakki');
        $builder->delete(['id_muzakki' => $id_muzakki]);
    }

    public function tambah($nama, $jumlah_tanggungan, $jumlah, $jenis_pembayaran, $total, $id_muzakki)
    {
        $this->tambahzakat($nama, $jumlah_tanggungan, $jumlah, $jenis_pembayaran);
        if ($jenis_pembayaran == 1) {
            $db      = \Config\Database::connect();
            $builder = $db->table('bayar_beras');
            $builder->insert([
                'id_zakat' => $this->getLastRow(),
                'total' => $total
            ]);
        } else {
            $db      = \Config\Database::connect();
            $builder = $db->table('bayar_uang');
            $builder->insert([
                'id_zakat' => $this->getLastRow(),
                'beras' => $jumlah * 2.5,
                'total' => $total
            ]);
        }
    }

    public function getZakatById($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('bayarzakat');
        $query = $builder->getWhere(['id_zakat' => $id]);
        return $query->getFirstRow('array');
    }

    public function hapus($id)
    {
        $data = $this->getZakatById($id);
        if ($data['id_jenis'] == 1) {
            $db      = \Config\Database::connect();
            $builder = $db->table('bayar_beras');
            $builder->delete(['id_zakat' => $id]);
        } else {
            $db      = \Config\Database::connect();
            $builder = $db->table('bayar_uang');
            $builder->delete(['id_zakat' => $id]);
        }
        $db      = \Config\Database::connect();
        $builder = $db->table('bayarzakat');
        $builder->delete(['id_zakat' => $id]);
    }

    public function getJenisBayar()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('jenis_bayar');
        $query = $builder->get();
        return $query->getResultArray();
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

    public function getUang()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('bayar_uang');
        $builder->selectSum('total');
        $query = $builder->get();
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

    public function ubahJenis($id_zakat, $jenis, $id_lama, $jumlah, $total)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('bayarzakat');
        $builder->where('id_zakat', $id_zakat);
        $builder->update([
            'jumlah_tanggunganyangdibayar' => $jumlah,
            'id_jenis' => $jenis
        ]);
        if ($jenis == 1) {
            $db      = \Config\Database::connect();
            $builder = $db->table('bayar_uang');
            $builder->delete(['id_bayar_uang' => $id_lama]);
            $db      = \Config\Database::connect();
            $builder = $db->table('bayar_beras');
            $builder->insert([
                'id_zakat' => $id_zakat,
                'total' => $total
            ]);
        } else {
            $db      = \Config\Database::connect();
            $builder = $db->table('bayar_beras');
            $builder->delete(['id_bayar_beras' => $id_lama]);
            $db      = \Config\Database::connect();
            $builder = $db->table('bayar_uang');
            $builder->insert([
                'id_zakat' => $id_zakat,
                'beras' => $jumlah * 2.5,
                'total' => $total
            ]);
        }
    }

    public function ubahTotal($id_zakat, $jenis, $id_lama, $jumlah, $total)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('bayarzakat');
        $builder->where('id_zakat', $id_zakat);
        $builder->update([
            'jumlah_tanggunganyangdibayar' => $jumlah,
        ]);
        if ($jenis == 1) {
            $db      = \Config\Database::connect();
            $builder = $db->table('bayar_beras');
            $builder->where('id_bayar_beras', $id_lama);
            $builder->update([
                'total' => $total,
            ]);
        } else {
            $db      = \Config\Database::connect();
            $builder = $db->table('bayar_uang');
            $builder->where('id_bayar_uang', $id_lama);
            $builder->update([
                'beras' => $jumlah,
                'total' => $total,
            ]);
        }
    }

    public function TotalJiwa()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('bayarzakat');
        $builder->selectSum('jumlah_tanggungan');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }
}
