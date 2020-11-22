<?php
    require 'db_connect.php';
    $id = $_GET['id'];

    $status = 1;

    $sql = "SELECT * FROM orders WHERE user_id = :v1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $id);
    $stmt->execute();
    $all = $stmt->fetchAll();
    foreach($all as $a){
        $ito_id = $a['id'];
        
        $sql = "DELETE FROM item_order WHERE order_id = :v1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':v1', $ito_id);
        $stmt->execute();
    }

    $sql = "DELETE FROM orders WHERE user_id = :v1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $id);
    $stmt->execute();

    $sql = "DELETE FROM model_has_roles WHERE user_id = :v1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $id);
    $stmt->execute();

    $sql = "DELETE FROM users WHERE id = :v1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $id);
    $stmt->execute();

    header("location:user.php");

?>