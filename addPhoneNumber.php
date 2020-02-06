<?php
session_start();
$user = $_SESSION["username"];
$type = $_SESSION["usertype"];
require_once("dbConnect.php");
$ph = $_POST["number"];
if($type=="seller")
{
$sql = "INSERT INTO Seller_Phone_Number values($ph,\"$user\");";
$res = mysqli_query($conn,$sql);
header("Location:./sellerpage.php");
}
else
{
    $sql = "INSERT INTO Customer_Phone_Number values($ph,\"$user\");";
    $res = mysqli_query($conn,$sql); 
    header("Location:./userprofile.php");
}
die();

?>
