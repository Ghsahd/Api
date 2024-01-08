<?php

namespace App\Controllers\Crud;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\BukuModel;

class BukuController extends ResourceController{
    use ResponseTrait;
    protected $model;
    protected $lokasi;

    public function __construct()
    {
        $this->model = new BukuModel();
    }

    public function index()
    {
        $query = $this->model->query('SELECT * FROM buku');
        $data = $query->getResult();
        return $this->respond($data);
    }
    public function show($id = null){
        $data = $this->model->find($id);
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
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
                'lokasi_buku' => $this->request->getVar('lokasi_buku'),
                'lokasi_terbit' => $this->request->getVar('lokasi_terbit'),
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
                'lokasi_buku' => $this->request->getVar('lokasi_buku'),
                'lokasi_terbit' => $this->request->getVar('lokasi_terbit'),
            ];
            $this->model->where('id_buku', $id)->set($data)->update();
    
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
        $data = $this->model->where('id_buku',$id);
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
    public function BukuMasuk()
    {
        $startOfWeek = date('Y-m-d', strtotime('-1 week', strtotime(date('Y-m-d'))));
        $endOfWeek = date('Y-m-d');
        $query = $this->model->query("SELECT * FROM buku WHERE tanggal_masuk BETWEEN '$startOfWeek' AND '$endOfWeek'");
        $data = $query->getResult();

        // echo $this->model->getLastQuery(); 
        // print_r($data);
        return $this->respond($data);
    }


}