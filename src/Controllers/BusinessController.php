<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\UsersModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;

class BusinessController
{
    public function create_business(Request $request, Response $response)
    {
        // write a function that add a user to a business in the business_users table, it should be a private function for only the business controller
        $form_data = $request->getParsedBody();

        /* 'name',
        'logo', --- will have to work on image management since I will have to use an image compression tool for this
        'phone',
        'email',
        'address',
        'country',
        'currency',
        'fiscal_year_start',
        'status' */

        $name = $form_data['name'] ?? "";
        $business_name_error = null;
        $phone = $form_data['phone'] ?? "";
        $email = $form_data['email'] ?? "";
        $address = $form_data['address'] ?? "";
        $country = $form_data['country'] ?? "";
        $currency = $form_data['currency'] ?? "";
        $fiscal_year_start = $form_data["fiscal_year_start"] ?? date('Y');

        if ($name === '') {
            $business_name_error = "Business name is required.";
        } elseif (strlen($name) < 2) {
            $business_name_error = "Business name must be at least 2 characters.";
        } elseif (strlen($name) > 150) {
            $business_name_error = "Business name is too long.";
        } elseif (!preg_match("/^[a-zA-Z0-9 .,&'()\-]+$/", $name)) {
            $business_name_error = "Business name contains invalid characters.";
        }

        if ($business_name_error != null) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => $business_name_error
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }

        if (!filter_var($email, FILTER_SANITIZE_EMAIL)) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => "Invalid business email. Email should be example@domain.com"
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }

        try {
            // create a business
        } catch (Exception $e) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => $e->getMessage()
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }
    }

    private function assign_business_to_user()
    {
        // function to create a business user row
    }
}