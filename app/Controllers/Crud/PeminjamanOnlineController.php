<?php

namespace App\Controllers\Crud;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\BukuDigital;
use App\Models\AnggotaModel;
use App\Models\PeminjamanOnlineModel;

class PeminjamanOnlineController extends ResourceController{
    use ResponseTrait;
    protected $peminjaman;
    protected $buku;
    protected $anggota;

    public function __construct()
    {
        $this->peminjaman = new PeminjamanOnlineModel();
        $this->anggota = new AnggotaModel();
        $this->buku = new BukuDigital();
    }
    public function index()
    {
        $query = $this->peminjaman->query("SELECT * FROM peminjaman_online");
        $data = $query->getResult();
        return $this->respond($data);
    }
    public function riwayatPeminjamanOnline($nomor_anggota = null)
    {
        $peminjaman = $this->peminjaman
            ->select('peminjaman_online.*, buku_digital.*')
            ->join('buku_digital', 'peminjaman_online.kode_buku = buku_digital.kode_buku', 'left')
            ->where('nomor_anggota', $nomor_anggota)
            ->findAll();

        if (empty($peminjaman)) {
            return $this->failNotFound('Peminjaman not found');
        }

        return $this->respond($peminjaman);
    }

    public function create(){
        $kodeBuku = $this->request->getVar('kode_buku');
        $tgl_peminjaman = date('Y-m-d');
        $tgl_pengembalian = date('Y-m-d', strtotime('+3 days', strtotime($tgl_peminjaman)));
        $status = $this->request->getVar('status');
        $status = "Diajukan";

        $jumlah_buku = $this->buku->getJumlah($kodeBuku);
        if($jumlah_buku > 0){
            $data = [
                'kode_buku' => $kodeBuku,
                'nomor_anggota' => $this->request->getVar('nomor_anggota'),
                'status' => $status,
                'tanggal_peminjaman' => $tgl_peminjaman,
                'tanggal_pengembalian' => $tgl_pengembalian,
            ];
            if($data){
                $this->peminjaman->insert($data);
                $this->buku->updateJumlahBuku($kodeBuku,$jumlah_buku - 1);
                $respon = [
                    'message' => [
                        'Tambah Berhasil ',
                    ],
                ];
                return $this->respond($respon);
            }else{
                echo 'Gagal menambah data !';
            }
        }else{
            $respon = [
                'message' => [
                    'Buku tidak tersedia.',
                ],  
            ];
            return $this->respond($respon);
        }
        
    }
    public function update($id = null) {
        if ($id !== null) {
            $tgl_peminjaman = date('Y-m-d');
            $tgl_pengembalian = date('Y-m-d', strtotime('+3 days', strtotime($tgl_peminjaman)));
            $buku = $this->request->getVar('kode_buku');
            $anggota = $this->request->getVar('nomor_anggota');
            $status = $this->request->getVar('status');
           
            $data = [
                'kode_buku' => $buku,
                'nomor_anggota' => $anggota ,
                'status' => $status,
                'tanggal_peminjaman' => $tgl_peminjaman,
                'tanggal_pengembalian' => $tgl_pengembalian,
            ];
            if($id !== null){
                $this->peminjaman->where('id_peminjaman_online',$id)->set($data)->update();
                $jumlah_buku = $this->buku->getJumlah($buku);
                $this->buku->updateJumlahBuku($buku,$jumlah_buku +=1);
                
                $respon = [
                    'message' => [
                        'Berhasil Update',
                    ],
                ];
                return $this->respond($respon);
            }else{
                echo 'Gagal Update Data !';
            }
        } else {
            $respon = [
                'message' => 'Gagal Update: ID tidak valid',
            ];
            return $this->respond($respon, 400);
        }
    }
    public function delete($id = null){
        $data = $this->peminjaman->where('id_peminjaman_online',$id);
        if($data){
            $data->delete($id);
            $respon = [
                'message' => [ 
                    'Hapus Berhasil',
                ],
            ];
            return $this->respond($respon);
        }else{
            echo "Hapus Gagal";
        }
    }
}