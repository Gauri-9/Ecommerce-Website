<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
$quantity = $_POST["quantity"];
$price = $_POST["price"];
$pid = $_POST["pid"];

$totalprice = $quantity*$price;
}
session_start();
if(!isset($_SESSION["sid"])){
	header("location:login.php");
	exit;
}

$id = $_SESSION["sid"];
include("include/dbconnect.php");
$qry = "SELECT * FROM user WHERE id ='$id'";
$result = mysqli_query($connect,$qry);
$data = mysqli_fetch_assoc($result);

if(isset($_POST["final_checkout_button"])){
	$address = $_POST["address"];
	$cardnumber = $_POST["cardnumber"];
	$qry = "INSERT INTO `orders`(`oid`, `uid`, `pid`, `quantity`, `totalprice`, `debitcard`, `address`,`uploaded_at`) VALUES (NULL,'$id','$pid',
	'$quantity','$totalprice','$cardnumber','$address',now())";
    $result = mysqli_query($connect,$qry);
    if($result){
        ?><script>alert("Product purchased successfully")</script><?php
    }
    else{
        ?><script>alert("Something went wrong")</script><?php           
    }
   
	

}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <?php include("include/allheadercdn.php");?>

    
</head>
<body id="checkout">
    <div class="container" id="containercheckout">
        <h2 class="text-center">Checkout</h2>
        <form id="checkoutForm" method="post">
        	<div class="form-group">
                <input type="hidden" class="form-control"  name="pid" value="<?php echo $pid;?>" readonly>
            </div>
            
            <div class="form-group">
                <label for="address">Delivery Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" readonly value="<?php echo $price;?>">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" readonly value="<?php echo $quantity;?>">
            </div>
            <div class="form-group">
                <label for="totalPrice">Total Price</label>
                <input type="number" class="form-control" id="totalPrice" name="totalPrice" readonly value="<?php echo $totalprice;?>">
            </div>
            <div class="form-group">
                <label for="cardNumber">Debit Card Number</label>
                <input type="text" class="form-control" id="cardnumber" name="cardnumber" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control" id="cvv" name="cvv" required>
            </div>
            <div class="form-group">
                <label for="expiryDate">Expiry Date</label>
                <input type="text" class="form-control" id="expirydate" name="expirydate" placeholder="MM/YY" required>
            </div>
            <button type="submit" class="btn btn-primary" name="final_checkout_button">Submit</button>
        </form>
    </div>
    <?php include("include/allfooterlinks.php");?>

    <script>  
    
    $(document).ready(function() {
    // Update total price based on price and quantity
    $('#price, #quantity').on('input', function () {
        var price = parseFloat($('#price').val()) || 0;
        var quantity = parseFloat($('#quantity').val()) || 0;
        $('#totalPrice').val(price * quantity);
    });

    // Validate form on submit
    $('#checkoutForm').on('submit', function (e) {
        
        var isValid = true;

        // Clear previous alerts
        $('.form-control').removeClass('is-invalid');
        $('.form-control').siblings('.invalid-feedback').remove();

        // Full Name validation
        if ($('#fullName').val().trim() === '') {
            isValid = false;
            $('#fullName').addClass('is-invalid').after('<div class="invalid-feedback">Full Name is required.</div>');
        }

        // Address validation
        if ($('#address').val().trim() === '') {
            isValid = false;
            $('#address').addClass('is-invalid').after('<div class="invalid-feedback">Address is required.</div>');
        }

        // Email validation
        var email = $('#email').val();
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            isValid = false;
            $('#email').addClass('is-invalid').after('<div class="invalid-feedback">Please enter a valid email address.</div>');
        }

        // User ID validation
        if ($('#userId').val().trim() === '') {
            isValid = false;
            $('#userId').addClass('is-invalid').after('<div class="invalid-feedback">User ID is required.</div>');
        }

        // Price and Quantity validation
        var price = $('#price').val();
        var quantity = $('#quantity').val();
        if (price <= 0 || quantity <= 0) {
            isValid = false;
            $('#price, #quantity').addClass('is-invalid').after('<div class="invalid-feedback">Price and Quantity must be greater than zero.</div>');
        }

        // Debit Card Number validation
        var cardNumber = $('#cardNumber').val();
        var cardPattern = /^[0-9]{16}$/;
        if (!cardPattern.test(cardNumber)) {
            isValid = false;
            $('#cardNumber').addClass('is-invalid').after('<div class="invalid-feedback">Please enter a valid 16-digit debit card number.</div>');
        }

        // CVV validation
        var cvv = $('#cvv').val();
        var cvvPattern = /^[0-9]{3}$/;
        if (!cvvPattern.test(cvv)) {
            isValid = false;
            $('#cvv').addClass('is-invalid').after('<div class="invalid-feedback">Please enter a valid 3-digit CVV.</div>');
        }

        // Expiry Date validation
        var expiryDate = $('#expiryDate').val();
        var expiryPattern = /^(0[1-9]|1[0-2])\/\d{2}$/;
        if (!expiryPattern.test(expiryDate)) {
            isValid = false;
            $('#expiryDate').addClass('is-invalid').after('<div class="invalid-feedback">Please enter a valid expiry date (MM/YY).</div>');
        }

        $("#checkoutform").on("submit",function(e){
        if (!isValid) {
            e.preventDefault();
            // Add AJAX request here if needed
        }
    });
    });
});

                </script>
                <script type="js/script.js"></script>
                
             
</body>
</html>
