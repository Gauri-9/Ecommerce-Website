<?php
session_start();
if(!isset($_SESSION["sid"])){
	header("location:login.php");
}

include("include/dbconnect.php");

$id=$_SESSION["sid"];

$qry="select * from user where id='$id'";
$result=mysqli_query($connect,$qry);
$data=mysqli_fetch_assoc($result);


$imagepath="user_images/".$data['photo'];

//change password
if(isset($_POST["update_password_button"])){
	$op = $_POST["op"];
	$np = $_POST["np"];
	$rp = $_POST["rp"];

	if($op==$data["password"])
	{		
		if($np==$rp)
		{
			if($np!=$data["password"])
			{

				$result = mysqli_query($connect,$qry);
				if($result)
				{
					?><script> alert("Password change Successfully");</script><?php
				}
				else
				$qry = "UPDATE `user` SET `password`='$np' WHERE id='$id'";
				{
					?><script> alert("Something went wrong");</script><?php
				}

			}
			else
			{
				?><script> alert("Password should not match with old password");</script><?php
			}
		}
		else
		{
			?><script> alert("Password do not match");</script><?php
		}
	}
	else
	{
		?><script> alert("Incorrect Old Password");</script><?php
	}
}



//edit profile

if(isset($_POST["edit_button"]))
{

$fn = $_POST["fullname"];
$eid = $_POST["email"];
$cn = $_POST["contact"];
$age = $_POST["age"];


$qry = "UPDATE `user` SET `fullname`='$fn',`email`='$eid',`contact`='$cn',`age`='$age' WHERE id='$id'";

$result = mysqli_query($connect,$qry);


if($result)
{
	?><script> alert("Update profile Successfully")</script><?php
}
else
{
	?><script> alert("Failed to update data")</script><?php

}




}


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/style.css">
 -->

 <style>

 	a{
 		color:black;
 	}
 </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar w/ text</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
    </ul>
    <span class="navbar-text">
      <a href="logout.php">Logout</a> (<?php echo $data["fullname"];?>)
    </span>
  </div>
</nav>

<div class="row">
	<div class="col-md-3">
		<ul class="list-group sidebar">
			<li class="list-group-item"><a href="#userprofile" data-toggle="tab">User Profile</a></li>
		
			<li class="list-group-item"><a href="#editprofile" data-toggle="tab">Edit Profile</a></li>
		
			<li class="list-group-item"><a href="#changepwd" data-toggle="tab">Change Password</a></li>
		
			<li class="list-group-item"><a href="#orderhistory" data-toggle="tab">Order History</a></li>
		
			<li class="list-group-item"><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	<div class="col-md-9">
		<div class="tab-content">
			<div class="tab-pane" id="userprofile">
				<?php include("userprofile.php");?>
			</div>

			<div class="tab-pane" id="editprofile"><h3>Edit Profile</h3>
				<?php include("editprofile.php");?>                           
			</div>

			<div class="tab-pane" id="changepwd">
				<?php include("changepwd.php");?>
			</div>


			<div class="tab-pane" id="orderhistory"><h3>Order History</h3>
				<?php include("orderhistory.php");?>

			</div>
		</div>
	</div>
</div>









<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script src="js/script.js"></script>

</body>
</html>