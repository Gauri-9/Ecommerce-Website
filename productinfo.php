<?php
session_start();  

include("include/dbconnect.php");	
if(isset($_POST["addtocart_button"])){
   $id = $_SESSION["sid"];
   $pid = $_POST["pid"];
   $price = $_POST["price"];

   $qry = "INSERT INTO `addtocart`(`addtocart_id`, `uid`, `pid`, `totalprice`, `uploaded_at`, `modified_at`) VALUES (NULL,'$id','$pid','$price',now(),now())";
   $result = mysqli_query($connect,$qry);
   if($result){
    ?><script>alert("Product added to cart")</script><?php
   }
   else
   {
    ?><script>alert("Something went wrong")</script><?php

   }
}
    $pid = isset($_GET["pid"]) ? $_GET["pid"] : die("Product ID is missing.");
    $qry = "SELECT * FROM products WHERE pid = '$pid'";
    $result = mysqli_query($connect, $qry);
    $data = mysqli_fetch_assoc($result);
    $imagepath= "images/".$data['productcategory']."/".$data['productimage'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information Page</title>
    <?php include("include/allheadercdn.php");?>
	<link rel="stylesheet" href="css/style.css">
    <style>
           .btn-container {
            display: flex;
            justify-content: flex-start;
            
            gap: 10px;
            
        }
        #add-to-cart{
            margin-top: 45px;
        }
        #quantity{
            transform: translateX(4px);
        }
        #buy-now{
         margin-top: 8px;   
        }
        a{
        color:black;
        }
        
    </style>
    <?php include("include/homeheader.php");?>

</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6">
                <img src="<?php echo $imagepath?>" class="img-fluid" alt="Product Image">
            </div>
            
            <!-- Product Details -->
            <div class="col-md-6">
                <h1 id="product-name"><?php echo $data['productname']?></h1>
                <h3 id="product-price"><?php echo $data['productprice']?></h3>
                <p id="product-description"><?php echo $data['productdescription']?></p>
                
                    
                     <div class="btn-container">
                        
                        <form action="checkout.php" method="post">
                            <input type="hidden" class="form-control d-inline -block" id="price" name="price" value="<?php echo $data['productprice'];?>">
                            <input type="hidden" class="form-control d-inline -block" id="pid" name="pid" value="<?php echo $data['pid'];?>">

                            <div class="quantity">                    
                            <input type="number" id="quantity" name="quantity"  class="form-control d-inline-block" min="1" max="10" style="width: 60px; " value="1">
                            </div>
                            <button id="buy-now" class="btn btn-danger" type="submit">Buy Now</button>
                        </form>
                        <form method="post">
                             <input type="hidden" class="form-control d-inline -block" id="price" name="price" value="<?php echo $data['productprice'];?>">
                            <input type="hidden" class="form-control d-inline -block" id="pid" name="pid" value="<?php echo $data['pid'];?>">
                            <button id="add-to-cart" class="btn btn-success" name="addtocart_button">Add to Cart</button>
                        </form>
                    </div>    
                        <p id="stock-quantity" class="mt-3"><span>Stock Available: <?php echo $data['available']?></span></p>
                </div>
                 
        </div>

        <!-- Reviews Section -->
        <div class="row mt-5">
            <div class="col-12">
                <h2>Reviews</h2>
                <div id="reviews">
                    <div class="review mb-3">
                        <strong>John Doe:</strong> <span>★★★★☆</span>
                        <p>Great product! Highly recommend.</p>
                    </div>
                    <div class="review mb-3">
                        <strong>Jane Smith:</strong> <span>★★★☆☆</span>
                        <p>Good value for money, but the delivery was delayed.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include("include/allfooterlinks.php");?>
    

     <!-- <script>
        $(document).ready(function() {
            $('#buy-now-form').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'checkout.php',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert('Purchase successful');
                            $('#available-stock').text(response.new_stock);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert('Something went wrong');
                    }
                });
            });
        });
    </script> -->
</body>
</html>
