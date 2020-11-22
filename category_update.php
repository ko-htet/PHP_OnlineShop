<?php
    require 'db_connect.php';

    $id = $_POST['id'];
    $name = $_POST['name'];
    $oldphoto = $_POST['oldphoto'];

    $newphoto = $_FILES['newphoto'];
    if($newphoto['size'] > 0){
        $source_dir = 'images/category/';
        $file_name = strtotime('now');
        $file_exe_array = explode('.', $newphoto['name']);
        $file_exe = $file_exe_array[1];

        $file_path = $source_dir.$file_name.'.'.$file_exe;
        move_uploaded_file($newphoto['tmp_name'], $file_path);
    }else{
        $file_path = $oldphoto;
    }
    
    $sql = "UPDATE categories SET name = :v1, logo = :v2 WHERE id = :v3";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':v1', $name);
    $stmt->bindParam(':v2', $file_path);
    $stmt->bindParam(':v3', $id);
    $stmt->execute();

    header("location:category_list.php");

?>