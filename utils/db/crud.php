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

        Public function sanitize($str, $filter=FILTER_SANITIZE_SPECIAL_CHARS, $input=INPUT_POST) {
            return filter_input($input,$str, $filter);
        }

        // CREATE

        public function insertRecord($tableName, $valuesToInsert)
        {
            $columnsStr = implode(", ", array_map(fn($col) => "`$col`", array_keys($valuesToInsert)));
            $placeholders = implode(", ", array_fill(0, count($valuesToInsert), "?"));
        
            $insertSql = "INSERT INTO `$tableName` ($columnsStr) VALUES ($placeholders)";
        
            try {
                $stmt = $this->conn->prepare($insertSql);
        
                if ($stmt === false) {
                    throw new Exception("Failed to prepare statement: " . $this->conn->error);
                }

                $types = $this->getParamTypes($valuesToInsert);
        
                $values = array_values($valuesToInsert);
                $stmt->bind_param($types, ...$values);
        
                $stmt->execute();
                return $this->conn->insert_id;
                
            } catch (Exception $ex) {
                echo "Error inserting record: " . $ex->getMessage();
                return false;
            }
        }

        // READ

        // GET ALL VALUES

        public function getAllData($tableName) {
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
                    while ($row = $result->fetch_assoc()) {
                        $resultTable[] = $row; 
                    }
                } else {
                    throw new Exception("Error getting result: " . $stmt->error);
                }
        
                $stmt->close();
        
            } catch (Exception $ex) {
                echo "Error retrieving rows: " . $ex->getMessage();
            }
        
            return $resultTable; 
        }
        
        public function getRowByValue($tableName, $columnName, $value) {
            $resultTable = [];
            $query = "SELECT * FROM `$tableName` WHERE `$columnName` = ?";

            try {
                if ($this->conn === null) {
                    throw new Exception("Database connection is not initialized.");
                }

                $stmt = $this->conn->prepare($query);

                if (!$stmt) {
                    throw new Exception("Failed to prepare statement: " . $this->conn->error);
                }

                $type = $this->getParamTypes([$value]);
                $stmt->bind_param($type, $value);

                $stmt->execute();
                $result = $stmt->get_result();

                if (!$result) {
                    throw new Exception("Error executing query: " . $stmt->error);
                }

                while ($row = $result->fetch_assoc()) {
                    $resultTable[] = $row;
                }

                $stmt->close();
            } catch (Exception $ex) {
                echo "Error retrieving row: " . $ex->getMessage();
            }

            return $resultTable;
        }


        public function getRowByTwoValues($tableName, $columnName01, $value01, $columnName02, $value02)
        {
            $resultTable = [];

            $query = "SELECT * FROM `$tableName` WHERE `$columnName01` = ? AND `$columnName02` = ?";

            try {

                $stmt = $this->conn->prepare($query);

                if (!$stmt) {
                    throw new Exception("Failed to prepare statement: " . $this->conn->error);
                }

                $types = $this->getParamTypes([$value01, $value02]);

                $stmt->bind_param($types, $value01, $value02);

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result) {
        
                    while ($row = $result->fetch_assoc()) {
                        $resultTable[] = $row;
                    }
                } else {
                    throw new Exception("Error getting result: " . $stmt->error);
                }

                $stmt->close();
            } catch (Exception $ex) {
                echo "Error retrieving row: " . $ex->getMessage();
            } finally {
                if ($this->conn->ping()) {
                    $this->conn->close();
                }
            }

            return $resultTable;
        }


        // UPDATE

        public function updateRecord($tableName, $targetCol, $targetValue, $updatedValues) {

            $setPart = "";
            $types = "";
            $params = []; 
        
            foreach ($updatedValues as $column => $value) {
                $setPart .= "`$column` = ?, ";
                $types .= $this->getParamTypes($value);
                $params[] = $value;
            }
        
            $setPart = rtrim($setPart, ", ");
            $types .= $this->getParamTypes($targetValue);
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

        private function getParamTypes($params) {
            if (!is_array($params)) {
                $params = [$params];
            }
        
            $types = '';
            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= 'i'; 
                } elseif (is_float($param)) {
                    $types .= 'd'; 
                } elseif (is_string($param)) {
                    $types .= 's'; 
                } elseif (is_null($param)) {
                    $types .= 's'; 
                } else {
                    throw new InvalidArgumentException("Unsupported parameter type: " . gettype($param));
                }
            }
        
            return $types;
        }
    }
?>