<?php
    require 'db_connect.php';

    $name = $_POST['name'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $description = $_POST['description'];
    $brand_id = $_POST['brand_id'];
    $subcategory_id = $_POST['subcategory_id'];
    $photo = $_FILES['photo'];

    $source_dir = "images/items/";
    $file_name = strtotime('now');
    $file_exe_array = explode('.', $photo['name']);
    $file_exe = $file_exe_array[1];

    $file_path = $source_dir.$file_name.'.'.$file_exe;
    move_uploaded_file($photo['tmp_name'], $file_path);
    
    $sql = "INSERT INTO items (name, photo, price, discount, description, brand_id, subcategory_id) VALUES (:v1, :v2, :v3, :v4, :v5, :v6, :v7)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $name);
    $stmt->bindParam(':v2', $file_path);
    $stmt->bindParam(':v3', $price);
    $stmt->bindParam(':v4', $discount);
    $stmt->bindParam(':v5', $description);
    $stmt->bindParam(':v6', $brand_id);
    $stmt->bindParam(':v7', $subcategory_id);
    $stmt->execute();

    header("location:item_list.php");

?>