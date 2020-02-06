<?php
	// Connect to database.
	require_once("../connect.php");
	// Get the details.
	$username = $_POST["Username"];
	$password = $_POST["Password"];
	$usertype = $_POST["usertype"];
	// Check if the details are correct.
	if ($usertype == "customer") {
		$check_user_query = "SELECT * FROM Customer WHERE Customer_UserName=\"$username\" AND Password=\"$password\";";
	}
	if ($usertype == "seller") {
		$check_user_query = "SELECT * FROM Seller WHERE Seller_UserName=\"$username\" AND Password=\"$password\";";
	}
	$result = mysqli_query($conn, $check_user_query);
	$count = mysqli_num_rows($result);
	if ($count == 1) {
		// User exists.
		// Start Session.
		session_start();
		// Set session variables.
		$_SESSION["username"] = $username;
		$_SESSION["usertype"] = $usertype;
		// Set cookies.
		setcookie("username", $username, time() + (86400 * 30), "/");
		setcookie("usertype", $usertype, time() + (86400 * 30), "/");
		// Redirect page.
		if ($usertype == "seller")
			header("location: ../sellerpage.php");
		else
			header("location: ../home.php");
		die();
	}
?>

<p>Incorrect Details</p>
<a href="/signin">go to signin</a>