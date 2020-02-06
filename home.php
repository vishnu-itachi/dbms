<!DOCTYPE html>
<html style="height: 100%">

<head>
	<title>Home</title>
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
	<link rel="stylesheet" type="text/css" href="/css/style.css">

    <style>
        /* body {
            background-image: linear-gradient(120deg, #d4fc79 50%, #66ffff 100%);
        } */
    </style>

<?php
// temp Edit:
session_start();
$user = $_SESSION["username"];

require_once('dbConnect.php');

?>

	<!-- Page links -->

	<!--  -->


</head>

<body style="height: 100%">
	<div>
		<nav class="nav-bar">
			<div class="container" style="height:inherit">
				<div class="row">
					<div class="col-1" style="height:inherit">
						<h3 style="height:inherit; line-height :inherit"> <a href="/home.php">Logo</a></h3>
					</div>
					<div class="col">
						<center class="w-100">
							<form class="form-inline" action="" method="GET">
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
						</center>

					</div>
					<div class="col-1  text-right"> <a href="userprofile.php">Profile</a> </div>
					<div class="col-1 text-right"> <a href="/cart">cart</a> </div>
					<div class="col-1 text-right"> <a href="/orderPage.php"> Orders </a> </div>
				</div>
			</div>
		</nav>
	</div>

	<div class="container-fluid search-section" style="height: 100%">
		<div class="row bg-success">
			<div class="col">
			<center class="w-100 ">
				<!-- {% for cat in catogaries %} -->
				<div class="row">
				<?php
				$sql = "SELECT tag FROM Product_tag GROUP BY tag;";
				$req = mysqli_query($conn,$sql);
				while($row = @$req->fetch_array()){
					$cat = $row["tag"];
					echo "<div class='col p-4 border-right category'><a href='/home.php?Search=$cat'>$cat</a></div>";
				}
				?>
				</div>
			</center>
			</div>
		</div>

		<div class="row" style="height: 100%">
			<div class="col">
				<div class="containter item-space mr-4 pr-4">
					<!-- {% for res in items %} -->
					<div class="row mr-4 pl-4 ml-4 pr-4">
						<?php 

						if(isset($_GET["Search"])){
							$search = $_GET["Search"];
							$query = "SELECT distinct * FROM Product as p1,Product_tag as p2 WHERE p1.productID = p2.productID and (ProductName LIKE '%$search%' or tag LIKE '%$search%') LIMIT 10;";
							$result = mysqli_query($conn,$query);
							//$result = $conn->query($query);
							while($row = @$result->fetch_array())
							{
									$id_l = $row["productID"];
									$img = $row["Image"];
									$name = $row["ProductName"];
									$price = $row["Price"];
									$quantity = $row["Product_Quantity"];
									// $seller = $row["seller"];
									$link = "\"/item.php?id=$id_l\"";
									echo "
									<div class='col-3'>
									<div class='card item-card m-2'  onclick='location.href=$link' style='max-width :20em;'>
											<img src='$img' class='card-img-top item-img' alt='...'>
											<div class='card-body'>
												<h5 class='card-title'> <span class='item-link'> $name </span> </h5>
												<p class=''> Rs. $price </p>
												<p class=''>Quantity:  $quantity </p>
											</div>
									</div></div>";
									}
						}
					?></div>
					<!-- {% endfor %} -->
				</div>

			</div>
		</div>

	</div>

</body>

</html>