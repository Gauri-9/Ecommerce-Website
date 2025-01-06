<?php

session_start();
if(isset($_SESSION["sid"])){
	unset($_SESSION["sid"]);
}
if(isset($_SESSION["admineid"])){
	unset($_SESSION["admineid"]);
}
header("location:index.php");


?>