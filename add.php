<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
$user = $_SESSION["username"];
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>ADD</title>
    <style type="text/css"></style>
</head>

<body>
    <br>
<form action="selleradd.php" method="POST" >

<div class="container">
<div>
  <div class="d-flex flex-row-reverse bd-highlight">
    <div class="p-2 bd-highlight">    
      <a href="logout.php">log out</a>
    </div>
  </div>
</div>

    <div class="well well-sm" style="margin: 3rem;">
        <h1 class="text-center">Add Products</h1>
    </div>
    <table class="table" border="1" >
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Tag</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
        </thead>

        <tbody id="table">
            <tr>
                <td>
                    <input type="text" class="form-control" id="task" name="pname" value="">
                </td>
                <td>
                    <input type="number" class="form-control" id="price" name="price" value="">
                </td>
                <td>
                    <select class="custom-select" multiple id="tag" name="type">
                        <!-- <option selected>Open this select menu</option> -->
                        <option value="Home appliances">Home appliances</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Auto mobiles">Auto mobiles</option>
                        <option value="Fashion">Fashion</option>
                        <option value="Sports">Sports</option>
                      </select
                </td>
                <td>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="">
                </td>
                <td>
                    <input type="text" class="form-control" id="des"  name="des" value="">
                </td>
                <td>
                    <input type="file" class="form-control" id="img"  name="img" >
                </td>
                <!-- <td>
                    <button type="button" id="add-button" class="btn btn-success">Add</button>
                </td> -->
            </tr>
        </tbody>
    </table>
    
</div>
<div class="container">
    <div style="text-align: center;">
    <button type="Submit" class="btn btn-outline-success mx-auto" >Submit</button>
    </div>
</div>
</form>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
        <script type="text/javascript">
          $(document).ready(function() {
    $("#add-button").click(function() {
        if ($("#task").val().trim() != '') {
            
            $("#table").prepend("<tr><td>" + $("#task").val() + "</td><td>" + $("#price").val() + "</td><td>"+ $("#tag").val() +"</td><td>"+ $("#quantity").val() +"</td><td>"+ $("#des").val() +"</td><td>" + "<button type='button' id='remove-button' class='btn btn-danger'>Remove</button></td></tr>");
            $('#task').val('');
            $('#price').val(null);
            $('#tag').val(null);
            $('#quantity').val(null);
            $('#des').val(null);

        } else {
            
            alert("WOW you just added NOTHING to your list");
            
        }
    });

    $(document).on('click', '#remove-button', function() {
        $(this).parent().parent().remove();
    });
    
});
        </script>
</body>
</html>