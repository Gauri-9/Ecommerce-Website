<?php

session_start();

if(isset($_SESSION["sid"]))
{
    header("location:user.php");

}
else if(isset($_SESSION["admineid"]))
{
  header("location:admin/admindashboard.php");   
}


if(isset($_POST["login_button"]))
{

$connect=mysqli_connect("localhost","root","","sample");

$eid = $_POST["email"];
$pwd = $_POST["password"];


$qry="select * from user where email='$eid 'AND password='$pwd'";
if($eid=="admin@gmail.com" && $pwd=="admin")
{
    $_SESSION["admineid"]='$eid';
    header("location:admin/admindashboard.php");
}
else
{
    $result=mysqli_query($connect,$qry);

    $row=mysqli_num_rows($result);

     $data=mysqli_fetch_assoc($result);
     

    

    if($row>0)
    {
        $id = $data["id"];
        $_SESSION["sid"]=$id;
        header("location:user.php");
    }
    else
    {
        echo "Invalid email or password";    
    }
}

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>

        .card{
            margin-top:100px;
        }
    </style>
</head>
<body>
    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Login</h2>
                        <form id="loginForm" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" name="login_button">Login</button>
                            </div>
                        </form>
                        <p class="text-center mt-3">
                            Don't have an account? <a href="register.php">Register</a>
                        </p>
                        <div id="message" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
