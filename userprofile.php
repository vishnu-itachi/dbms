<!doctype html>
<html lang="en">
<?php
session_start();
$user = $_SESSION["username"];
//$user = "Rajesh";
require_once("dbConnect.php");
$query ="select * from Customer where Customer_UserName = \"$user\";";
$result = mysqli_query($conn,$query);
$row = $result->fetch_array();
$password = $row["Password"];
$road = $row["Road"];
$city = $row["City"];
$state = $row["State"];
$pincode = $row["Pincode"];
?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Profile</title>

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
						<center class="w-100">
							<form class="form-inline" action="/home.php" method="GET">
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
					<div class="col-1  text-right"> <a href="logout.php">logout</a> </div>
					<div class="col-1 text-right"> <a href="/cart">cart</a> </div>
					<div class="col-1 text-right"> <a href="/orderPage.php"> Orders </a> </div>
				</div>
			</div>
		</nav>
	</div>

<div class="container">

<div>
  <div class="d-flex flex-row-reverse bd-highlight">
    <div class="p-2 bd-highlight">    
      <a href="logout.php">log out</a>
    </div>
  </div>
</div>

  <br><br><br>
  <h2 style="text-align: center;">Your Profile</h2>
  <br><br><br>
    <div class="row">
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Home</a>
      <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Address</a>
      <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Phone Numbers</a>
      <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Settings</a>
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
        <br>
        <h2>Name: <span id="name"><?php echo $row["Name"] ?></span></h2>
        <br><br>
      </div>
      <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
        <br>
        <h3 id="address1">
        <?php echo "Road".$row["Road"] ?>
        </h3>
        <h3 id="city">
        <?php echo "City".$row["City"] ?>
        </h3>
        <h3 id="state">
        <?php echo "State".$row["State"] ?>
        </h3>
        <h3 id="pin">
        <?php echo "Pincode".$row["Pincode"] ?>
        </h3>
      </div>
      <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
            <div>

        <table class="table">
            <thead>
                <th>Phone Numbers</th>
            </thead>
            <tbody id="list">
              <?php
                $sql = "SELECT * FROM Customer_Phone_Number WHERE Customer_UserName = \"$user\";";
                $res = mysqli_query($conn,$sql);
                while( $row = $res->fetch_array()){
                    $num = $row["Phone_Number"];
                    echo "<tr><td>$num<td></tr>";
                }
              ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-outline-primary" aria-label="Add" data-toggle="modal"
            data-target="#formModal">
            Add number
        </button>

        <!-- Modal -->
        <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="addPhoneNumber.php" method="POST">
                      <div class="modal-body">
                          <input type="text" value="<?php echo $user; ?>" hidden>
                          <div class="form-group">
                              <label>Number</label>
                              <input type="number" name="number" id="price" class="form-control" />
                          </div>

                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button class="btn btn-success" type="submit">
                              Add
                          </button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

      </div>
      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
        <br><br>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">  Edit Details</button>

<div>
    

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form action="sellerupdate.php" method="POST">

           <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <input type="password" class="form-control" id="password" name="password"  placeholder="password" value="<?php echo $password; ?>">
            </div>


           <div class="form-group">
                <label for="inputAddressLine2" class="col-sm-2 control-label">Road</label>

                <input type="text" class="form-control" id="inputAddressLine1" name="road"  placeholder="Address Line 1" value="<?php echo $road; ?>">
            </div>

            <div class="form-group">
                <label for="inputCityTown" class="col-sm-2 control-label">City</label>

                <input type="text" class="form-control" id="inputCityTown" name="city" placeholder="City/Town" value="<?php echo $city; ?>">

            </div>

            <div class="form-group">
                <label for="inputStateProvinceRegion" class="col-sm-2 control-label">State</label>

                <input type="text" class="form-control" id="inputStateProvinceRegion" name="state"
                    placeholder="State" value="<?php echo $state; ?>">

            </div>

            <div class="form-group">
                <label for="inputZipPostalCode" class="col-sm-2 control-label">Postal Code</label>
                <input type="text" class="form-control" id="inputpin" name="pincode" placeholder="PIN" value="<?php echo $pincode; ?>">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" >Save changes</button>
            </div>

        </form>
      </div>
    </div>
  </div>
</div>


      </div>
    </div>
  </div>
</div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
          function add() {

        var price = $('#price').val();

        var newLine = '<tr>' +
            '<td>' + price + '</td>' +
            '</td>' +
            '</tr>';

        $('#list').append(newLine);
        $('#formModal').modal('hide');
    }
    function details(){
      var name = $('#Input1').val();
      var age = $('#Input2').val();
      var add1 = $('#inputAddressLine1').val();
      var city = $('#inputCityTown').val();
      var state = $('#inputStateProvinceRegion').val();
      var pin = $('#inputpin').val();

      $('#name').html(name);
      $('#age').html(age);
      $('#address1').html(add1);
      $('#city').html(city);
      $('#state').html(state);
      $('#pin').html(pin);

      $('#exampleModal').modal('hide');
    }
    </script>
  </body>
</html>