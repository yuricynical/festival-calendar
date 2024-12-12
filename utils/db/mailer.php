<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

    class Mailer{   
        public function sendMail($address, $subject, $content) {
            $mail = new PHPMailer(true);
            $files = new Files();
            $envFile = $files->getEnvVar();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Password= $envFile['GMAIL_PASS_MAILER'];
            $mail->SMTPSecure = 'ssl';
            $mail->Port=465;
            
            $mail->setFrom($envFile['GMAIL_HOST']);
            $mail->addAddress($address);

            $mail->Subject = $subject;
            $mail->Body = $content;
        }
    }
?>