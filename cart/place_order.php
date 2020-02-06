<?php
	// Connect to database.
	require_once("../connect.php");
	// Start session.
	session_start();
	$username = $_SESSION["username"];
	// Get OrderId of cart.
	$query = "SELECT OrderID FROM Orders WHERE Customer_UserName=\"$username\" AND Placed=0;";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$cartid = $row["OrderID"];
	// Get products of order.
	$query2 = "SELECT * FROM Order_product WHERE Customer_Username=\"$username\" AND OrderID=$cartid;";
	$result2 = mysqli_query($conn, $query2);
	if (mysqli_num_rows($result2) != 0) {
		// Create new order for customer.
		$date = Date("Y-m-d");
		$neworder = "INSERT INTO Orders (Placed, Date, Customer_UserName) VALUES (1, \"$date\", \"$username\");";
		$tmp = mysqli_query($conn, $neworder);
		// Get OrderID.
		$getID = "SELECT MAX(OrderID) as id FROM Orders WHERE Customer_UserName = \"$username\";";
		$res = mysqli_query($conn, $getID);
		$r = $res->fetch_array();
		$orderid = $r["id"];
	}
	while ($row2 = mysqli_fetch_assoc($result2)) {
		$OQ = $row2["Order_Quantity"];
		$productid = $row2["productID"];
		// Check if the item is available.
		$checkquery = "SELECT Product_Quantity FROM Product WHERE productID=$productid;";
		//echo $checkquery;
		$result4 = mysqli_query($conn, $checkquery);
		$row4 = mysqli_fetch_assoc($result4);
		// echo $row4["Product_Quantity"];
		// echo "<br>";
		// echo $OQ;
		// echo "<br>";
		// if ($row4["Product_Quantity"] >= $OQ) {
		// }
		if ($row4["Product_Quantity"] >= $OQ) {
			// echo $row4["Product_Quantity"];
			// echo "<br>";
			// echo $OQ;
			// echo "<br>";	// If the item is available.
			// Put products into order.
			$query3 = "INSERT INTO Order_product (Order_Quantity, productID, OrderID, Customer_UserName) VALUES ($OQ, $productid, $orderid, \"$username\");";
			$tmp = mysqli_query($conn, $query3);
			// Remove products from cart.
			$query3 = "DELETE FROM Order_product WHERE productID=$productid AND OrderID=$cartid AND Customer_UserName=\"$username\";";
			$tmp = mysqli_query($conn, $query3);
			// Remove the items from Products.
			$updateProducts = "UPDATE Product SET Product_Quantity=".$row4["Product_Quantity"]."-$OQ WHERE ProductId=$productid;";
			$tmp = mysqli_query($conn, $updateProducts);
		}
	}

?>
<p>Order Placed</p>
<a href="../home.php">go to homepage</a>
<br>
<a href="/cart">go to cart</a>