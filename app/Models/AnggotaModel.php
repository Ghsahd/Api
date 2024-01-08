<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'anggota';
    protected $primaryKey       = 'id_anggota';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama','nomor_anggota','email','alamat','nomor_telepon','password'];

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

    public function generateNewAnggotaNumber()
    {
        $query = $this->db->query('SELECT MAX(nomor_anggota ) as max_nomor FROM anggota');
        $result = $query->getRowArray();
        $lastNumber = $result['max_nomor'];
        if (empty($lastNumber)) {
            $newNumber = 'AGT001';
        } else {
            $lastNumericPart = intval(substr($lastNumber, 3));
            $newNumericPart = $lastNumericPart + 1;
            $newNumber = sprintf("AGT%03d", $newNumericPart);
        }
        return $newNumber;
        
    }
    public function findByNomorAnggota($nomorAnggota)
    {
        return $this->where('nomor_anggota', $nomorAnggota)->first();
    }
}
