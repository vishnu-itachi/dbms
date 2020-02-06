<?php

session_start();
require_once("dbConnect.php");
$user = $_SESSION["username"];
$type = $_SESSION["usertype"];
//$user = "Rajesh";
$road =$_POST["road"];
$city =$_POST["city"];
$state = $_POST["state"];
$pin = $_POST["pincode"];
$pw = $_POST["password"];

//echo $road;
if($type=="seller")
{
$query = "update Seller set Password = \"$pw\" ,Road = \"$road\",Pincode = $pin ,State = \"$state\" , City = \"$city\" where Seller_UserName = \"$user\" ;";
$result = mysqli_query($conn,$query);
header("Location: ./sellerpage.php");
}
else
{
$query = "update Customer set Password = \"$pw\" ,Road = \"$road\",Pincode = $pin ,State = \"$state\" , City = \"$city\" where Customer_UserName = \"$user\" ;";
$result = mysqli_query($conn,$query);
header("Location: ./userprofile.php");   
}
die();
