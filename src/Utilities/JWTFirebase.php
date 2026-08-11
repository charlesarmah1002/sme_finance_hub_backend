<?php

namespace App\Utilities;

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JWTFirebase
{

    private $secretKey; 

    public function __construct()
    {
        // Set the secret key from environment variables for security
        $this->secretKey = $_ENV['JWT_SECRET_KEY']; // Default to 'your-secret-key' if env variable is not set
    }

    // Generate JWT token
    public function generateJWT($userId, $username, $role)
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + 864000;  // JWT valid for 10 days from the issued time

        // Payload data
        $payload = [
            'exp' => $expirationTime,
            'iat' => time(),
            'nbf' => time(),
            "data" => [
                "userId" => $userId,
                "username" => $username,
                "role" => $role
            ]
        ];

        $jwt = JWT::encode($payload, $this->secretKey, 'HS256');
        return $jwt;
    }

    // Validate the JWT token
    public function validateJWT($jwt)
    {
        try {
            // Decode the JWT
            // $decoded = JWT::decode($jwt, $this->secretKey, ['HS256']);

            $decoded = JWT::decode($jwt, new Key($this->secretKey, 'HS256'));

            return (array) $decoded; // Return decoded data as an array
        } catch (Exception $e) {
            // Handle any exceptions (expired token, invalid signature, etc.)
            return [
                "error" => "Invalid or expired token",
                "message" => $e->getMessage()
            ];
        }
    }
}