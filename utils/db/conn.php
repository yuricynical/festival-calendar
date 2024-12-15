<?php
    require_once 'files.php';

    Class Conn {
        Private $conn = Null;
        Private $serverName = Null;

        Public function __construct() {
            $fileUtils = new files();
            $envVariables = $fileUtils->getEnvVar();
        
            $this->serverName =  $envVariables['PHP_DB_SERVER_NAME'];
            $username =  $envVariables['PHP_DB_UID'];
            $password = $envVariables['PHP_DB_PWD'];  // If it's an empty string, it will return an empty string
            $dbname = $envVariables['PHP_DB_NAME'];
        
            $this->conn = new mysqli("$this->serverName", "$username", "$password", "$dbname");
       
            // Check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error); 
            }
        }

        public function getConn() {
            return $this->conn;
        }

        public function getServerName() {
            return $this->serverName;
        }
    }
?>