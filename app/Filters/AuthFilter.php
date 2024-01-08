<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthFilter implements FilterInterface
{
   
    public function before(RequestInterface $request, $arguments = null){
        $key = getenv('JWT_SECRET');
        $header = $request->getServer('HTTP_AUTHORIZATION');
        $token = null;
        // extract the token from the header
        if (!empty($header)) {
            if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
                $token = $matches[1];
            }
        }
        
        // check if token is null or empty
        if (is_null($token) || empty($token)) {
            $response = service('response');
            $response->setBody('Access denied');
            $response->setStatusCode(401);
            return $response;
        }
        
        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            
            // Extract role from decoded token
            $userRole = $decoded->role; // Assuming 'role' is the claim for the user's role
            
            // Check user role and perform authorization
            if ($userRole === 'Admin') {
                // User has 'admin' role, grant access
            } elseif ($userRole === 'Anggota') {
                // User has 'anggota' role, grant access for specific actions
            } else {
                $response = service('response');
                $response->setBody('Access denied');
                $response->setStatusCode(403); // 403 Forbidden
                return $response;
            }
        } catch (\Exception $ex) {
            $response = service('response');
            $response->setBody('Access denied');
            $response->setStatusCode(401);
            return $response;
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
