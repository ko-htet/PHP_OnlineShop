<?php
	require "db_connect.php";

	$id = $_GET['id'];

	$status = "Cancel";

	$sql = "UPDATE orders SET status = :v1 WHERE id = :v2";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':v1', $status);
	$stmt->bindParam(':v2', $id);
	$stmt->execute();

	header('location:orderlist.php');

?>