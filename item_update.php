<?php
    require 'db_connect.php';

    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $description = $_POST['description'];
    $brand_id = $_POST['brand_id'];
    $subcategory_id = $_POST['subcategory_id'];
    $oldphoto = $_POST['oldphoto'];

    $newphoto = $_FILES['newphoto'];
    if($newphoto['size'] > 0){
        $source_dir = 'images/brands/';
        $file_name = strtotime('now');
        $file_exe_array = explode('.', $newphoto['name']);
        $file_exe = $file_exe_array[1];

        $file_path = $source_dir.$file_name.'.'.$file_exe;
        move_uploaded_file($newphoto['tmp_name'], $file_path);
    }else{
        $file_path = $oldphoto;
    }
    
    $sql = "UPDATE items SET name=:v1, photo=:v2, price=:v3, discount=:v4, description=:v5, brand_id=:v6, subcategory_id=:v7 WHERE id=:v8";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $name);
    $stmt->bindParam(':v2', $file_path);
    $stmt->bindParam(':v3', $price);
    $stmt->bindParam(':v4', $discount);
    $stmt->bindParam(':v5', $description);
    $stmt->bindParam(':v6', $brand_id);
    $stmt->bindParam(':v7', $subcategory_id);
    $stmt->bindParam(':v8', $id);
    $stmt->execute();

    header("location:item_list.php");

?>