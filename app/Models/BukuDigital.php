<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuDigital extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'buku_digital';
    protected $primaryKey       = 'id_buku_digital';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_buku','judul_buku','pengarang','penerbit','tahun_terbit','kategori','jumlah','tanggal_masuk','link_sampul','link'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getJumlah($kodeBuku){
        $query = $this->select('jumlah')->where('kode_buku',$kodeBuku)->get();
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->jumlah;
        } else {
            return 0;
        }
    }
    public function updateJumlahBuku($kodeBuku, $jumlah)
    {
        $this->where('kode_buku', $kodeBuku)->set('jumlah', $jumlah)->update();
    }
}
