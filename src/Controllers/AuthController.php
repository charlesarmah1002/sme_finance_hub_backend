<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Users;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController
{
    public function create_account(Request $request, Response $response)
    {
        $form_data = $request->getParsedBody();

        // check the name, phone, email, password, and the status
        $first_name = $form_data['first_name'];
        $last_name = $form_data['last_name'];
        $email = $form_data['email'];
        $password = $form_data['password'];
        $phone_number = $form_data['phone_number'];
        $status = $form_data['status'];
        $account_type = $form_data['account_type'];

        if (!preg_match($first_name, "/^[\p{L}\s'-]+$/u") || !preg_match($last_name, "/^[\p{L}\s'-]+$/u")) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => "Names should only contain letters, spaces, or hyphens."
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }

        $response->getBody()->write(json_encode([$form_data]));
        return $response->withHeader("Content-Type", "application/json");
    }
}