<?php
    require_once "../utils/db/crud.php";
    require_once "../constants/users.php";

    class routes {
        public function check_session() {

            $crud = new Crud();
            $usr_C = new UserConstants();

            // handle missing token

            if (!isset($_COOKIE['user_token']) || empty($_COOKIE['user_token'])) {
                $this->deny_direct_access();
                exit;
            }
            
            $get_user_token = $crud->getRowByValue(
                $usr_C->getTableName(),
                $usr_C->getSessionToken(),
                $_COOKIE['user_token']
            );
            
            // handle token validation

            if (count($get_user_token) === 0) {
                $this->deny_direct_access();
                exit;
            }     
        }

        public function init_token($newToken) {
            setcookie('user_token', $newToken, time() + 300, '/', '', false, true);
        }

        public function deny_direct_access() {
            header("HTTP/1.0 403 Forbidden");
            echo "Direct access is not allowed.";
            exit;
        }

    }
?>