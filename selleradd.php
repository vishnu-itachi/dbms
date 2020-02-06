<?php
session_start();
$user = $_SESSION["username"];
require_once('dbConnect.php');
//$user = "Rajesh";
$pname = $_POST["pname"];
$price = $_POST["price"];
$type = $_POST["type"];
$quantity = $_POST["quantity"];
$des = $_POST["des"];
$img = $_POST["img"];

$file = "img/".$img;
$query = "insert into Product values(\"$pname\",\"$des\",$price,NULL,$quantity,\"$file\");";
$res = mysqli_query($conn,$query);

$getID = "SELECT MAX(productID) as id FROM Product";
$res = mysqli_query($conn,$getID);

$r = $res->fetch_array();
$id = $r["id"];

$query = "insert into Product_tag values(\"$type\",$id);";
$res = mysqli_query($conn,$query);

$query = "insert into Seller_sells values(\"$user\",$id);";
$res = mysqli_query($conn,$query);
header("Location: /sellerpage.php");
die();
?>