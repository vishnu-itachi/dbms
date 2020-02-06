<html>
    <head>
        <title>
            Online Shoping
        </title>
    </head>
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
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/item.css">
    <link rel="stylesheet" href="css/style.css">
    <?php require_once('dbConnect.php'); 
        session_start();
        $user = $_SESSION["username"];
    ?>

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
					<div class="col-1  text-right"> <a href="logout.php">logout</a> </div>
					<div class="col-1 text-right"> <a href="/cart">cart</a> </div>
					<div class="col-1 text-right"> <a href="/orderPage.php">Orders</a> </div>
				</div>
			</div>
		</nav>
    </div>


    <div class="container item-page">
        <br>
        <?php
            $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $parts = parse_url($url,PHP_URL_QUERY);
            parse_str($parts, $query);
            $pid = $query["id"];
            $sql = "SELECT * FROM Product WHERE productID = $pid;";
            $result = mysqli_query($conn,$sql);
            $item = @$result->fetch_array();
            $name = $item["ProductName"];
            $price = $item["Price"];
            $quantity = $item["Product_Quantity"];
            $des = $item["Decription"]; 
            $img = $item["Image"];
        ?>
            <div class="row mb-4">
            <?php
                echo "
                <div class='col-4'>
                    <img src='$img' alt='...' class='item-img2'>
                </div>
                <div class='col'>
                    <div>
                        <h3> $name </h3>
                        <h5> $price </h5>
                        <p> Quantity Available : $quantity </p>
                        <hr>
                        <p>
                            $des
                        </p>
                        <hr>
                ";
                if($quantity>0){
                    echo "
						<form action='order.php' method='POST'>
							<div>
                            <br>
                                <label for='item-quantity'>Quantity</label>
                                <input type='number' id='item-quantity' name='item-quantity' class='quantity-box' value='1' max = '$quantity' min = '1' name='quantity'>
                                <input type='text' value='$pid ' hidden name='pid' hidden>
                                <input type='text' name='userID' hidden value ='$user'>
                                <br>
								<br>
								<button class='submit-button btn btn-success' name='order' type='submit' value='buy' > BUY </button>
								<button class='submit-button btn btn-warning' name='order' type='submit' value='cart' > Add to cart </button>
							</div>
                        </form>";
                    }else{
                        echo " <br> <h3> Out of Stock </h3>";
                    }
                echo "
                    </div>
                </div>";
                ?>
            </div>

            <div class="row">
                <div class="col">
                    <div>
                        <h3>Comments</h3>
                        <hr>
                        <div>
                            <form method="POST" action="/comments.php" >
                                <input type='text' name='userID' hidden value ="<?php $user?>">
                                <input type="text" value='<?php echo $pid ?>' hidden name='pid'>
                                <input type='text' class="comment-box" name="comment" autocomplete="off" >
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                        <ul>
                            <br>
                            <br>
                        <?php
                            $sql = "SELECT * FROM Comment WHERE productID = $pid";
                            $result = mysqli_query($conn,$sql);
                            while($row = @$result->fetch_array()){
                                $cmt = $row["Comment_text"];
                                $user = $row["Customer_UserName"];
                                echo "<p>";
                                echo "<b class='pr-4'> $user:  </b>";
                                echo "<i> $cmt </i>";
                                echo "</p>";

                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>