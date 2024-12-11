<?php
    require_once "conn.php";

    class Crud {

        Private $conn;
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

        Private function checkMethod() {
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                return true;
            }
            return false;
        }

        // CREATE

        Public function insertRecord($tableName, $valuesToInsert) {

            if (!checkMethod()) { return false; }

            $columnsStr = implode(", ", array_map(fn($col) => "`$col`", array_keys($valuesToInsert)));
            $parametersStr = implode(", ", array_map(fn($key) => ":$key", array_keys($valuesToInsert)));

            $insertSql = "INSERT INTO `$tableName` ($columnsStr) VALUES ($parametersStr)";
            try {
                $stmt = $conn->prepare($insertSql);
                foreach ($valuesToInsert as $key => $value) {
                    $stmt->bindValue(":$key", $value);
                }

                $stmt->execute();
                return true; 

            } catch (Exception $ex) {
                echo "Error inserting record: " . $ex->getMessage();
                return false;
            }
        }


        // READ

        // GET ALL VALUES

        Public function getAllData($tableName) {
            $resultTable = [];
            $query = "SELECT * FROM `$tableName`";

            try {
                // Prepare the SQL query
                $stmt = $conn->prepare($query);
                $stmt->execute();

                // Fetch all rows as an associative array
                $resultTable = $stmt->fetchAll(PDO::FETCH_ASSOC);

            } catch (Exception $ex) {
                // Handle exceptions
                echo "Error retrieving rows: " . $ex->getMessage();
            }

            return $resultTable; // Return the fetched data
        }


        // UPDATE

        Public function updateRecord($tableName, $targetCol, $targetValue, $updatedValues) {
            // Build the SET part of the query
            $setPart = "";
            $firstColumn = true;

            foreach ($updatedValues as $column => $value) {
                if (!$firstColumn) {
                    $setPart .= ", ";
                }
                $setPart .= "`$column` = :$column";
                $firstColumn = false;
            }

            // Construct the full SQL query
            $query = "UPDATE `$tableName` SET $setPart WHERE  $targetCol` = :targetValue
            ";

            try {
                $stmt = $conn->prepare($query);

                foreach ($updatedValues as $column => $value) {
                    $stmt->bindValue(":$column", $value);
                }

                $stmt->bindValue(":targetValue", $targetValue, PDO::PARAM_INT);

                $stmt->execute();

                return true; // Update successful
            } catch (Exception $ex) {
                // Handle exception
                echo "Error updating record: " . $ex->getMessage();
                return false;
            }
        }
    }
?>