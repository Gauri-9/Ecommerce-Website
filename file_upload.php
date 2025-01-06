<?php
if(isset($_POST["upload_button"])){

$connect=mysqli_connect("localhost","root","","photodb");

$orgname=$_FILES["photo"]["name"];
$filename=$_FILES["photo"]["tmp_name"];
$filesize= $_FILES["photo"]["size"];
$filetype=$_FILES["photo"]["type"];
$fileinfo=explode(".",$orgname);
$fileext=strtolower($fileinfo[1]);
$allowtypes=array('jpg','jpeg','bpm','png');

$validext=in_array($fileext,$allowtypes);

if($validext){

	if($filesize>=100000 && $filesize<=500000){

		move_uploaded_file($filename,"user_images/".$orgname);
		
		$qry="INSERT INTO `user_photo`(`photo`, `created_at`) VALUES ('$orgname',now())";
		$result=mysqli_query($connect,$qry);
		if($result){
			echo "uploaded successfully";
		}
		else{
			echo "Something went wrong";
		}
	}
	else{
		echo "Invalid size";
	}

}
else{
	echo "Invalid Extension";
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" enctype="multipart/form-data">
		photo- <input type="file" name="photo"><br><br>
		<button type="submit" name="upload_button">Upload</button>
	</form>

</body>
</html>