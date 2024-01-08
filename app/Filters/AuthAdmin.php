<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;

class AuthAdmin implements FilterInterface
{
    use ResponseTrait;
    public function before(RequestInterface $request, $arguments = null)
    {
        $jwt = new \Firebase\JWT\JWT;
        $token = $request->getHeaderLine('Authorization');

        try {
            $decodedToken = $jwt->decode($token, getenv('JWT_SECRET'));
            $role = $decodedToken->role;
            if ($role !== 'Admin') {
                return $this->failForbidden('Access denied');
            }
        } catch (\Exception $e) {
            return $this->failUnauthorized('Invalid token');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
