<html>
    <head>
        <title>
            Orders
        </title>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'
		integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
        <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'
            integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'>
        </script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'
            integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'>
        </script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'
            integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'>
        </script>
        <link rel='stylesheet' type='text/css' href='css/style.css'>

<?php
// Edit:
require_once("dbConnect.php");
session_start();
$user = $_SESSION["username"];

?>

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
					<div class="col-1  text-right"> <a href="userprofile.php">Profile</a> </div>
					<div class="col-1 text-right"> <a href="/cart">cart</a> </div>
					<div class="col-1 text-right"> <a href="/logout.php">logout</a> </div>
				</div>
			</div>
		</nav>
	</div>

        <div class='container search-section'>
            <?php
                $sql = "SELECT * FROM Orders WHERE Customer_UserName = \"$user\" and Placed = 1;";
                $res = mysqli_query($conn,$sql);
                while($row = $res->fetch_array()){
                    $id = $row["OrderID"];
                    $date = $row["Date"];
                    echo "
                        <div class='row p-4 m-4 rounded' style='box-shadow: 0px 0px 15px -5px #000;'>
                            <div class='col'>
                                <h3>$id</h3>
                                <h5>$date</h5>      
                                <hr>";
                        $sql = "SELECT * FROM Order_product INNER JOIN Product ON Product.productID = Order_product.productID WHERE OrderID = \"$id\"";
                        $res2 = mysqli_query($conn,$sql);
                        while($row2 = $res2->fetch_array()){
                            $pname = $row2["ProductName"];
                            $pid = $row2["productID"];
                            $q = $row2["Order_Quantity"];
                            $p = $row2["Price"]*$q;
                            echo "  <div class='row'>
                                        <div class='col'>
                                            <a href='item.php?id=$pid'> $pname </a>
                                        </div>
                                        <div class='col'>
                                            Quantity: $q
                                        </div>
                                        <div class='col'>
                                            Amount: $p
                                        </div>
                                    </div>";
                                    
                            }
                        echo "
                            </div>
                        </div>";
                }
            ?>
        </div>
    </body>
</html>