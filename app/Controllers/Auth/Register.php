<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AnggotaModel;
use App\Models\User;


class Register extends BaseController{
    use ResponseTrait;

    public function index(){
        $rules = [
            'nama' => 'required',
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'password' => ['rules' => 'required|min_length[8]|max_length[255]']
        ];

        if($this->validate($rules)){
            $AnggotaModel = new AnggotaModel();
            $UserModel = new User();
            $newAnggotaNumber = $AnggotaModel->generateNewAnggotaNumber();
            $dataAngggota = [
                'nama' => $this->request->getVar('nama'),
                'nomor_anggota' => $newAnggotaNumber,
                'email' => $this->request->getVar('email'),
                'alamat' => $this->request->getVar('alamat'),
                'nomor_telepon' => $this->request->getVar('nomor_telepon'),
                'password' => $this->request->getVar('password'),
            ];

            $AnggotaModel->insert($dataAngggota);

            $dataUser = [
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
                'role' => 'Anggota',
                'nomor_anggota' => $newAnggotaNumber,
            ];
            
            $UserModel->insert($dataUser);

            return $this->respond(['message' => 'Registrasi Sukses']);
        }else{
            $respon = [
                'error' => $this->validator->getErrors(),
                'message' => 'Registrasi Gagal',
            ];
            print_r($this->validator->getErrors());

            return $this->fail($respon);
        }
    }

}