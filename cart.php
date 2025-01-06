<?php
session_start();

include("include/dbconnect.php");
include("include/allheadercdn.php");
include("include/homeheader.php");

$id = $_SESSION["sid"];
$qry = "select * from addtocart where uid='$id'";
$result = mysqli_query($connect,$qry);
$rows = mysqli_num_rows($result);

?>
<link rel="stylesheet" href="css/style.css">

<div class="container my-4">
	<div class="row">
		<div class="col-md-8">
			<table class="table">
				<tr>
					<th>S.No</th>
					<th>Product Image</th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Action</th>
				</tr>
				<?php
				$count = 1;
				$total_price = 0;
				$total_items = 0;
				if($rows>0)
				{
				while($data = mysqli_fetch_assoc($result))
				{
					$pid = $data["pid"];
					$qry2 = "select productname,productcategory,productimage from products where pid='$pid'";
					$result2 = mysqli_query($connect,$qry2);
					$data2 = mysqli_fetch_assoc($result2);
					$imagepath = "images/".$data2["productcategory"]."/".$data2["productimage"];

					$total_price += $data["totalprice"] ;
					$total_items += $data["quantity"];
				?>
				<tr>
					<td><?php echo $count++ ; ?></td>
					<td><img src = "<?php echo $imagepath; ?>" class = "img-fluid" width = "40px"></td>
					<td><?php echo $data2["productname"];?></td>
					<td class = "itemprice"><?php echo $data["totalprice"];?></td>
					<td><input type="number" class="quantity" name="quantity[]"  value = "<?php echo $data['quantity'];?>" class="form-control d-inline-block" min="1" max="10" style="width: 60px; "  data-price = "<?php echo $data['totalprice']/$data['quantity'];?>" data-id = "<?php echo $pid ;?>"></td>
					<td>
    					<a href="deleteaddedproduct.php?id=<?php echo $pid ?>" onclick="confirmDelete(<?php echo $pid ?>)">
        				<i class="bi bi-trash"></i></a>
					</td>

					<!-- <td>
                        <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $data2['pid']; ?>, this)">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td> -->


				</tr>
				<?php
				}				
				}
				else
				{ ?>
					<tr>
						<td colspan="6" align="center">No record found</td>
					</tr>
				<?php
			 	}
				
				
				?>
			</table>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<h4>Order Summary</h4>
					<p>Total Items -<span id="totalitems">0</span></p>
					<h5>Price -  <span id="totalprice">0</span></h5>
					<form method ="post" action="checkout2.php">
						<input type="hidden" name="totalquantity" id="quantityInput">
						<input  type="hidden" name="totalprice" id="priceInput">

						<?php 
						mysqli_data_seek($result,0);
						while($data = mysqli_fetch_assoc($result))
						{
							$pid = $data["pid"];
							$quantity = $data["quantity"];
							$totalprice = $data["totalprice"];
						?>
							<input type="hidden" name="products[]" value="<?php echo $pid ?>">
							<input type="hidden" name="quantities[]" value="<?php echo $quantity ?>">
							<input type="hidden" name="prices[]" value="<?php echo $totalprice ?>">

						<?php
						}
						?>

						<button class="btn btn-primary" type="submit">Proceed to checkout</button>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>






<?php include("include/allfooterlinks.php");?>

<script>
	/*function confirmDelete(productId, rowElement) {
    if (confirm('Are you sure you want to delete this product?')) {
        $.ajax({
            url: 'deleteaddedproduct.php',
            type: 'POST',
            data: { id: productId },
            success: function(response) {
                let result = JSON.parse(response);
                if (result.success) {
                    $(rowElement).closest('tr').remove();
                    updateTotals();
                } else {
                    alert(result.message);
                }
            },
            error: function() {
                alert('An error occurred while trying to delete the product.');
            }
        });
    }
}
$(document).ready(function() {
    $(".quantity").change(updateTotals);
    $(".quantity").trigger('change');

});*/



/*$(document).ready(function(){
	$(".quantity").change(function(){

		let totalPrice = 0;
		let totalItems = 0;

		$(".quantity").each(function(){

			let quantity = $(this).val();
			totalItems +=parseInt(quantity) ;
			let price = $(this).data('price');
			totalPrice += quantity*price;
		});
		
		$("#totalprice").text(totalPrice);
		$("#totalitems").text(totalItems);

		$("#priceInput").val(totalPrice);
		$("#quantityInput").val(totalItems);


		let index=0;
		$(".quantity").each(function(){
			let quantity = $(this).val();
			$("input[name='quantities[]']").eq(index).val(quantity);
			index++;
		});
	



		$(".quantity").change(function(){
			updateTotals();
		})


		$(".quantity").trigger('change');

	});





	


	});

 </script>

*/


<script>
function confirmDelete(productId, rowElement) {
    if (confirm('Are you sure you want to delete this product?')) {
        $.ajax({
            url: 'deleteaddedproduct.php',
            type: 'POST',
            data: { id: productId },
            success: function(response) {
                let result = JSON.parse(response);
                if (result.success) {
                    $(rowElement).closest('tr').remove();
                    updateTotals();
                } else {
                    alert(result.message);
                }
            },
            error: function() {
                alert('An error occurred while trying to delete the product.');
            }
        });
    }
}

function updateTotals() {
    let totalPrice = 0;
    let totalItems = 0;

    $(".quantity").each(function() {
        let quantity = $(this).val();
        totalItems += parseInt(quantity);
        let price = $(this).data('price');
        totalPrice += quantity * price;
    });

    $("#totalprice").text(totalPrice);
    $("#totalitems").text(totalItems);

    $("#priceInput").val(totalPrice);
    $("#quantityInput").val(totalItems);

    let index = 0;
    $(".quantity").each(function() {
        let quantity = $(this).val();
        $("input[name='quantities[]']").eq(index).val(quantity);
        index++;
    });
}

$(document).ready(function() {
    $(".quantity").change(updateTotals);
    $(".quantity").trigger('change');
});
</script>
