<?php
    require 'db_connect.php';

    $id = $_POST['id'];
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];

    $sql = "UPDATE subcategories SET name = :v1, category_id = :v2 WHERE id = :v3";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $name);
    $stmt->bindParam(':v2', $category_id);
    $stmt->bindParam(':v3', $id);
    $stmt->execute();

    header("location:subcategory_list.php");

?>