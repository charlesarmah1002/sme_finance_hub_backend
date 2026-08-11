<?php

declare(strict_types=1);

namespace App\Utilities;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use MailchimpTransactional\ApiClient;

class MailFunctions
{
    public function send_verification_email()
    {
        try {
            $apiClient = new ApiClient();
            $apiClient->setApiKey($_ENV['API_KEY']);
            $response = $apiClient->users->ping();
            print_r($response);
        }catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function administrator_registration(string $email, array $content)
    {
        $mail = new PHPMailer(true);

        try {
            // SMTP config
            $mail->isSMTP();
            $mail->Host = "mail.smtp2go.com";
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USERNAME'];
            $mail->Password = $_ENV['SMTP_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Sender
            $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);

            // Recipient (use function parameter)
            $mail->addAddress($email);

            // Optional reply-to
            if (!empty($_ENV['MAIL_REPLY_TO'])) {
                $mail->addReplyTo($_ENV['MAIL_REPLY_TO'], $_ENV['MAIL_FROM_NAME']);
            }

            // Content (use passed array)
            $subject = 'Registration Successful';
            $body = 'Welcome! Your account has been created. ' . $content["username"] . '/n Your passphrase is <strong>' . $content["passphrase"] . ' </strong>';

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = strip_tags($body);

            // Send
            $mail->send();

            return [
                "success" => true,
                "message" => "Email sent successfully"
            ];

        } catch (Exception $e) {
            return [
                "success" => false,
                "message" => $mail->ErrorInfo
            ];
        }
    }
}