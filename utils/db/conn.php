<?php
    include 'files.php';
    $fileUtils = new files();
    $envVariables = $fileUtils -> parseEnvFile(dirname(dirname(__DIR__)) . "\.env");

    $servername =  $envVariables['PHP_DB_SERVER_NAME'];;
    $username = $envVariables['PHP_DB_UID'];
    $password = $envVariables['PHP_DB_PWD'];  // If it's an empty string, it will return an empty string
    $dbname = $envVariables['PHP_DB_NAME'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn -> connect_error);
    }
?>