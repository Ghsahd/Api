<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\User;

class Login extends BaseController{
    use ResponseTrait;
    
    public function index(){
        $userModel = new User();
    
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
    
        $user = $userModel->where('email', $email)->first();
        if (!$user) {
            return $this->failNotFound('User not found');
        }
    
        // if (!password_verify($password, $user['password'])) {
        //     return $this->failUnauthorized('Password atau Email Salah !');
        // }
        if ($password !== $user['password']) {
            return $this->failUnauthorized('Password atau Email Salah !');
        }
    
        $payload = [
            'id_user' => $user['id_user'],
            'email' => $user['email'],
            'role' => $user['role'],
            'iat' => time(),
            'exp' => time() + 3600,
        ];
    
        $token = $this->generateJWTToken($payload);
    
        return $this->respond([
            'message' => 'Login successful',
            'token' => $token,
            'id_user' => $user['id_user'],
            'email' => $user['email'],
            'role' => $user['role'],
            'nomor_anggota' => $user['nomor_anggota']
        ]);
    }
    
    private function generateJWTToken($payload)
    {
        $jwt = new \Firebase\JWT\JWT;
        $key = getenv('JWT_SECRET');
        return $jwt->encode($payload, $key, 'HS256');
    }
    

}


