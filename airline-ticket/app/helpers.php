<?php

use App\Common\Constants;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;


/**
 * Encode account information for JWT
 *
 * @param $data
 * @return string
 */
function jwtAccountEncode($data)
{
    $payload = [
        'iss' => "vanphuc", // Issuer of the token
        'sub' => $data, // Subject of the token - Can add many properties
        'iat' => time(), // Time when JWT was issued.
        'exp' => time() + 2 * Constants::JWT_EXPIRE // Expiration time
    ];
    return JWT::encode($payload, env('APP_SECRET_ACC'), 'HS256');
}
