<?php
    session_start();
    require 'db_connect.php';

    $item = $_POST['item'];
    $notes = $_POST['notes'];
    $total = $_POST['total'];
    
    date_default_timezone_set("Asia/Rangoon");
    $orderdate = date('Y-m-d');

    $voucherno = strtotime(date("h:i:s"));
    $status = "Order";
    $userid = $_SESSION['login_user']['id'];

    $sql = "INSERT INTO orders (orderdate, voucherno, total, note, status, user_id)
            VALUES (:v1, :v2, :v3, :v4, :v5, :v6)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $orderdate);
    $stmt->bindParam(':v2', $voucherno);
    $stmt->bindParam(':v3', $total);
    $stmt->bindParam(':v4', $notes);
    $stmt->bindParam(':v5', $status);
    $stmt->bindParam(':v6', $userid);
    $stmt->execute();

    $last_id = $conn->lastInsertId();
    foreach($item as $key => $value){
        $id = $value['id'];
        $qty = $value['qty'];

        $sql = "INSERT INTO item_order (qty, item_id, order_id) VALUES (:v1, :v2, :v3)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':v1', $qty);
        $stmt->bindParam(':v2', $id);
        $stmt->bindParam(':v3', $last_id);
        $stmt->execute();
    }

?>