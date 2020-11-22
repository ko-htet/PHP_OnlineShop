<?php
    require 'db_connect.php';

    $id = $_POST['id'];
    $name = $_POST['name'];
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
    
    $sql = "UPDATE brands SET name = :v1, photo = :v2 WHERE id = :v3";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $name);
    $stmt->bindParam(':v2', $file_path);
    $stmt->bindParam(':v3', $id);
    $stmt->execute();

    header("location:brand_list.php");

?>