<?php 
	include "includes/config.php";
	$id = $_GET['id'];
	// echo $id;
	$select = mysqli_query($con, "SELECT * FROM products WHERE id='$id'");
	$fetch = mysqli_fetch_array($select);
	$productName = $fetch['products'];
	$unit = $fetch['units'];
	$carton = $fetch['cartons'];
 ?>
 <?php
 	$value1 = 2.40;
 	$value2 = 3.50;
 	//echo $value3 = $value1 + $value2;

 ?>


 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Sell Product Here</title>
 	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
 	<link rel="stylesheet" href="css/style.css">
 </head>
 <body style="height: auto; background-color: #3c814c!important">
 		<nav>
			<div class="logo"><h3 class="lo">FOODLOCKER.</h3><span>inventory</span></div>
			<div class="links"><a href="/">Go to Home</a></div>
		</nav>

		<div class="container">
			<div class="container">

				<div class="row">
					<form action="" id=""  method="post" style="width: 50%;">

						<h1 style="display: inline-block;">Product Name:</h1>  <h3 class="text-white" style="display: inline-block;">> <?php echo $productName; ?> </h3>
						<div class="form-group">
							<label for="product" class="text-white">Current Unit</label>
							<input required="required" type="text" class="form-control" id="product" name="uc" value="<?php echo $unit; ?>">
						</div>
						<div class="form-group">
							<label for="product" class="text-white">Current Carton</label>
							<input required="required" type="text" class="form-control" id="product" name="up" value="<?php echo $carton; ?>">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success" name="addProduct">SELL PRODUCT</button>
						</div>

					</form>

					
				</div>
		</div>
 </body>
 </html>