<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class Peminjaman extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'peminjaman';
    protected $primaryKey       = 'id_peminjaman';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_buku','nomor_anggota','status','tanggal_peminjaman','tanggal_pengembalian','denda'];

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
    protected $afterInsert    = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    protected $beforeInsert = ['calculateDenda'];
    protected $beforeUpdate = ['calculateDenda'];

    protected function calculateDenda(array $data)
    {
        try {
            $denda_per_hari = 1000;
            $denda_masa_peminjaman = 3;
        
            if (isset($data['tanggal_peminjaman']) && isset($data['tanggal_pengembalian'])) {
                $tanggal_peminjaman = date_create_from_format('Y-m-d', $data['tanggal_peminjaman']);
                $tanggal_pengembalian = date_create_from_format('Y-m-d', $data['tanggal_pengembalian']);
        
                $selisih_hari = date_diff($tanggal_pengembalian, $tanggal_peminjaman)->days;
        
                $total_masa_peminjaman = $selisih_hari - $denda_masa_peminjaman;
                $denda = ($total_masa_peminjaman > 0) ? ($total_masa_peminjaman * $denda_per_hari) : 0;
        
                $data['denda'] = $denda;
        
                return $data;
            } else {
                return $data; 
            }
        } catch (\Exception $e) {
            die($e->getMessage());
        }
        
    }
    public function findByNomorAnggota($nomorAnggota)
    {
        return $this->where('nomor_anggota', $nomorAnggota)->first();
    }
    public function riwayatPeminjaman($nomorAnggota){
        return $this->where('nomor_anggota', $nomorAnggota)
                ->orderBy('tanggal_peminjaman', 'DESC')
                ->get();
    }
}
