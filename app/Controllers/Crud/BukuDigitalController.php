<?php

namespace App\Controllers\Crud;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\BukuDigital;

class BukuDigitalController extends ResourceController{
    use ResponseTrait;
    protected $bukuDigital;

    public function __construct()
    {
        $this->model = new BukuDigital;
    }
    public function index()
    {
        $query = $this->model->query('SELECT * FROM buku_digital');
        $data = $query->getResult();
        return $this->respond($data);
    }
    public function show($id = null){

    }
    public function create(){
        $kode_buku = $this->request->getVar('kode_buku');

        $cariBuku = $this->model->where('kode_buku', $kode_buku)->first();
        
        if ($cariBuku) {
            echo 'Gagal menambah data! Kode buku sudah ada dalam database.';
        } else {
            $data = [
                'kode_buku' => $kode_buku,
                'judul_buku' => $this->request->getVar('judul_buku'),
                'pengarang' => $this->request->getVar('pengarang'),
                'penerbit' => $this->request->getVar('penerbit'),
                'tahun_terbit' => $this->request->getVar('tahun_terbit'),
                'kategori' => $this->request->getVar('kategori'),
                'jumlah' => $this->request->getVar('jumlah'),
                'link_sampul' => $this->request->getVar('link_sampul'),
                'link' => $this->request->getVar('link'),
                'tanggal_masuk' => date('Y-m-d'),
            ];
            if ($data) {
                $this->model->insert($data);
                $respon = [
                    'message' => [
                        'Tambah Berhasil',
                    ],
                ];
                return $this->respond($respon);
            } else {
                echo 'Gagal menambah data!';
            }
        }
    } 
    public function update($id = null)
    {
        if ($id !== null) {
            $data = [
                'kode_buku' => $this->request->getVar('kode_buku'),
                'judul_buku' => $this->request->getVar('judul_buku'),
                'pengarang' => $this->request->getVar('pengarang'),
                'penerbit' => $this->request->getVar('penerbit'),
                'tahun_terbit' => $this->request->getVar('tahun_terbit'),
                'kategori' => $this->request->getVar('kategori'),
                'jumlah' => $this->request->getVar('jumlah'),
                'link' => $this->request->getVar('link'),
            ];
            $this->model->where('id_buku_digital', $id)->set($data)->update();
    
            $respon = [
                'message' => [
                    'Berhasil Update',
                ],
            ];
            return $this->respond($respon);
        } else {
            $respon = [
                'message' => 'Gagal Update: ID tidak valid',
            ];
            return $this->respond($respon, 400);
        }
    }
    public function delete($id = null){
        $data = $this->model->where('id_buku_digital',$id);
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