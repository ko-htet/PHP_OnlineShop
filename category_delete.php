<?php
    require 'db_connect.php';

    $id = $_GET['did'];
    // if delete with post method $id = $_POST['id'];
    
    $sql = "DELETE FROM categories WHERE id = :v1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $id);
    $stmt->execute();

    header("location:category_list.php");

?>