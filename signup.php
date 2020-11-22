<?php

    require 'db_connect.php';

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $address = $_POST['address'];
    $profile = 'images/user.png';
    $roleid = 2;
    $status = 0;
    if($password != $cpassword){
        session_start();
        $_SESSION['reg_fail'] = "Don't match your password and confirm pasword.";
        header("location:register.php");
    } else {
        $sql = "INSERT INTO users (name, profile, phone, address, email, password, status) VALUES (:v1,:v2,:v3,:v4,:v5,:v6,:v7)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':v1', $name);
        $stmt->bindParam(':v2', $profile);
        $stmt->bindParam(':v3', $phone);
        $stmt->bindParam(':v4', $address);
        $stmt->bindParam(':v5', $email);
        $stmt->bindParam(':v6', $password);
        $stmt->bindParam(':v7', $status);
        $stmt->execute();

        $last_id = $conn->lastInsertId();
        
        $sql = "INSERT INTO model_has_roles (user_id,role_id) VALUES(:v1,:v2)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':v1', $last_id);
        $stmt->bindParam(':v2', $roleid);
        $stmt->execute();

        session_start();
        $_SESSION['reg_success'] = "Yes, it is not easy, but you did it! Please Signin Again.";

        header("location:login.php");
    }
?>