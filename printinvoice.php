<?php
session_start();


include("include/dbconnect.php");
include("include/allheadercdn.php");


$companyname = "AlphaTech Enterprises";
$companyemail = "alphatech@gmail.com";
$companycontact = "9527775488";
$companyaddress = "1234 Innovation Drive
				   Suite 567
				   TechCity, ST 89012
				   United States";

$companywebsite = "www.alphatech.com";

$id = $_SESSION["sid"];
$qry = "select fullname,contact,email from user where id = '$id'";
$result = mysqli_query($connect,$qry);
$data = mysqli_fetch_assoc($result);

$deliveryname = $data["fullname"];
$deliveryemail = $data["email"];
$deliverycontact = $data["contact"];




/*$oid = $_GET["oid"];
$qry2 = "select * from orders where oid = '$oid'";
$result2 = mysqli_query($connect,$qry2);

*/
/*$pid = $data2["pid"];
$qry3 = "select productname,productprice from products where pid = '$pid'";
$result3 = mysqli_query($connect ,$qry3);
$data3 = mysqli_fetch_assoc($result3);

*/

$gst_rate = "18";



?>
<style>
	.invoice{
		max-width:1000px;
		margin:auto;
		border:1px solid grey;
		height:60vh;
	}
	.invoice-content{
		padding:20px 20px;
	}
</style>
<div class="invoice">
	<div class="invoice-content">
		
		<div class="text-center">
			<h2><?php echo $companyname ?></h2>
			<h6 style="font-family: Arial"><?php echo nl2br($companyaddress) ?></h6>
			<h6 style="font-family: Arial">Mob-<?php echo $companycontact ?> | Email-<?php echo $companyemail ?> | Web-<?php echo $companywebsite ?></h6>
		</div>
		<hr>
		<h4 style="font-family: Arial">Customer name-<?php echo $deliveryname ?></h4>
		<h6 style="font-family: Arial">Email-<?php echo $deliveryemail ?></h6>
		<h6 style="font-family: Arial">Mob-<?php echo $deliverycontact ?></h6>
		<hr>

		<h4>Product details</h4>
		<table class="table">
			<tr>
				<th>S.no</th>
				<th>Product Name</th>
				<th>Product Price</th>
				<th>Quantity</th>
				<th>GST</th>
				<th>Total Price(inclu gst)</th>
				<th>Date</th>				
			</tr>
			<?php
			$count = 1;
			 $qry2 = "SELECT o.oid, o.quantity, o.totalprice, o.uploaded_at, p.productname, p.productprice 
                     FROM orders o 
                     JOIN products p ON o.pid = p.pid 
                     WHERE o.uid = '$id'";
			$result2 = mysqli_query($connect,$qry2);

			while($data2 = mysqli_fetch_assoc($result2))
			
			{
			/*$pid = $data2["pid"];
			$qry3 = "select productname,productprice from products where pid = '$pid'";
			$result3 = mysqli_query($connect ,$qry3);
			$data3 = mysqli_fetch_assoc($result3);
*/
			
			$productprice = $data2["productprice"];
			$quantity = $data2["quantity"];
			$gst_amount = $productprice*($gst_rate/100);
			$total_pri_inclu_gst = ($productprice+$gst_amount)*$quantity;

			?>
			<tr>
				<td><?php echo $count++ ;?></td>
				<td><?php echo $data2["productname"]?></td>
				<td><?php echo $productprice ?></td>
				<td><?php echo $quantity ?></td>
				<td><?php echo $gst_rate?></td>				
				<td><?php echo $total_pri_inclu_gst?></td>
				<td><?php echo $data2["uploaded_at"]?></td>
			</tr>
			<?php
			}
			?>
		</table>
	</div>
</div>





<?php include("include/allfooterlinks.php");?>
<script>
	window.print();
</script>