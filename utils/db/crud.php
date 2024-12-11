<?php
    require_once "conn.php";

    class Crud {

        Public $conn;
        Private $currentPage;

        public function __construct() {
            $connIns = new Conn(); 
            $this -> conn = $connIns->getConn(); 
            $this -> currentPage = htmlspecialchars($_SERVER["PHP_SELF"]);
        }
        
        public function getCurrentPage() {
            return $this->currentPage;
        }

        // CHECK REQ

        Public function checkMethod() {
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                return true;
            }
            return false;
        }

        // CREATE

        Public function insertRecord($tableName, $valuesToInsert) {

            if (!$this-> checkMethod()) return false; 

            $columnsStr = implode(", ", array_map(fn($col) => "`$col`", array_keys($valuesToInsert)));
            $placeholders = implode(", ", array_fill(0, count($valuesToInsert), "?"));
        
            $insertSql = "INSERT INTO `$tableName` ($columnsStr) VALUES ($placeholders)";
            
            try {
      
                $stmt = $this->conn->prepare($insertSql);

                if ($stmt === false) {
                    throw new Exception("Failed to prepare statement: " . $this->conn->error);
                }

         
                $types = str_repeat("s", count($valuesToInsert)); 
                $values = array_values($valuesToInsert); 
                $stmt->bind_param($types, ...$values);

                $stmt->execute();
                return true;
        
            } catch (Exception $ex) {
                echo "Error inserting record: " . $ex->getMessage();
                return false;
            }
        }


        // READ

        // GET ALL VALUES

        public function getAllData($tableName) {
            if (!$this-> checkMethod()) return false; 

            $resultTable = [];
            $query = "SELECT * FROM `$tableName`";
        
            try {
                $stmt = $this->conn->prepare($query);
                
                if (!$stmt) {
                    throw new Exception("Failed to prepare statement: " . $this->conn->error);
                }
        
                $stmt->execute();
                $result = $stmt->get_result();
        
                if ($result) {
                    $resultTable = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    throw new Exception("Error getting result: " . $stmt->error);
                }
        
                $stmt->close();
        
            } catch (Exception $ex) {
                echo "Error retrieving rows: " . $ex->getMessage();
            }
        
            return $resultTable; // Return the fetched data
        }

        // UPDATE

        public function updateRecord($tableName, $targetCol, $targetValue, $updatedValues) {
            if (!$this-> checkMethod()) return false; 

            $setPart = "";
            $types = "";
            $params = []; 
        
            foreach ($updatedValues as $column => $value) {
                $setPart .= "`$column` = ?, ";
                $types .= $this->getParamType($value);
                $params[] = $value;
            }
        
            $setPart = rtrim($setPart, ", ");
            $types .= $this->getParamType($targetValue);
            $params[] = $targetValue;
        
            $query = "UPDATE `$tableName` SET $setPart WHERE `$targetCol` = ?";
        
            try {
                $stmt = $this->conn->prepare($query);
        
                if (!$stmt) {
                    throw new Exception("Failed to prepare statement: " . $this->conn->error);
                }
        
                $stmt->bind_param($types, ...$params);
                $stmt->execute();
        
                return $stmt->affected_rows > 0; // Return true if rows were updated
            } catch (Exception $ex) {
                // Handle exceptions
                echo "Error updating record: " . $ex->getMessage();
                return false;
            }
        }

         // Helper function to determine parameter type for MySQLi bind_param
 
        private function getParamType($value) {
            switch (gettype($value)) {
                case 'integer':
                    return 'i'; // Integer
                case 'double':
                    return 'd'; // Double
                case 'string':
                    return 's'; // String
                default:
                    return 'b'; // Blob or unknown
            }
        }
    }
?>