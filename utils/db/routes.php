<?php
    require_once "../utils/db/crud.php";
    require_once "../constants/users.php";
    session_start();

    class routes {
        public function check_session() {

            $crud = new Crud();
            $usr_C = new UserConstants();

            // handle missing token
            try 
            {
                if (!isset($_COOKIE[$usr_C->getSessionToken()]) || empty($_COOKIE[$usr_C->getSessionToken()])) {
                    $this->deny_direct_access();
                    exit;
                }
                
                $get_user_token = $crud->getRowByValue(
                    $usr_C->getTableName(),
                    $usr_C->getSessionToken(),
                    $_COOKIE[$usr_C->getSessionToken()]
                );
                
                // handle token validation
                
                if (count($get_user_token) === 0 || 
                $_SESSION[$usr_C->getSessionToken()] !== $_COOKIE[$usr_C->getSessionToken()] || 
                $_SESSION[$usr_C->getSessionToken()] !== $get_user_token[0][$usr_C->getSessionToken()]) {

                $this->deny_direct_access();
                exit;
            }     
            }catch (Exception $ex) {
                $this->deny_direct_access();
                exit;
            }
        }

        public function init_token($newToken, $timeout=300) {
            $usr_C = new UserConstants();
            setcookie($usr_C->getSessionToken(), $newToken, time() + $timeout, '/', '', false, true); 
            $_SESSION[$usr_C->getSessionToken()] = $newToken;
        }

        public function deny_direct_access() {
            header("HTTP/1.0 403 Forbidden");
            echo "Direct access is not allowed.";
            exit;
        }

    }
?>