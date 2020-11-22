<?php
    require 'db_connect.php';

    $id = $_GET['did'];

    $sql = "DELETE FROM subcategories WHERE id = :v1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $id);
    $stmt->execute();

    header("location:subcategory_list.php");

?>