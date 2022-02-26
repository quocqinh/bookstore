<?php
	$book_order = $_GET['bookorder'];

	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "DELETE FROM orders WHERE orderid = '$book_order'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "delete data unsuccessfully " . mysqli_error($conn);
		exit;
	}
	header("Location: admin_customer.php");
?>