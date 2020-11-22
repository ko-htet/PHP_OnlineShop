<?php
    $servername = "localhost";
    $dbname = "b18_pos";
    $user = "root";
    $password = "";

    $dsn = "mysql:host=$servername; dbname=$dbname";

    $pdo = new PDO($dsn, $user, $password);
    try{
        $conn = $pdo;
        
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connection successfully";

    }catch(PDOException $e){
        echo "Connection failed: ".$e->getMessage();
    }

?>