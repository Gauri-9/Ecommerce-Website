<?php
session_start();
include("include/dbconnect.php");
include("include/allheadercdn.php");
include("include/homeheader.php");


if($_SERVER["REQUEST_METHOD"]=="POST")
{
	if(isset($_POST["totalquantity"]) && isset($_POST["totalprice"]) && isset($_POST["products"]))
	{
		$totalquantity = $_POST["totalquantity"];
		$totalprice = $_POST["totalprice"];

		$products = $_POST["products"];
		$quantities = $_POST["quantities"];
		$prices = $_POST["prices"];


?>
<style>
	#payment input,textarea{
            margin-bottom:10px;
        }
       
    </style>

<link rel="stylesheet" href="../css/stylesheet">
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<table class="table" id="checkout">
				<h4>Checkout Summary</h4>
				<tr>
					<th>S.no</th>
					<th>Product Image</th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Total</th>				
				</tr>
				<?php 
				$count=1;
				for($i=0;$i<count($products);$i++)
				{
					$pid = $products[$i];
					$quantity = $quantities[$i];
					$price = $prices[$i];
					$total = $quantity*$price;

					$qry = "select productname,productimage,productcategory from products where pid='$pid'";
					$result = mysqli_query($connect,$qry);
					$data = mysqli_fetch_assoc($result);

					$imagepath = "images/".$data["productcategory"]."/".$data["productimage"];

				?>
				<tr>
					<td><?php echo $count++?></td>
					<td><img src="<?php echo $imagepath ?>" width="40px"></td>
					<td><?php echo $data["productname"]?></td>
					<td><?php echo $price?></td>
					<td><?php echo $quantity?></td>
					<td><?php echo $total?></td>
				</tr>
				<?php
				}
				?>
			</table>
			<form method="post" id="payment">
				<h3>Payment and Delivery Information</h3>

				<input type="hidden" name="totalquantity" class="form-control" value="<?php echo $totalquantity ?>" readonly>
				<input type="hidden" name="totalprice" class="form-control" value="<?php echo $totalprice ?>" readonly>	
				<?php
				for($i=0;$i<count($products);$i++)
				{
				?>
				<input type="hidden" name="quantities[]" class="form-control" value="<?php echo $quantities[$i] ?>" readonly>
				<input type="hidden" name="products[]" class="form-control" value="<?php echo $products[$i] ?>" readonly>
				<input type="hidden" name="prices[]" class="form-control" value="<?php echo $prices[$i] ?>" readonly>
				<?php
				}
				?>

				<input type="hidden"  name="totalquantity" class="form-control" value="<?php echo $totalquantity?>">
				<input type="hidden" name="totalprice" class="form-control"  value="<?php echo $totalprice?>">				
				<input type="text" placeholder="Card Number" name="cardnumber" id="cardnumber" class="form-control">
				<input type="text" placeholder="CVV" name="cvv" id="cvv" class="form-control">
				<input type="text" placeholder="Expiry Date" name="expirydate" id="expirydate" class="form-control">
				Address-<textarea name="address" class="form-control"></textarea>
				<button type="submit" class="btn btn-success" name="ordernow">Order Now</button> 
			</form>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<h3>Order Summary</h3>
					<p>Total Items-<?php echo $totalquantity ?></p>
					<h5>Total Price- <?php echo $totalprice ?></h5>
				</div>
			</div>
		</div>
	</div>
</div>

		

<?php
}
}


if(isset($_POST["ordernow"]))
{
	$uid = $_SESSION["sid"];

	$cardnumber = $_POST["cardnumber"];
	$address = $_POST["address"];
	$totalquantity = $_POST["totalquantity"];
	$totalprice = $_POST["totalprice"];
	$products = $_POST["products"];



	for($i=0;$i<count($products);$i++)
	{

		$pid = $products["$i"];
		$quantity = $quantities["$i"];
		$price = $prices["$i"];
		$total = $quantity*$price;

		$qry2 = "INSERT INTO `orders`(`oid`, `uid`, `pid`, `quantity`, `totalprice`, `debitcard`, `address`) VALUES (NULL,'$uid','$pid','$quantity','$total','$cardnumber','$address')";
		$result2 = mysqli_query($connect,$qry2);

		$qry3 = "delete from addtocart where uid= '$uid'";
		$result3 = mysqli_query($connect,$qry3);
		
	}
		
		?><sript>alert("Order Place Successfully")</sript><?php
		
}









 include("include/allfooterlinks.php");

 ?>