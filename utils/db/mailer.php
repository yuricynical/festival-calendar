<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
   
    require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';
    
    class Mailer{   
        public function sendMail($address, $subject, $content) {
            $files = new Files();
            $envFile = $files->getEnvVar();
            $host = $envFile['GMAIL_HOST'];
            $mail = new PHPMailer(true);

            try{
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                
                $mail->Host = 'smtp.gmail.com';
                $mail->Username = $host;
                $mail->Password= $envFile['GMAIL_PASS_MAILER'];
    
                $mail->SMTPSecure = 'ssl';
                $mail->Port=465;
                
                $mail->setFrom($host);
                $mail->addAddress($address);

                $mail->isHTML(true); 

                $mail->Subject = $subject;
                $mail->Body = $content;

                if ($mail->send()) {
                    return true;
                }else{
                    return false;
                }

            }catch(Exception $ex){
                return false; 
            }  
        }
    }
?>