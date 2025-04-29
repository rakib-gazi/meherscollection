<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;

class JWTToken
{
    public static function CreateToken($userEmail):string
    {
        $key = env('JWT_SECRET');
        $payload = [
            "iss" => env('JWT_ISSUER'),
            "iat" => time(),
            "exp" => time() + 60*60,
            "userEmail" => $userEmail,
        ];
        return JWT::encode($payload, $key, 'HS256');
    }
    public static function VerifyToken($token):string
    {
        try{
            $key = env('JWT_SECRET');
            $decoded = JWT::decode($token, new key($key, 'HS256'));
            return $decoded->userEmail;
        }
        catch (Exception $exception){
            return $exception->getMessage();
        }
    }
}
