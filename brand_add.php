<?php
    require 'db_connect.php';

    $name = $_POST['name'];
    $photo = $_FILES['photo'];

    $sorce_dir = "images/brands/";
    $file_name = strtotime('now');
    $file_exe_array = explode('.', $photo['name']);
    $file_exe = $file_exe_array[1];
    
    $file_path = $sorce_dir.$file_name.'.'.$file_exe;
    move_uploaded_file($photo['tmp_name'], $file_path);

    $sql = "INSERT INTO brands (name, photo) VALUES (:value1, :value2)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1', $name);
    $stmt->bindParam(':value2', $file_path);
    $stmt->execute();

    header("location:brand_list.php");

?>