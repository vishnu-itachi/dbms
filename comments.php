<?php
session_start();
$user = $_SESSION["username"];

function loadComment($u,$c,$p)
{
    require_once('dbConnect.php');
    $sql = "SELECT * FROM Comment WHERE Customer_UserName = \"$u\" and productID = $p;";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res) == 0){
        $sql = "INSERT INTO Comment VALUES (\"$c\",$p,\"$u\");";
        $result = mysqli_query($conn,$sql);    
    }else{
        $sql = "UPDATE Comment SET Comment_text = \"$c\" WHERE Customer_UserName = \"$u\" and productID = $p;";
        $result = mysqli_query($conn,$sql);
    }
    header("Location: /item.php?id=$p");
    die();
}
if(isset($_POST["comment"]))
{
    echo "connected \n";
    $comment = $_POST["comment"]; 
    $pid = $_POST["pid"]; 
    loadComment($user,$comment,$pid);
    die();
} 

?>