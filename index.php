<?php

include("include/dbconnect.php");

$qry = "SELECT * FROM products";

$result = mysqli_query($connect, $qry);
if (!$result) {
    die("Error in query: " . mysqli_error($connect));
}



$categoryquery = "select distinct productcategory from products";
$categoryresult = mysqli_query($connect,$categoryquery);


$pricequery = "select min(productprice) as min_price ,max(productprice) as max_price from products";
$priceresult = mysqli_fetch_assoc(mysqli_query($connect,$pricequery));


?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Filter</title>
    <?php include("include/allheadercdn.php"); ?>
    <style>
    	.jumbotron{
    		clip-path: inset(0 0 0 0 round 5% 20% 0 10%);    		
    		padding: 5rem 2rem;
    		height: 450px; 
    	}
    	.jumbotron a:hover {
            color: black;
           }
        #container{
        	padding: 0px 25px;
        	margin-top: 55px;

        }
        .jumbotron a{
            margin-top: 50px;
    	}
    	.carousel-indicators{
    		width:400px;
    		margin-top: 80px;
            
    	}
    	.carousel-item {
            transition: transform 1s ease; /* Adjust the duration and easing function as needed */
        }
    #icons{
        text-align:center;
        margin-top: 100px;
    }
    #icons a{
        color:black;
    }
    .carousel-indicators [data-bs-target]{
        background-color: black;
    }
    
    </style>
</head>
<body>
    <?php include("include/homeheader.php"); ?>

    <div class="jumbotron custom-jumbotron">
        <div class="row">
            <div class="col-md-6">
                <section id="shopping-section" class="text-center">
                	<section id="shopping-section" class="text-center">
    					<div class="container" id="container">
        				<h2 class="section-title">Enjoy Your Shopping</h2><br><br>
        				<p class="section-caption">Discover premium products that combine quality and value. Shop now to find top picks that elevate your everyday life.From our store to your door – Experience the difference.Step into style with exclusive collections.</p>
        				<a href="#" class="btn btn-outline-danger" id="button">Explore Now</a>
    					</div>
					</section>
				</section>	    	
            </div>
            
            <div class="col-md-6"> 
                    	
            	<div id="demo" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item">							
							<img src="images/static/img5.jpg" class="img-fluid" width=60%>  
						</div>  
								
						<div class="carousel-item">        		
                			<img src="images/static/img6.jpg" class="img-fluid" width="60%">
                		</div>

                		<div class="carousel-item active">
                    		<img src="images/static/img7.jpg" class="img-fluid" width="60%">
                		</div>

                		<div class="carousel-item">
                    		<img src="images/static/img8.jpg" class="img-fluid" width="60%">
                		</div>

                		<div class="carousel-item">
                    		<img src="images/static/img9.jpg" class="img-fluid" width="50%">
                		</div>                		
            		</div>
            		<ul class="carousel-indicators">
						<li data-bs-target="#demo" data-bs-slide-to="0"></li>
						<li data-bs-target="#demo" data-bs-slide-to="1"></li>
						<li data-bs-target="#demo" data-bs-slide-to="2"  class="active"></li>
						<li data-bs-target="#demo" data-bs-slide-to="3"></li>
						<li data-bs-target="#demo" data-bs-slide-to="4"></li>

					</ul>
					<a class="carousel-control-prev" href="#demo" role="button" data-slide="prev">
    					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    					<span class="sr-only">Previous</span>
  					</a>
  					<a class="carousel-control-next" href="#demo" role="button" data-slide="next">
    					<span class="carousel-control-next-icon" aria-hidden="true"></span>
    					<span class="sr-only">Next</span>
  					</a>
            	</div>
        	</div>        
        </div>
    </div>




    <!-- //product list -->
    <div class="container" id="container">        
        <div id="icons">
            <a href="https://www.youtube.com/watch"><i class="bi bi-youtube"></i></a>
            <a href="www.facebook.com"><i class="bi bi-facebook"></i></a>
            <a href="https://wa.me/<number>"><i class="bi bi-whatsapp"></i></a>
            <a href="tiktok.com/@"><i class="bi bi-tiktok"></i></a>
            <a href="www.pinterest.com"><i class="bi bi-pinterest"></i></a>
            <a href="https://twitter3e4tixl4xyajtrzo62zg5vztmjuricljdp2c5kshju4avyoid.onion"><i class="bi bi-twitter"></i></a>
            <a href="www.onlinesbi.sbi"><i class="bi bi-bank"></i></a>
        </div>
        <hr width="20%" color="black">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Filter</h3>
                    </div>
                    <div class="card-body">
                        <h5>Category</h5>
                        <?php
                        while($category=mysqli_fetch_assoc($categoryresult))
                        {?>
                        
                        <div class="form-check">
                            <input type="checkbox" class="category-filter" id="category-<?php echo $category['productcategory']?>" value= "<?php echo $category['productcategory']?>"><?php echo $category["productcategory"];?>
                        </div>
                        <?php
                        }
                        ?>

                        <h5>Price</h5>
                        <input type="range" class="form-range" id="pricerange" min="<?php echo $priceresult['min_price']?>"  max="<?php echo $priceresult['max_price']?>" >
                        <div class="d-flex justify-content-between"> 
                            <span id="minprice" ><?php echo $priceresult['min_price']?></span>
                            <span id="maxprice" ><?php echo $priceresult['max_price']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">                 
                <div class="row">             
                <?php
                if ($result)
                {                 
                    while ($data = mysqli_fetch_assoc($result))
                     {
                    	 $imagePath = 'images/' . $data['productcategory'] . '/' . $data['productimage'];

                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4  product-item" data-price ="<?php echo $data['productprice']; ?>" data-category ="<?php echo $data['productcategory']; ?>">
                            <div class="card  product-card" tyle="width: 18rem;" font-size:1rem>
                                <img src="<?php echo $imagePath ?>" class="card-img-top product-img img-fluid" alt="<?php echo $data['productname']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $data['productname']; ?></h5>
                                    <p class="card-text">
                                        <span class="rating-star">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                                        <br>Price: <?php echo $data['productprice']; ?>
                                    </p>
                                    <a href="productinfo.php?pid=<?php echo $data['pid'] ?>" class="btn btn-primary">View More</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    echo "<p>No products found.</p>";
                }
                ?>
                </div>
            </div>
        </div>
    </div>

<?php include("include/allfooterlinks.php");?>
<script type="text/javascript" src="js/script.js"></script>  

<script>
    $(document).ready(function(){

        let maxprice = <?php echo $priceresult['max_price']; ?>;
        let minprice = <?php echo $priceresult['min_price']; ?>;

        $(".category-filter").on('change', filterProducts);
                   
        $("#pricerange").on('input', function() {
            let value = $(this).val();
            $("minprice").text(minprice);
            $("#maxprice").text(value);
            filterProducts();
        });


    function filterProducts()
    {
        const selectedCategory = $(".category-filter:checked").map(function(){
            return $(this).val();
        }).get();

        const selectedMaxPrice = $("#pricerange").val();

        $(".product-item").each(function(){
            const category = $(this).data('category');            
            const price = $(this).data('price');

            if(selectedCategory.length==0||selectedCategory.includes(category)&& price<=selectedMaxPrice){
                $(this).show();
            }
            else{
                $(this).hide();
            }

        })






    }
    });
</script>


</body>
</html>
