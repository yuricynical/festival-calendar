<?php
    include "conn.php";

    // CHECK REQ

    function checkMethod() {
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            return true;
        }
        return false;
    }

    // CREATE

    function insertRecord($tableName, $valuesToInsert) {

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
    
    function getAllData($tableName, $conn) {
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

    function updateRecord($tableName, $columnName, $idValue, $updatedValues) {
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
        $query = "UPDATE `$tableName` SET $setPart WHERE `$columnName` = :idValue";

        try {
            $stmt = $conn->prepare($query);

            foreach ($updatedValues as $column => $value) {
                $stmt->bindValue(":$column", $value);
            }
    
            $stmt->bindValue(":idValue", $idValue, PDO::PARAM_INT);
            $stmt->execute();
    
            return true; // Update successful
        } catch (Exception $ex) {
            // Handle exception
            echo "Error updating record: " . $ex->getMessage();
            return false;
        }
    }

  

?>