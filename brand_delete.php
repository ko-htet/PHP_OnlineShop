<?php
    require 'db_connect.php';

    $id = $_GET['did'];
    
    $sql = "DELETE FROM brands WHERE id = :v1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $id);
    $stmt->execute();

    header("location:brand_list.php");
?>