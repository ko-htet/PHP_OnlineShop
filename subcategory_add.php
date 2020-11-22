<?php
    require 'db_connect.php';

    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    
    $sql = "INSERT INTO subcategories (name, category_id) VALUES (:value1, :value2)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1', $name);
    $stmt->bindParam(':value2', $category_id);
    $stmt->execute();

    header("location:subcategory_list.php");

?>