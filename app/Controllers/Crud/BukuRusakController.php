<?php
namespace App\Controllers\Crud;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\BukuRusakModel;
use App\Models\BukuModel;

class BukuRusakController extends ResourceController{
    use ResponseTrait;
    protected $model;
    protected $buku;

    public function __construct()
    {
        $this->model = new BukuRusakModel();   
        $this->buku = new BukuModel();
    }
    public function index()
    {
        $query = $this->model->query('SELECT * FROM buku_rusak');
        $data = $query->getResult();
        return $this->respond($data);
    }
    public function create()
    {
        $kodeBuku = $this->request->getVar('kode_buku');
        $bukuExists = $this->buku->where('kode_buku', $kodeBuku)->countAllResults() > 0;

        if (!$bukuExists) {
            $response = [
                'error' => 'Kode buku tidak ditemukan!',
            ];
            return $this->respond($response, 404);
        }
        $NomorKeluar = $this->model->Nomorkeluar();
        $tgl_keluar = date('Y-m-d');
        $data = [
            'no_keluar' => $NomorKeluar,
            'kode_buku' => $kodeBuku,
            'stok_awal' => $this->request->getVar('stok_awal'),
            'tanggal_keluar' => $tgl_keluar,
            'jumlah_rusak' => $this->request->getVar('jumlah_rusak'),
            'keterangan' => $this->request->getVar('keterangan'),
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
    public function update($id = null){
        if($id !== null){
            $kodeBuku = $this->request->getVar('kode_buku');
            $bukuExists = $this->buku->where('kode_buku', $kodeBuku)->countAllResults() > 0;

            if (!$bukuExists) {
                $response = [
                    'error' => 'Kode buku tidak ditemukan!',
                ];
                return $this->respond($response, 404);
            }
            $NomorKeluar = $this->model->Nomorkeluar();
            $tgl_keluar = date('Y-m-d');
            $data = [
                'no_keluar' => $NomorKeluar,
                'kode_buku' => $kodeBuku,
                'stok_awal' => $this->request->getVar('stok_awal'),
                'tanggal_keluar' => $tgl_keluar,
                'jumlah_rusak' => $this->request->getVar('jumlah_rusak'),
                'keterangan' => $this->request->getVar('keterangan'),
            ];
            $this->model->where('id_buku_rusak', $id)->set($data)->update();
    
            $respon = [
                'message' => [
                    'Berhasil Update',
                ],
            ];
            return $this->respond($respon);
        }else{
            $respon = [
                'message' => 'Gagal Update: ID tidak valid',
            ];
            return $this->respond($respon, 400);
        }
    }
    public function delete($id = null){
        $data = $this->model->where('id_buku_rusak',$id);
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