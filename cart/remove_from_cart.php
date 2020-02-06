<?php
	// Connect to database.
	require_once("../connect.php");
	// Start session.
	session_start();
	// Get value from POST.
	$product_id = $_POST["productID"];
	// Get OrderId of cart.
	$query = "SELECT OrderID FROM Orders WHERE Customer_UserName=\"".$_SESSION["username"]."\" AND Placed=0;";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	// Remove the Item from cart.
	$query2 = "DELETE FROM Order_product WHERE Customer_UserName=\"".$_SESSION["username"]."\" AND OrderID=".$row["OrderID"]." AND productID=$product_id;";
	$result2 = mysqli_query($conn, $query2);
	// Head to cart.
	header("Location: /cart");
?>