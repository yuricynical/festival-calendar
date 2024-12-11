<?php
    require_once("files.php");

    class Encryption{
        Private $key = Null;
        Private $byteCode = Null;

        public function __construct() {
            $fileUtils = new files();
            $getEnv = $fileUtils->getEnvVar();
            
            $this->byteCode = $getEnv['PASS_BYTE_CODE'];
            $this->key = $getEnv['PASS_KEY_CODE'];
        }

        function generateAuthCode($length = 6) {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            
            $authCode = '';
            for ($i = 0; $i < $length; $i++) {
                $authCode .= $characters[random_int(0, strlen($characters) - 1)];
            }
            
            return $authCode;
        }

        function encryptPassword($clearText) {
            $clearBytes = mb_convert_encoding($clearText, 'UTF-16LE'); 
            $salt = hex2bin($this->byteCode);
            
            $iterations = 1000; 
            $keyLength = 32; 
            $ivLength = 16;
            
            $keyAndIv = openssl_pbkdf2($this->key, $salt, $keyLength + $ivLength, $iterations, 'sha256');
            
            $key = substr($keyAndIv, 0, $keyLength);
            $iv = substr($keyAndIv, $keyLength, $ivLength);
            
            $encrypted = openssl_encrypt($clearBytes, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    
            return base64_encode($encrypted);
        }

        // Function to DecryptPassword
        
        function decryptPassword($cipherText) {
          
            $cipherBytes = base64_decode($cipherText);
            $salt = hex2bin($this->byteCode);
            
            $iterations = 1000;
            $keyLength = 32; 
            $ivLength = 16;   
            $keyAndIv = openssl_pbkdf2($this->key, $salt, $keyLength + $ivLength, $iterations, 'sha256');

            $key = substr($keyAndIv, 0, $keyLength);
            $iv = substr($keyAndIv, $keyLength, $ivLength);

            $decrypted = openssl_decrypt($cipherBytes, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
            return mb_convert_encoding($decrypted, 'UTF-8'); // Convert from UTF-16LE back to UTF-8
        }
    }
?>