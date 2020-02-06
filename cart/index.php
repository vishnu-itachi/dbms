<?php
	require_once("../connect.php");
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
		crossorigin="anonymous" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
	</script>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/item.css">
	<title>Cart</title>
</head>

<body>
			<div>
					<nav class="nav-bar">
						<div class="container" style="height:inherit">
							<div class="row">
								<div class="col-1" style="height:inherit">
									<h3 style="height:inherit; line-height :inherit"> <a href="/home.php">Logo</a></h3>
								</div>
								<div class="col">
										<form class="form-inline" action="/home.php" method="GET" style="height:100%;">
											<div class="col-9">
												<div>
													<input type="text" class=" w-100 rounded search-box" id="search" name="Search"
														placeholder="search">
												</div>
											</div>
											<div class="col">
												<button type="submit"
													class="btn btn-primary w-100 rounded search-button">Search</button>
											</div>
										</form>
			
								</div>
								<div class="col-1  text-right"> <a href="/logout.php">logout</a> </div>
								<div class="col-1 text-right"> <a href="userprofile.php">profile</a> </div>
								<div class="col-1 text-right"> <a href="/orderPage.php">Orders</a> </div>
							</div>
						</div>
					</nav>
				</div>
			

<br />
	<div class="container search-section">
		<div class="well well-sm" style="margin: 3rem;">
			<h1 class="text-center">Cart</h1>
		</div>

		<table class="table" name="items">
			<thead>
				<tr>
					<th>Item</th>
					<th>Price</th>
					<th>Quatitiy</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody id="table">
				<?php
				$query = "SELECT OrderID FROM Orders WHERE Customer_UserName=\"".$_SESSION["username"]."\" AND Placed=0;";
				$result = mysqli_query($conn, $query);
				$totalprice = 0;
				if (mysqli_num_rows($result) == 1) {
					// If cart exists.
					$row = mysqli_fetch_assoc($result);
					// Get productIDs of products.
					$query2 = "SELECT productID, Order_quantity from Order_product WHERE Customer_UserName=\"".$_SESSION["username"]."\" AND OrderID=".$row["OrderID"].";";
					$result2 = mysqli_query($conn, $query2);
					$i = 0;
					while ($row2 = mysqli_fetch_assoc($result2)) {
						// Get ProductName, Price of products.
						$query3 = "SELECT ProductName, Price from Product WHERE productID=".$row2["productID"].";";
						$result3 = mysqli_query($conn, $query3);
						$row3 = mysqli_fetch_assoc($result3);
						echo "
						<tr>
							<td>".$row3["ProductName"]."</td>
							<td>".$row3["Price"]."</td>
							<td>".$row2["Order_quantity"]."</td>
							<td><button type=\"button\" id=\"remove-button\" onclick=removeel(".$row2["productID"].") class=\"btn btn-danger\">remove</button></td>
						</tr>
						";
						$totalprice += $row3["Price"] * $row2["Order_quantity"];
					}
				}

				?>
			</tbody>
		</table>
	</div>
	<div class="container">
		<form>
			<div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">Total Price</label>
				<div class="col-sm-10">
					<?php
					echo "<input type=\"text\" readonly class=\"form-control-plaintext\" id=\"staticprice\" value=\"$totalprice\" />";
					?>
				</div>
				<button type="button" class="btn btn-outline-success mx-auto"
					onclick=place_order()>Place Order</button>
			</div>
		</form>
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
		integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
		crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous"></script>
	<script type="text/javascript">
	function removeel(x) {
		post('./remove_from_cart.php', {
			productID: x
		});
	}

	function place_order() {
		post('./place_order.php', {});
	}

	function post(path, params, method) {
		method = method || "POST"; // Set method to post by default if not specified.

		// The rest of this code assumes you are not using a library.
		// It can be made less wordy if you use one.
		var form = document.createElement("form");
		form.setAttribute("method", method);
		form.setAttribute("action", path);

		for (var key in params) {
			if (params.hasOwnProperty(key)) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", key);
				hiddenField.setAttribute("value", params[key]);

				form.appendChild(hiddenField);
			}
		}

		document.body.appendChild(form);
		form.submit();
	}
	</script>
</body>

</html>