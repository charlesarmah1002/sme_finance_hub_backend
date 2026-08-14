<?php

declare(strict_types=1);

namespace App\Utilities;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailFunctions
{


    /**
     * Send an email verification email.
     *
     * Expected $content structure:
     *
     * [
     *     'confirm_url' => 'https://example.com/verify-email?token=...',
     *     'name'        => 'John Doe',
     *     'subject'     => 'Confirm your email address'
     * ]
     *
     * @param string $email
     * @param array<string, mixed> $content
     *
     * @return array{success: bool, message: string}
     */
    public function send_verification_email(
        string $email,
        array $content
    ): array {
        $mail = new PHPMailer(true);

        try {
            /*
             * ------------------------------------------------------------
             * Validate required configuration
             * ------------------------------------------------------------
             */

            $requiredEnv = [
                'SMTP_USERNAME',
                'SMTP_PASSWORD',
                'MAIL_FROM',
                'MAIL_FROM_NAME',
            ];

            foreach ($requiredEnv as $envKey) {
                if (empty($_ENV[$envKey])) {
                    throw new Exception(
                        "Missing environment variable: {$envKey}"
                    );
                }
            }

            /*
             * ------------------------------------------------------------
             * Get email content
             * ------------------------------------------------------------
             */

            $confirmUrl = (string) ($content['confirm_url'] ?? '');

            if ($confirmUrl === '') {
                throw new Exception(
                    json_encode($content['confirm_url'])
                );
            }

            $userName = (string) ($content['name'] ?? 'there');

            $subject = (string) (
                $content['subject']
                ?? 'Confirm your email address'
            );

            /*
             * Escape values before placing them inside HTML.
             */
            $safeName = htmlspecialchars(
                $userName,
                ENT_QUOTES | ENT_SUBSTITUTE,
                'UTF-8'
            );

            $safeConfirmUrl = htmlspecialchars(
                $confirmUrl,
                ENT_QUOTES | ENT_SUBSTITUTE,
                'UTF-8'
            );

            /*
             * ------------------------------------------------------------
             * SMTP configuration
             * ------------------------------------------------------------
             */

            $mail->isSMTP();

            $mail->Host = $_ENV['SMTP_HOST'] ?? 'mail.smtp2go.com';
            $mail->SMTPAuth = true;

            $mail->Username = $_ENV['SMTP_USERNAME'];
            $mail->Password = $_ENV['SMTP_PASSWORD'];

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = (int) ($_ENV['SMTP_PORT'] ?? 587);

            /*
             * ------------------------------------------------------------
             * Sender
             * ------------------------------------------------------------
             */

            $mail->setFrom(
                $_ENV['MAIL_FROM'],
                $_ENV['MAIL_FROM_NAME']
            );

            /*
             * ------------------------------------------------------------
             * Recipient
             * ------------------------------------------------------------
             */

            $mail->addAddress($email);

            /*
             * Optional Reply-To
             */
            if (!empty($_ENV['MAIL_REPLY_TO'])) {
                $mail->addReplyTo(
                    $_ENV['MAIL_REPLY_TO'],
                    $_ENV['MAIL_FROM_NAME']
                );
            }

            /*
             * ------------------------------------------------------------
             * Email body
             * ------------------------------------------------------------
             */

            $body = <<<HTML
<!DOCTYPE html>
<html
    lang="en"
    xmlns="http://www.w3.org/1999/xhtml"
>
<head>
    <meta
        http-equiv="Content-Type"
        content="text/html; charset=utf-8"
    />

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    />

    <title>Verify your email address</title>

    <style>
        body {
            margin: 0;
            padding: 36px 0;
            background-color: #fafbfc;
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
        }

        .email-body {
            width: 100%;
            background-color: #fafbfc;
        }

        .logo {
            padding-bottom: 30px;
            text-align: center;
            color: #b6b8bd;
            font-size: 15px;
        }

        .content-box {
            width: 478px;
            max-width: calc(100% - 40px);
            margin: 0 auto;
            background-color: #ffffff;
            padding: 36px 36px 20px;
            border-radius: 6px;
            box-shadow:
                0 1px 2px rgba(174, 184, 193, 0.67),
                0 11px 22px rgba(0, 0, 0, 0.13);
        }

        .title {
            margin: 0 0 18px;
            font-size: 27px;
            line-height: 1.15;
            font-weight: 700;
            color: #000000;
        }

        .text {
            margin: 1em 0;
            font-size: 16px;
            line-height: 25px;
            color: #596569;
        }

        .button-container {
            text-align: center;
            padding: 10px 0 20px;
        }

        .button {
            display: inline-block;
            min-width: 200px;
            padding: 12px 20px;
            background-color: #32a0e8;
            border: 1px solid #258cd0;
            border-radius: 5px;
            color: #ffffff !important;
            font-size: 16px;
            font-weight: 600;
            line-height: 20px;
            text-align: center;
            text-decoration: none;
        }

        .button:hover {
            background-color: #258cd0;
        }

        .accent {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            font-weight: 600;
            line-height: 2;
            color: #000000;
        }

        .divider {
            margin: 26px 0;
            border: 0;
            border-top: 1px solid #dfebf6;
        }

        .footer {
            padding-top: 24px;
            text-align: center;
        }

        .footer-text {
            margin: 0 0 8px;
            font-size: 13px;
            line-height: 1.69;
            color: #596569;
        }

        .footer-text a {
            color: #596569;
            text-decoration: underline;
        }

        @media screen and (max-width: 596px) {
            body {
                padding: 20px 0;
            }

            .content-box {
                width: auto;
                max-width: calc(100% - 36px);
                padding: 25px 18px 15px;
            }

            .title {
                font-size: 24px;
            }

            .text {
                font-size: 15px;
            }

            .button {
                display: block;
                width: auto;
            }
        }
    </style>
</head>

<body>

<table
    class="email-body"
    cellpadding="0"
    cellspacing="0"
    border="0"
>
    <tr>
        <td align="center">

            <!-- Logo / Brand -->
            <div class="logo">
                SME Finance Hub
            </div>

            <!-- Main Content -->
            <table
                class="content-box"
                cellpadding="0"
                cellspacing="0"
                border="0"
            >
                <tr>
                    <td>

                        <h1 class="title">
                            Confirm Email Address
                        </h1>

                        <p class="text">
                            Hello {$safeName},
                        </p>

                        <p class="text">
                            Please confirm your email address
                            by clicking the button below.
                        </p>

                        <p class="text">
                            We need to confirm that this email
                            address belongs to you before you
                            can continue using SME Finance Hub.
                        </p>

                        <!-- Confirmation Button -->
                        <div class="button-container">
                            <a
                                href="{$safeConfirmUrl}"
                                class="button"
                            >
                                Confirm Email Address
                            </a>
                        </div>

                        <hr class="divider">

                        <p class="text">
                            <strong class="accent">
                                Not sure what this email is for?
                            </strong>

                            This email was sent because an account
                            was registered using this email address
                            on SME Finance Hub.
                        </p>

                        <p class="text">
                            If you did not create this account,
                            you can safely ignore this email.
                        </p>

                    </td>
                </tr>
            </table>

            <!-- Footer -->
            <div class="footer">

                <p class="footer-text">
                    SME Finance Hub<br>
                    Darkuman Rd, Nyamekye Darkuman,
                    Accra - Ghana
                </p>

                <p class="footer-text">
                    This is an automated email.
                    Please do not reply to this message.
                </p>

            </div>

        </td>
    </tr>
</table>

</body>
</html>
HTML;

            /*
             * ------------------------------------------------------------
             * Configure email content
             * ------------------------------------------------------------
             */

            $mail->isHTML(true);

            $mail->CharSet = 'UTF-8';

            $mail->Subject = $subject;

            $mail->Body = $body;

            /*
             * Plain-text fallback for email clients
             * that don't support HTML.
             */
            $mail->AltBody = sprintf(
                "Hello %s,\n\n" .
                "Please confirm your email address by visiting " .
                "the following link:\n\n%s\n\n" .
                "If you did not create this account, " .
                "you can safely ignore this email.",
                $userName,
                $confirmUrl
            );

            /*
             * ------------------------------------------------------------
             * Send email
             * ------------------------------------------------------------
             */

            $mail->send();

            return [
                'success' => true,
                'message' => 'Email sent successfully',
            ];

        } catch (Exception $e) {

            return [
                'success' => false,
                'message' => $mail->ErrorInfo !== ''
                    ? $mail->ErrorInfo
                    : $e->getMessage(),
            ];
        }
    }
    public function send_password_reset_email(
        string $email,
        array $content
    ): array {
        $mail = new PHPMailer(true);

        try {
            /*
             * ------------------------------------------------------------
             * Validate required configuration
             * ------------------------------------------------------------
             */

            $requiredEnv = [
                'SMTP_USERNAME',
                'SMTP_PASSWORD',
                'MAIL_FROM',
                'MAIL_FROM_NAME',
            ];

            foreach ($requiredEnv as $envKey) {
                if (empty($_ENV[$envKey])) {
                    throw new Exception(
                        "Missing environment variable: {$envKey}"
                    );
                }
            }

            /*
             * ------------------------------------------------------------
             * Get email content
             * ------------------------------------------------------------
             */

            $confirmUrl = (string) ($content['reset_url'] ?? '');

            if ($confirmUrl === '') {
                throw new Exception(
                    json_encode($content['reset_url'])
                );
            }

            $userName = (string) ($content['name'] ?? 'there');

            $subject = (string) (
                $content['subject']
                ?? 'Reset your password'
            );

            /*
             * Escape values before placing them inside HTML.
             */
            $safeName = htmlspecialchars(
                $userName,
                ENT_QUOTES | ENT_SUBSTITUTE,
                'UTF-8'
            );

            $safeConfirmUrl = htmlspecialchars(
                $confirmUrl,
                ENT_QUOTES | ENT_SUBSTITUTE,
                'UTF-8'
            );

            /*
             * ------------------------------------------------------------
             * SMTP configuration
             * ------------------------------------------------------------
             */

            $mail->isSMTP();

            $mail->Host = $_ENV['SMTP_HOST'] ?? 'mail.smtp2go.com';
            $mail->SMTPAuth = true;

            $mail->Username = $_ENV['SMTP_USERNAME'];
            $mail->Password = $_ENV['SMTP_PASSWORD'];

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = (int) ($_ENV['SMTP_PORT'] ?? 587);

            /*
             * ------------------------------------------------------------
             * Sender
             * ------------------------------------------------------------
             */

            $mail->setFrom(
                $_ENV['MAIL_FROM'],
                $_ENV['MAIL_FROM_NAME']
            );

            /*
             * ------------------------------------------------------------
             * Recipient
             * ------------------------------------------------------------
             */

            $mail->addAddress($email);

            /*
             * Optional Reply-To
             */
            if (!empty($_ENV['MAIL_REPLY_TO'])) {
                $mail->addReplyTo(
                    $_ENV['MAIL_REPLY_TO'],
                    $_ENV['MAIL_FROM_NAME']
                );
            }

            /*
             * ------------------------------------------------------------
             * Email body
             * ------------------------------------------------------------
             */

            $body = <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reset Account Password</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&amp;display=swap" rel="stylesheet">
  <style>
    body,
    .template-email-body {
      margin: 0;
      font-family: 'Open Sans', Helvetica, Arial, sans-serif;
      background-color: #fafbfc;
      width: 100%;
    }

    body {
      padding: 36px 0;
    }

    .template-email-body {
      padding: 0;
    }

    .template-email-content-box {
      margin: 8px 0 0;
    }

    .template-email-content-container {
      background-color: #ffffff;
      width: 478px;
      padding: 36px 36px 20px;
      border-radius: 4px;
      box-shadow: 0 1px 2px 0 #aeb8c1ac, 0 11px 22px 0 #00000021;
      vertical-align: top;
    }

    h1,
    .template-email-title {
      margin: 0 0 18px;
      font-size: 27px;
      font-weight: bold;
      font-stretch: normal;
      font-style: normal;
      line-height: 1.15;
      letter-spacing: -0.6px;
      color: #000000;
      text-align: left;
    }

    p,
    .template-email-text {
      font-size: 16px;
      font-weight: normal;
      font-stretch: normal;
      font-style: normal;
      line-height: 1.56;
      letter-spacing: -0.12px;
      color: #596569;
      margin: 1em 0;
      text-align: left;
    }
    
    td.template-email-button table {
      margin: 0 58px;
    }

    a.template-email-blue-action-button {
      display: block;
      width: 100%;
      text-align: center;
      border-radius: 3px;
      background-color: #32a0e8;
      font-size: 16px;
      font-weight: 600;
      font-stretch: normal;
      font-style: normal;
      line-height: 1.31;
      letter-spacing: -0.22px;
      text-decoration: none;
      color: #ffffff;
      transition: all .15s;
    }

    a.template-email-blue-action-button:hover {
      background-color: #258cd0;
    }

    strong.template-email-text-accent,
    .template-email-text-accent {
      display: block;
      font-size: 16px;
      font-weight: 600;
      font-stretch: normal;
      font-style: normal;
      line-height: 2;
      letter-spacing: -0.14px;
      color: #000000;
    }

    p.template-email-footer-text,
    .template-email-footer-text {
      font-size: 13px;
      font-weight: normal;
      font-stretch: normal;
      font-style: normal;
      line-height: 1.69;
      letter-spacing: -0.1px;
      text-align: center;
      color: #596569;
      margin-bottom: 2px;
      margin-top: 0;
    }

    a,
    .template-email-footer-text a {
      color: #596569;
      text-decoration: underline;
    }

    a:hover,
    .template-email-footer-text a:hover {
      text-decoration: none;
    }

    @media screen and (max-width: 596px) {
      .template-email-content-container {
        max-width: 100%;
      }

      .template-email-blue-action-button {
        padding-top: 4px;
        padding-bottom: 4px;
      }

      td.template-email-button table {
        margin: 0 auto;
      }

      td.template-button-container {
        width: 100%;
        height: auto;
      }
    }

    @media screen and (max-width: 380px) {
      .template-email-content-container {
        padding: 18px 18px 2px;
      }
    }
  </style>
  <!--[if mso]><style>
    td.template-email-button table {
      margin: 0 auto;
    }
  </style><![endif]-->
</head>

<body>
  <table class="template-email-body">
    <tr>
      <td class="template-email-float-center" align="center" valign="top">
        <table class="template-email-logo">
          <tr>
            <td>
              <center>
                <p style="color: #b6b8bd; padding-bottom: 30px; text-align: center;">SME Finance Hub</p>
              </center>
            </td>
          </tr>
        </table>
        <table class="template-email-content-box">
          <tr>
            <td class="template-email-content-container">
              <table>
                <tr>
                  <td class="template-email-content">

                    <h1 class="template-email-title">
                      <!--[if mso]><span style="font-family: sans-serif;"><![endif]-->
                      Reset your account password
                      <!--[if mso]></span><![endif]-->
                    </h1>
                    <p class="template-email-text" style="mso-line-height: exactly; line-height: 25px;">
                      <!--[if mso]><span style="font-family: sans-serif;"><![endif]-->
                      Please reset your account password by clicking the link below.
                      <!--[if mso]></span><![endif]-->
                    </p>
                  </td>
                </tr>
                <tr>
                  <td class="template-email-button">
                    <table>
                      <tr>
                        <td cellpadding="0" style="padding: 0;">
                          <div>
                            <!--[if mso]>
                          <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ reset_url }}" style="height:36px;v-text-anchor:middle;width:240px;" arcsize="10%" stroke="f" fillcolor="#32a0e8">
                            <w:anchorlock/>
                            <center style="color:#ffffff;font-family:sans-serif;font-size:16px;font-weight:bold;">
                              Confirm Email Address
                            </center>
                          </v:roundrect>
                          <![endif]-->
                            <!--[if !mso]><!-->
                            <table cellspacing="0" cellpadding="0">
                              <tr>
                                <td align="center" width="240" height="36" bgcolor="#32a0e8"
                                  style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;box-shadow: 0px 0px 0px 1px #121212;"
                                  class="template-button-container">
                                  <a href="{{ reset_url }}" class="template-email-blue-action-button"
                                    style="font-size:16px; font-weight: 600; font-family: 'Open Sans', Helvetica, Arial, sans-serif; text-decoration: none; line-height:36px; width:100%; letter-spacing: -0.22px;display:inline-block">
                                    <span style="color: #ffffff; padding-left: 10px; padding-right: 10px;">
                                      Reset Password
                                    </span>
                                  </a>
                                </td>
                              </tr>
                            </table>
                            <!--[endif]><!-->
                          </div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <!--[if !mso]><!-->
                <tr>
                  <td>
                    <hr style="margin-top: 26px; background: #dfebf6; border: 1px solid #dfebf6;">
                  </td>
                </tr>
                <!--[endif]><!-->
                <tr>
                  <td class="template-email-content">
                    <p class="template-email-text" style="mso-line-height: exactly; line-height: 25px;">
                      <!--[if mso]><span style="font-family: sans-serif; font-weight: bold;"><![endif]-->
                      <b class="template-email-text-accent">
                      Not sure what this email is for?
                      </b>
                      <!--[if mso]></span><![endif]-->
                    </p>
                    <p class="template-email-text" style="mso-line-height: exactly; line-height: 25px;">
                      <!--[if mso]><span style="font-family: sans-serif;"><![endif]-->
                      It’s sent to our customers who subscribed to emails regarding our services. Feel free to discard
                      this email if you didn’t enroll for any product or service regarding our company.
                      <!--[if mso]></span><![endif]-->
                    </p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <table class="template-email-footer">
          <tr>
            <td style="padding-top: 24px;">
              <center>
                <p class="template-email-footer-text">
                  <!--[if mso]><span style="font-family: sans-serif;"><![endif]-->
                  Darkuman Rd, Nyamekye Darkuman, Accra - Ghana
                  <!--[if mso]></span><![endif]-->
                </p>
                <p class="template-email-footer-text">
                  <!--[if mso]><span style="font-family: sans-serif;"><![endif]-->
                  No longer wish to receive this type of email from us? <a href="%%UNSUBSCRIBE%%">Unsubscribe</a>
                  <!--[if mso]></span><![endif]-->
                </p>
              </center>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>
HTML;

            /*
             * ------------------------------------------------------------
             * Configure email content
             * ------------------------------------------------------------
             */

            $mail->isHTML(true);

            $mail->CharSet = 'UTF-8';

            $mail->Subject = $subject;

            $mail->Body = $body;

            /*
             * Plain-text fallback for email clients
             * that don't support HTML.
             */
            $mail->AltBody = sprintf(
                "Hello %s,\n\n" .
                "Please confirm your email address by visiting " .
                "the following link:\n\n%s\n\n" .
                "If you did not create this account, " .
                "you can safely ignore this email.",
                $userName,
                $confirmUrl
            );

            /*
             * ------------------------------------------------------------
             * Send email
             * ------------------------------------------------------------
             */

            $mail->send();

            return [
                'success' => true,
                'message' => 'Email sent successfully',
            ];

        } catch (Exception $e) {

            return [
                'success' => false,
                'message' => $mail->ErrorInfo !== ''
                    ? $mail->ErrorInfo
                    : $e->getMessage(),
            ];
        }
    }
}