<?php



?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Dropdown</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .product-item {
            display: none;
        }
        .container {
            margin-top: 20px;
        }
        .product-item {
            margin: 5px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
           
        }
        li a{
            color:black;
        }
        
    </style>
      <?php include("include/allheadercdn.php");?>

<link rel="stylesheet" href="../css/style.css">
</head>
<body>


<ul class="nav justify-content-end">
    <li class="nav-item">
        <a class="nav-link" href="index.php"><i class="bi bi-house"></i> Home</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"  data-toggle="dropdown" href="#">Products</a>
        <div class="dropdown-menu">
            <a href="#" class="dropdown-item">Books</a>
            <a href="#" class="dropdown-item">Educational Supplies</a>
            <a href="#" class="dropdown-item">Fashion</a>
            <a href="#" class="dropdown-item">Electronics</a>
            <a href="#" class="dropdown-item">Home & Kitchen</a>
            <a href="#" class="dropdown-item">Beauty & Personal Care</a>
            <a href="#" class="dropdown-item">Health & Wellness</a>
            <a href="#" class="dropdown-item">Groceries</a>
            <a href="#" class="dropdown-item">Baby & Kids</a>
            <a href="#" class="dropdown-item">Jewelry & Watches</a>
            <a href="#" class="dropdown-item">Art & Craft Supplies</a>
            <a href="#" class="dropdown-item">Musical Instruments</a>
            <a href="#" class="dropdown-item">Industrial & Scientific</a>
            <a href="#" class="dropdown-item" >Eco-friendly Products</a>
        </div>
    </li>

    <?php 
    if(isset($_SESSION["sid"]) || isset($_SESSION["admineid"])) {
        if(isset($_SESSION["sid"])) { ?>
            <li class="nav-item">
                <a class="nav-link" href="cart.php"><i class="bi bi-cart"></i> Cart</a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" href="user.php"><i class="bi bi-person"></i> Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
    <?php }
     else
     { ?>
        <li class="nav-item" id="registernavitem">
            <a class="nav-link" href="register.php">Register</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
        </li>
    <?php } ?>
</ul>

<!-- <div class="container">
    <div class="row">
        <div class="col-12 product-item" data-category="Books">Books Product 1</div>
        <div class="col-12 product-item" data-category="Books">Books Product 2</div>
        <div class="col-12 product-item" data-category="Educational Supplies">Educational Supplies Product 1</div>
        <div class="col-12 product-item" data-category="Fashion">Fashion Product 1</div>
        <div class="col-12 product-item" data-category="Electronics">Electronics Product 1</div>
        <!-- Add more product items as needed -->
    </div>
</div> -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('.dropdown-item').on('click', function(event) {
            event.preventDefault();
            var category = $(this).data('category');
            $('.product-item').hide();
            $('.product-item[data-category="' + category + '"]').fadeIn();
        });
    });
</script>

<?php include("include/allfooterlinks.php")?>
</body>
</html>
