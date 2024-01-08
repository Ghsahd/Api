<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuRusakModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'buku_rusak';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_buku_rusak','no_keluar','kode_buku','stok_awal','tanggal_keluar','jumlah_rusak','keterangan'];

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

    public function NomorKeluar()
    {
        $query = $this->db->query('SELECT MAX(no_keluar) as max_nomor FROM buku_rusak');
        $result = $query->getRowArray();
        $lastNumber = $result['max_nomor'];
        if (empty($lastNumber)) {
            $newNumber = 'RSK001';
        } else {
            $lastNumericPart = intval(substr($lastNumber, 3));
            $newNumericPart = $lastNumericPart + 1;
            $newNumber = sprintf("RSK%03d", $newNumericPart);
        }
        return $newNumber;
        
    }
    public function findByNomorKeluar($nomorKeluar)
    {
        return $this->where('no_keluar', $nomorKeluar)->first();
    }
}
