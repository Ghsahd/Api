<?php

namespace App\Controllers\Crud;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\AnggotaModel;

class AnggotaController extends ResourceController
{
    use ResponseTrait;
    protected $model;

    public function __construct()
    {
        $this->model = new AnggotaModel();
    }

    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data);
    }
    public function create()
    {
        
    }

    public function show($id = null)
    {
        if ($id !== null) {
            $data = $this->model->find($id);
    
            if ($data) {
                return $this->respond($data);
            } else {
                return $this->failNotFound('Tidak DItemukan Nomor Anggota ' . $id);
            }
        } else {
            echo ('Nomor Anggota Tidak Tersedia');
        }
    }
    
    public function update($nomor_anggota = null)
    {
        if ($nomor_anggota !== null) {
            $data = [
                'nama' => $this->request->getVar('nama'),
                'email' => $this->request->getVar('email'),
                'alamat' => $this->request->getVar('alamat'),
                'nomor_telepon' => $this->request->getVar('nomor_telepon'),
                'password' => $this->request->getVar('password'),
            ];
            $password = $this->request->getVar('password');
            if ($password !== null) {
                $data['password'] = $password;
            } else {
                $data['password'] = 'password_default';
            }
            $this->model->where('nomor_anggota', $nomor_anggota)->set($data)->update();

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

    public function delete($id = null)
    {
        if ($id !== null) {
            $db = \Config\Database::connect();
            try {
                // Memulai transaksi database
                $db->transStart();
                // Hapus data dari tabel 'anggota'
                $this->model->where('id_anggota', $id)->delete();
                // Hapus data dari tabel 'user' berdasarkan 'id_anggota'
                $db->table('users')->where('id_anggota', $id)->delete();
                // Commit transaksi jika semua operasi berhasil
                $db->transComplete();
                if ($db->transStatus() === false) {
                    // Transaksi gagal
                    $respon = [
                        'message' => 'Hapus Gagal',
                    ];
                    return $this->respond($respon, 400);
                } else {
                    // Transaksi berhasil
                    $respon = [
                        'message' => 'Hapus Berhasil',
                    ];
                    return $this->respond($respon);
                }
            } catch (\Exception $e) {
                $respon = [
                    'message' => 'Hapus Gagal: ' . $e->getMessage(),
                ];
                return $this->respond($respon, 500);
            }
        } else {
            $respon = [
                'message' => 'Gagal Hapus: ID tidak valid',
            ];
            return $this->respond($respon, 400);
        }
    }
    

    public function detailAnggota($nomor_anggota = null)
    {
        if ($nomor_anggota !== null) {
            $data = $this->model->findByNomorAnggota($nomor_anggota);
            if ($data) {
                return $this->respond($data);
            } else {
                return $this->failNotFound('No Data Found with Nomor Anggota ' . $nomor_anggota);
            }
        } else {
            $respon = [
                'message' => 'Nomor Anggota is required',
            ];
            return $this->respond($respon);
        }
    }


}
