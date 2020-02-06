<?php
	// Connect to database.
	require_once("../connect.php");
	// Get the details.
	$first_name = $_POST["first_name"];
	$last_name = $_POST["last_name"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$email = $_POST["email"];
	$address = $_POST["address"];
	$state = $_POST["state"];
	$city = $_POST["city"];
	$zip = $_POST["zip"];
	$usertype = $_POST["usertype"];
	// Get phone numbers.
	$number = array();
	set_error_handler('error_handler');
	function error_handler($severity, $message, $filename, $lineno) {
		if (error_reporting() == 0) {
			return;
		}
		if (error_reporting() & $severity) {
			throw new ErrorException($message, 0, $severity, $filename, $lineno);
		}
	}

	for ($tmp = 0;; $tmp++) {
		try {
			$tmp2 = "number".$tmp;
			array_push($number, $_POST[$tmp2]);
		} catch (Exception $e) {
			break;
		}
	}

	// Table name.
	if ($usertype == "customer") {
		$table = "Customer";
		$column = "Customer_UserName";
	} else {
		$table = "Seller";
		$column = "Seller_UserName";
	}
	// Check if user exists.
	$query = "SELECT * FROM $table WHERE $column=\"$username\";";
	$result = mysqli_query($conn, $query);
	$count = mysqli_num_rows($result);
	if ($count == 0) {
		// New user.
		echo "New user";
		// Insert into table.
		$name = $first_name." ".$last_name;
		if ($table == "Customer") {
			$query = "INSERT INTO $table VALUES (\"$username\", \"$password\", \"$name\", $zip, \"$address\", \"$city\", \"$state\");";
		} else {
			$query = "INSERT INTO $table VALUES (\"$username\", \"$password\", \"$name\", $zip, \"$address\", \"$city\", \"$state\", 0);";
		}
		$result = mysqli_query($conn, $query);
		// Insert the Phone numbers.
		// Table name.
		if ($usertype == "customer") {
			$table = "Customer_Phone_Number";
		} else {
			$table = "Seller_Phone_Number";
		}
		for ($i = 0; $i < sizeof($number); $i++) {
			// Insert into table.
			$insertquery = "INSERT INTO $table VALUES($number[$i], \"$username\");";
			$insertresult = mysqli_query($conn, $insertquery);
		}
		if ($usertype == "customer") {
			// Set cart in order table.
			$date = Date("Y-m-d");
			$newcart = "INSERT INTO Orders (Placed, Date, Customer_UserName) VALUES (0, \"$date\", \"$username\");";
			$tmp = mysqli_query($conn, $newcart);
		}
		// Redirect page.
		header("location: /signin");
		die();
	} else {
		// User exists.
		echo "User Already Exists";
		die();
	}

?>