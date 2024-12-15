<?php
    ob_start();

    require_once "../utils/db/crud.php";
    require_once "../constants/users.php";

    session_start();
  
    class routes {
        public function check_session($token_type) {

            $crud = new Crud();
            $usr_C = new UserConstants();

            // handle missing token
            try 
            {
                if (!isset($_COOKIE[$token_type]) || empty($_COOKIE[$token_type])) {
                    return false;
                    exit;
                }
                
                if (!isset($_SESSION[$token_type]) || empty($_SESSION[$token_type])) {
                    return false;
                    exit;
                }

                $get_user_token = $crud->getRowByValue(
                    $usr_C->getTableName(),
                    $token_type,
                    $_COOKIE[$token_type]
                );
                
                // handle token validation
                
                if (count($get_user_token) === 0 || 
                $_SESSION[$token_type] !== $_COOKIE[$token_type] || 
                $_SESSION[$token_type] !== $get_user_token[0][$token_type]) {

                return false;
                exit;
            }     
            }catch (Exception $ex) {
                $this->deny_direct_access();
                return false;
                exit;
            }

            // return true if success
            return true;
        }

        public function init_session($user_id, $token_type, $newToken, $timeout=300) {
       

            $crud = new Crud();
            $usr_C = new UserConstants();
            
            $update_data = [
                $token_type => $newToken
            ];
           
            $crud->updateRecord($usr_C->getTableName(), $usr_C->getUserId(), $user_id, $update_data);
            setcookie($token_type, $newToken, time() + $timeout, '/', '', false, true); 
            $_SESSION[$token_type] = $newToken;
        }

        public function deny_direct_access() {
            header("HTTP/1.0 403 Forbidden");
            exit;
        }
    }

    ob_end_flush();
?>