<?php
session_start();

if (!isset($_SESSION["sid"])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit();
}

include("include/dbconnect.php");
 
if (isset($_GET['id'])) {
    $pid = $_GET['id'];
    $uid = $_SESSION["sid"];
    
    $qry = "DELETE FROM addtocart WHERE pid='$pid' AND uid='$uid'";
    
    if (mysqli_query($connect, $qry)) {
        echo json_encode(["success" => true, "message" => "Product deleted successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error deleting record: " . mysqli_error($connect)]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Product ID not provided"]);
}
?>





 