<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AuthTokensModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Utilities\MailFunctions;
use DateInterval;
use DateTime;
use Exception;
use InvalidArgumentException;

class AuthController
{
    public function create_account(Request $request, Response $response)
    {
        $form_data = $request->getParsedBody();

        // check the name, phone, email, password, and the status
        $first_name = $form_data['first_name'] ?? "";
        $last_name = $form_data['last_name'] ?? "";
        $email = $form_data['email'] ?? "";
        $password = $form_data['password'] ?? "";
        $phone_number = $form_data['phone_number'] ?? "";
        $account_type = $form_data['user_role_id'] ?? "";
        // I need to write a function that checks that the role exists

        if (
            !preg_match("/^[\p{L}\s'-]+$/u", $first_name) ||
            !preg_match("/^[\p{L}\s'-]+$/u", $last_name)
        ) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => "Names should only contain letters, spaces, or hyphens."
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => "Enter a valid email address e.g. example@domain.com"
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }

        $check_user_exists = $this->check_user_exists($email);

        if ($check_user_exists['exists'] == true) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => "Sorry, email taken by another user"
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => "Password should be at least 8 characters and, have an uppercase, lowercase, number, and special character"
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }

        try {
            $user_account = UsersModel::create([
                "name" => $first_name . " " . $last_name,
                "email" => $email,
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "phone_number" => $phone_number,
                "status" => "active",
                "user_role_id" => 1,
                "account_type" => $account_type
            ]);

            $last_id = $user_account->id;
            // I will need the last id for the JWT 

            $verification_url_encode = base64_encode($email);
            $mailFunctions = new MailFunctions();
            $mailFunctions->send_verification_email(
                $email,
                [
                    "name" => $first_name,
                    "confirm_url" => $_ENV['FRONTEND_BASE_URL'] . "/email-verification/" . $verification_url_encode
                ]
            );

            $response->getBody()->write(json_encode([
                "success" => true,
                "message" => "User account created successfully"
            ]));
            return $response->withHeader("Content-Type", "application/json");
        } catch (Exception $e) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => $e->getMessage()
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }
    }

    public function verify_email(Request $request, Response $response, array $args)
    {
        $decoded_email = base64_decode($args['encoded_url']);

        try {
            $check_email_exists = $this->check_user_exists($decoded_email);

            if ($check_email_exists['exists'] == false) {
                throw new Exception("Email not verified. Contact customer support for further assistance");
            }

            UsersModel::where("email", "=", $decoded_email)
                ->update([
                    "email_verified" => "verified"
                ]);

            $response->getBody()->write(json_encode([
                "success" => true,
                "message" => "Email verification successful"
            ]));
            return $response->withHeader("Content-Type", "application/json");
        } catch (Exception $e) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => $e->getMessage()
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }
    }

    public function verify_user_account(Request $request, Response $response)
    {
        $form_data = $request->getParsedBody();

        $email = $form_data['email'] ?? "";
        $password = $form_data['password'] ?? "";

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => "Enter a valid email address e.g. example@domain.com"
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }

        $check_user_exists = $this->check_user_exists($email);

        if ($check_user_exists['exists'] == false) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => "Sorry, user account does not exist. Register new account"
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }

        try {
            $check_verified_status = $this->check_verified_status($email);

            $mailFunctions = new MailFunctions();
            $verification_url_encode = base64_encode($email);

            if ($check_verified_status['verified'] == false) {
                $mailFunctions->send_verification_email(
                    $email,
                    [
                        "confirm_url" => "http://localhost:8000/auth/verify_email/" . $verification_url_encode
                    ]
                );
                throw new Exception($check_verified_status['message']);
            }

            $user_data = UsersModel::select(["email", "password"])->where("email", "=", $email)->first();

            if (!password_verify($password, $user_data['password'])) {
                throw new Exception("Email and password are not a match");
            }

            $response->getBody()->write(json_encode([
                "success" => true,
                "message" => "Login successful"
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(200);
        } catch (Exception $e) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => $e->getMessage()
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }
    }

    private function check_user_exists(string $email)
    {
        try {
            $user_data = UsersModel::select([
                "email"
            ])->where("email", "=", $email)->first();

            if ($user_data == null) {
                throw new Exception("User account does not exist");
            }
            return [
                "exists" => true,
                "data" => $user_data
            ];
        } catch (Exception $e) {
            return [
                "exists" => false,
                "message" => $e->getMessage()
            ];
        }
    }

    private function check_verified_status(string $email)
    {
        // check if the email is verified and return true or false
        try {
            $user_data = UsersModel::select([
                "email",
                "email_verified"
            ])->where("email", "=", $email)->first();

            if ($user_data == null) {
                throw new Exception("User account does not exist");
            }

            if ($user_data["email_verified"] == "pending") {
                throw new Exception("User email is not verified. Check your spam for verification email or contact customer support for further assistance");
            }

            return [
                "verified" => true
            ];
        } catch (Exception $e) {
            return [
                "verified" => false,
                "message" => $e->getMessage()
            ];
        }
    }

    public function forgot_password(Request $request, Response $response)
    {
        $form_data = $request->getParsedBody();
        $email = $form_data['email'] ?? "";

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => "User email is invalid. Email should be in the form example@domain.com"
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }

        $check_user_exists = $this->check_user_exists($email);

        if ($check_user_exists['exists'] == false) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => "If an account exists for this email, a password reset link has been sent."
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }

        $token = bin2hex(random_bytes(32));

        $check_verified_status = $this->check_verified_status($email);

        if ($check_verified_status['verified'] == false) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => "User is not verified. Request for verification, if not possible seek customer support"
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }

        try {
            $user_data = UsersModel::select([
                "id",
                "email",
            ])->where("email", "=", $email)->first();

            AuthTokensModel::create([
                "user_id" => $user_data['id'],
                "token_hash" => hash('sha256', $token),
                "type" => "password_reset",
                "expires_at" => $this->get_expiry_datetime(20)
            ]);

            $mailFunctions = new MailFunctions();
            $mail_response = $mailFunctions->send_password_reset_email(
                $email,
                [
                    "reset_url" => $_ENV['FRONTEND_BASE_URL'] . "/reset-password/" . $token
                ]
            );

            $response->getBody()->write(json_encode([$mail_response]));
            return $response->withHeader("Content-Type", "application/json");
        } catch (Exception $e) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => $e->getMessage()
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }
    }

    function get_expiry_datetime(int $minutes, string $format = "Y-m-d H:i:s"): string
    {
        if ($minutes < 1) {
            throw new InvalidArgumentException("Expiry minutes must be a positive integer.");
        }

        return (new DateTime())
            ->add(new DateInterval("PT{$minutes}M"))
            ->format($format);
    }

    public function update_password(Request $request, Response $response)
    {
        $form_data = $request->getParsedBody();

        $email = $form_data['email'] ?? "";
        $password = $form_data['password'] ?? "";

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => "Enter a valid email address e.g. example@domain.com"
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => "Password should be at least 8 characters and, have an uppercase, lowercase, number, and special character"
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }

        $check_user_exists = $this->check_user_exists($email);

        if ($check_user_exists['exists'] == false) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => "Unknown error, contact customer support for assistance."
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }

        $check_verified_status = $this->check_verified_status($email);

        $mailFunctions = new MailFunctions();
        $verification_url_encode = base64_encode($email);

        if ($check_verified_status['verified'] == false) {
            $mailFunctions->send_verification_email(
                $email,
                [
                    "confirm_url" => $_ENV['FRONTEND_BASE_URL'] . "/auth/verify_email/" . $verification_url_encode
                ]
            );
            throw new Exception($check_verified_status['message']);
        }

        try {
            UsersModel::where("email", "=", $email)->update([
                "password" => password_hash($password, PASSWORD_DEFAULT)
            ]);

            $response->getBody()->write(json_encode([
                "success" => true,
                "message" => "Password updated successfully"
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(200);
        } catch (Exception $e) {
            $response->getBody()->write(json_encode([
                "error" => true,
                "message" => $e->getMessage()
            ]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(400);
        }
    }

    // write a function to confirm password reset request
    // i will have to add a function to change email addresses if possible
}