<?php
// Services/Email.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../lib/src/Exception.php';
require '../../lib/src/PHPMailer.php';
require '../../lib/src/SMTP.php';

class Email
{
    private static function setupMailer()
    {
        $mailer = new PHPMailer(true);

        // Server settings
        $mailer->isSMTP();
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPAuth = true;
        $mailer->Username = 'zeinaabdelhameed235@gmail.com'; // Your Gmail
        $mailer->Password = 'afgvgeemlxjanbcm'; // Your App Password
        $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mailer->Port = 587;

        // Default sender
        $mailer->setFrom('zeinaabdelhameed235@gmail.com', 'Winku');

        return $mailer;
    }

    public static function sendEmail($recipientEmail, $message, $subject = 'Welcome to Our Service!')
    {
        try {
            // Validate email
            if (!filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Invalid email address');
            }

            $mailer = self::setupMailer();

            // Add recipient
            $mailer->addAddress($recipientEmail);

            // Content
            $mailer->isHTML(true);
            $mailer->Subject = $subject;
            $mailer->Body = self::getEmailTemplate($message, $subject);
            $mailer->AltBody = strip_tags($message);

            // Send email
            $mailer->send();
            return true;
        } catch (Exception $e) {
            // Log error if needed
            error_log("Email sending failed: " . $e->getMessage());
            return false;
        }
    }

    private static function getEmailTemplate($message, $subject)
    {
        return '
            <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
                <h2 style="color: #4285f4;">' . $subject . '</h2>
                <div>' . $message . '</div>
                <p style="margin-top: 30px;">Best regards,<br>Winku</p>
            </div>
        ';
    }
}
