<?php





if(isset($_POST["register_button"]))
{

$connect=mysqli_connect("localhost","root","","sample");

$fn=$_POST["fullname"];
$eid=$_POST["email"];
$pwd=$_POST["password"];
$cn=$_POST["contact"];
$age=$_POST["age"];


$orgname=$_FILES["photo"]["name"];
$filename=$_FILES["photo"]["tmp_name"];
$filesize=$_FILES["photo"]["size"];
$filetype=$_FILES["photo"]["type"];

$fileinfo=explode(".",$orgname);
$fileext=strtolower($fileinfo[1]);
$allowtypes=array('jpg','jpeg','png','bpm');
$validext=in_array($fileext,$allowtypes);

if($validext){
    if($filesize>100000 && $filesize<500000)
    {
        move_uploaded_file($filename,"user_images/".$orgname);

        $qry = "INSERT INTO `user`(`fullname`, `email`, `password`, `contact`, `age`, `photo`) VALUES ('$fn','$eid','$pwd','$cn','$age','$orgname')";


         $result = mysqli_query($connect, $qry);

         if($result)
         {
            echo "Register Success";
         }
         else
         {
            echo "Something went wrong";
         }
        

    }
    else
    {
        echo "Invalid filesize";
    }
   
}
else
{
    echo "Invalid Extension";
}






 




}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container h-100">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Register</h2>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter full name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter contact number" required>
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" class="form-control" id="age" name="age" placeholder="Enter age" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Photo</label>
                                <input type="file" class="form-control" id="photo" name="photo" required>
                                
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" name="register_button">Register</button>
                            </div>
                            </form>
                            <p class="text-center mt-3">
                                Already have an account?<a href="login.php">Sign In</a>
                            </p>
                        <div id="message" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
