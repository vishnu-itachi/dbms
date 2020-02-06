<?php
session_start();
$user = $_SESSION["username"];

require_once("dbConnect.php");

echo "starting";

if(isset($_POST["item-quantity"])){
    $date = date("Y-m-d");
    $ui = $user;
    if($_POST["order"] == "buy"){
        echo "order\n";
        $sql = "INSERT INTO Orders (Placed, OrderID, Date, Customer_UserName) VALUES ('1', NULL, \"$date\",\"$ui\");";
        $res = mysqli_query($conn,$sql);

        $getID = "SELECT MAX(OrderID) as id FROM Orders WHERE Customer_UserName = \"$ui\";";
        $res = mysqli_query($conn,$getID);
    
        $r = $res->fetch_array();
        $id = $r["id"];
        $pid = $_POST["pid"];
        $q = $_POST["item-quantity"];
        $sql = "INSERT INTO Order_product (`Order_Quantity`, `productID`, `OrderID`, `Customer_UserName`) VALUES ($q,$pid,$id,\"$ui\");";        
        $res = mysqli_query($conn,$sql);    

        $sql = "UPDATE Product SET Product_Quantity = Product_Quantity - $q WHERE productID = $pid;";
        $res = mysqli_query($conn,$sql);    

    }else{
        echo "cart";
        $getID = "SELECT MAX(OrderID) as id FROM Orders WHERE Placed = 0 and Customer_UserName = \"$ui\";";
        $res = mysqli_query($conn,$getID);
    
        $r = $res->fetch_array();
        $id = $r["id"];
        $pid = $_POST["pid"];
        $q = $_POST["item-quantity"];
        $sql = "INSERT INTO Order_product (`Order_Quantity`, `productID`, `OrderID`, `Customer_UserName`) VALUES ($q,$pid,$id,\"$ui\");";
        $res = mysqli_query($conn,$sql);    
    }

    header("Location: /home.php");
    die();
}
echo "ending";
?>