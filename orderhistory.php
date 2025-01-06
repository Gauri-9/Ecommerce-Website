<?php

include("include/dbconnect.php");

$id = $_SESSION["sid"];

$qry = "select * from orders where uid = '$id'";

$result = mysqli_query($connect,$qry);


?>
<table class="table">
	<tr>
		<th>Sr.no</th>
		<th>Product Image</th>
		<th>Product</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Total Price</th>
		<th>Purchase Date</th>		
		<th>Action</th>

	</tr>
	<?php
	$count=1;
	while($data=mysqli_fetch_assoc($result))
	{	
		$pid = $data["pid"];
		$qry2 = "select productname,productprice,productimage,productcategory from products where pid ='$pid'";
		$result2 = mysqli_query($connect,$qry2);
		$data2 = mysqli_fetch_assoc($result2);
		$imagepath = "images/".$data2["productcategory"]."/".$data2["productimage"];

	?>
	<tr>
		<td><?php echo $count++;?></td>
		<td><img src="<?php  echo $imagepath ?>" width="30px"></td>
		<td><?php echo $data2["productname"] ?></td>
		<td><?php echo $data2["productprice"] ?></td>
		<td><?php echo $data["quantity"] ?></td>
		<td><?php echo $data["totalprice"] ?></td>
		<td><?php echo $data["uploaded_at"] ?></td>
		<td><a href="printinvoice.php?oid=<?php echo $data['oid'];?>" class="btn btn-outline-success">Print</button></td>
	</tr>
	<?php
	}
	?>
</table>