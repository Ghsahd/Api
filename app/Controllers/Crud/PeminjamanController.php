<?php

namespace App\Controllers\Crud;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\BukuModel;
use App\Models\AnggotaModel;
use App\Models\Peminjaman;

class PeminjamanController extends ResourceController{
    use ResponseTrait;
    protected $peminjaman;
    protected $buku;
    protected $anggota;

    public function __construct()
    {
        $this->peminjaman = new Peminjaman();
        $this->anggota = new AnggotaModel();
        $this->buku = new BukuModel();
    }

    public function index()
    {
        $query = $this->peminjaman->query("SELECT * FROM peminjaman");
        $data = $query->getResult();
        return $this->respond($data);
    }
    public function dataPengembalian(){
        $query = $this->peminjaman->query("SELECT * FROM peminjaman WHERE status='Kembali'");
        $data = $query->getResult();
        return $this->respond($data);
    }
    
    public function dataPeminjaman(){
        $query = $this->peminjaman->query("SELECT * FROM peminjaman WHERE status='Pinjam'");
        $data = $query->getResult();
        return $this->respond($data);
    }

    public function show($nomorAnggota = null){
        if($nomorAnggota !== null){
            $data = $this->peminjaman->findByNomorAnggota($nomorAnggota);
            if($data){
                return $this->respond($data);
            }else{
                return $this->failNotFound('No Data Found with id '.$nomorAnggota);
            }
        }
    }
    public function riwayatPeminjaman($nomorAnggota = null)
    {
        if ($nomorAnggota !== null) {
            $data = $this->peminjaman->riwayatPeminjaman($nomorAnggota);
            if ($data->getNumRows() > 0) {
            // if ($data !== null) {
                return $this->respond($data);
            } else {
                return $this->failNotFound('No Data Found with id ' . $nomorAnggota);
            }
        } else {
            return $this->fail('Nomor Anggota is required.');
        }
    }    
    public function create(){
        $kodeBuku = $this->request->getVar('kode_buku');
        $tgl_peminjaman = date('Y-m-d');
        $tgl_pengembalian = date('Y-m-d', strtotime('+3 days', strtotime($tgl_peminjaman)));
        $status = $this->request->getVar('status');
        $status = "Pinjam";

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
            $status = "kembali";
           
            $data = [
                'kode_buku' => $buku,
                'nomor_anggota' => $anggota ,
                'status' => $status,
                'tanggal_peminjaman' => $tgl_peminjaman,
                'tanggal_pengembalian' => $tgl_pengembalian,
            ];
            if($id !== null){
                $data = $this->peminjaman->calculateDenda($data);
                $this->peminjaman->where('id_peminjaman',$id)->set($data)->update();
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
        $data = $this->peminjaman->where('id_peminjaman',$id);
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
    public function kembaliBuku()
    {
        $kode_buku = $this->request->getVar('kode_buku');
        $status = "kembali"; 
        $this->peminjaman->updateStatusPeminjaman($kode_buku, $status);
        $jumlah_buku = $this->buku->getJumlahBukuByKode($kode_buku);

        $jumlah_buku += 1;
        $this->buku->tambahJumlahBuku($kode_buku, $jumlah_buku);

        $respon = [
            'message' => [
                'Pengembalian berhasil ',
            ],
        ];

        return $this->respond($respon);
    }
}