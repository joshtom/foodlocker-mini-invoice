<?php
session_start();
		include "includes/config.php";
		$msg = [];
?>
<?php
$actualTotalPrice = 0;
$actualTotalCost = 0;
$itemsPurchased = 0;
$totalItemPurchased = 0;
$totalQuery = mysqli_query($con, 'SELECT total_cost,total_price FROM `products`' );
	$row = mysqli_num_rows($totalQuery);
	while($fetch = mysqli_fetch_array($totalQuery)){  
	 for($i = 1; $i <= $row; $i++){
	 	$actualTotalCost += $fetch['total_cost'];
	 	$actualTotalPrice += $fetch['total_price'];
	 }
	}
	  // echo $actualTotalCost. '<br>';
	  // echo $actualTotalPrice. '<br>';
	// echo $fetch['total_price'];

							$select = mysqli_query($con, "SELECT total FROM itempurchased");
							$numrow = mysqli_num_rows($select);
							while($fetch = mysqli_fetch_array($select)){  
							 for($i = 1; $i <= $numrow; $i++){
							 	$totalItemPurchased += $fetch['total'];
							 }
							}



?>
<?php
						if (isset($_POST['addProduct'])) {
							$p = $_POST['p'];
							$c = $_POST['c'];
							$u = $_POST['u'];
							$upc = $_POST['upc'];
							$cc = $_POST['cc'];
							$cp = $_POST['cp'];
							$uc = $_POST['uc'];
							$up = $_POST['up'];
							$total_cost = ($c * $cc) + ($u * $uc);
							$total_price = ($c * $cp) + ($upc * $up);
	

							// Insert into The product table
// $insert = mysqli_query($con, "INSERT INTO products ('products', 'cartons','units','upc','cc','cp','uc','up','total_cost','total_price') VALUES ('$p','$c','$u','$upc','$cc','$cp','$uc','$up','$total_cost','$total_price') ");
							$sql = "INSERT INTO `products` (`id`, `products`, `cartons`, `units`, `upc`, `cc`, `cp`, `uc`, `up`, `date`, `total_cost`, `total_price`) VALUES (NULL, '$p', '$c', '$u', '$upc', '$cc', '$cp', '$uc', '$up', CURRENT_TIMESTAMP, '$total_cost', '$total_price')";
							$insert = mysqli_query($con, $sql);

						if($insert) {
							 echo "<script> alert('You have just added a product'); </script>";
						} else {
							echo "<script> alert('Unable to add a product'); </script>";
						}
		}

					?>


					<?php 
						
						if (isset($_POST['sellProduct'])) {
							$updateuc = $_POST['updateuc'];
							$updateup = $_POST['updateup'];
							$total = $updateuc * $updateup;
							
							
							
							
								// Perfom insert query and Update Product table

								$itemsql = "INSERT INTO `itempurchased` (`id`, `total`) VALUES (NULL, '$total')";
								$insert = mysqli_query($con, $itemsql);
								$updatesql = "UPDATE products SET `units`=$updateuc, `cartons`=$updateup";
								$updateproduct = mysqli_query($con, $updatesql);
								if($insert && $updateproduct){
									echo "<div class='alert alert-success'>Customer has successfully Purchased $updateuc items </div>";
								} else {
									echo "<div class='alert alert-danger'> Unable to process Products </div>";
								}

							
						}

					?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inventory For foodlocker</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD MORE PRODUCT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id=""  method="post" style="color: #16BA3C; font-weight: bold;">

						<div class="form-group">
							<label for="product" class="">Product</label>
							<input required="required" type="text" class="form-control" id="product" name="p" placeholder="Enter Product name">
						</div>
						<div class="form-group">
							<label for="product" class="">Cartons</label>
							<input required="required" type="text" class="form-control" id="product" name="c" placeholder="Cartons">
						</div>
						<div class="form-group">
							<label for="product" class="">Units</label>
							<input required="required" type="text" class="form-control" id="unit" name="u" placeholder="Enter Units">
						</div>
						<div class="form-group">
							<label for="product" class="">Unit Per Carton</label>
							<input required="required" type="text" class="form-control" id="product" name="upc" placeholder="Enter unit Per Carton">
						</div>
						<div class="form-group">
							<label for="product" class="">Carton Cost</label>
							<input required="required" type="text" class="form-control" id="product" name="cc" placeholder="Enter Cartoon Cost">
						</div>
						<div class="form-group">
							<label for="product" class="">Carton Price</label>
							<input required="required" type="text" class="form-control" id="product" name="cp" placeholder="Enter Carton Price">
						</div>
						<div class="form-group">
							<label for="product" class="">Unit Cost</label>
							<input required="required" type="text" class="form-control" id="product" name="uc" placeholder="Enter Unit COst">
						</div>
						<div class="form-group">
							<label for="product" class="">Unit Price</label>
							<input required="required" type="text" class="form-control" id="product" name="up" placeholder="Enter Unit Price">
						</div>
						

				
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        	<button type="submit" class="btn btn-success" name="addProduct">ADD PRODUCT</button>
      </div>
      	</form>
    </div>
  </div>
</div>
	<div class="container-fluid ">
		<nav>
			<div class="logo"><h3 class="lo">FOODLOCKER.</h3><span class="text-grey">inventory</span></div>
			<div class="links"><div class="badge badge-primary p-2">Total Cost &#8358;<?php echo $actualTotalCost; ?></div>
			<div class="badge badge-primary p-2">Total Price &#8358;<?php echo $actualTotalPrice; ?></div>
			<div class="badge badge-success p-2">Items Purchased &#8358;<?php echo $totalItemPurchased; ?></div>
		</div>

		</nav>

		<div class="row mt-2 mb-2">
			<div class="container">
			
			<?php 
				$selectquery =  mysqli_query($con, "SELECT * FROM products");
			  ?>
			  <h3 class="display-4 text-white text-center">Inventory Informations </h3>
			  <button type="button" class="btn btn-success" id="item-add" data-toggle="modal" data-target="#exampleModal">
				ADD MORE ITEMS <span class="text-bold">+</span>
			</button>
			
			
			<!-- <button class="btn btn-danger " id="hide_button">COLLAPSE FORM</button> -->
			  <p class="text-white"><?php  echo  $_SESSION['msg'];?> </p>
			  
			<table border="0" class="table table-bordered table-style" style="text-align: center;">
				<thead>
					<tr class="text-white">
						<td>Serial Number</td>
						<td>Product</td>
						<td>Cartons</td>
						<td>Units</td>
						<td>Units Per Carton</td>
						<td>Carton Cost</td>
						<td>Carton Price</td>
						<td>Unit Cost</td>
						<td>Unit Price</td>
						<td>Total Cost</td>
						<td>Total Price</td>
						<td class="text-white">Action</td>
					</tr>
				</thead>
				<tbody>
					
					<?php 
				
					while ($fetch = mysqli_fetch_array($selectquery)):
						$countrow = mysqli_num_rows($selectquery);
						$id = $fetch['id'];
						$products = $fetch['products'];
						$cartons = $fetch['cartons'];
						$units = $fetch['units'];
						$upc = $fetch['upc'];
						$cc = $fetch['cc'];
						$cp = $fetch['cp'];
						$uc = $fetch['uc'];
						$up = $fetch['up'];
						$total_cost = $fetch['total_cost'];
						$total_price = $fetch['total_price'];
						


           			 
           			  
					 ?>
					 
					<tr class="text-white">
					<td><?php echo $id; ?></td>
					<td><?php echo $products; ?></td>
					<td><?php echo $cartons; ?></td>
					<td><?php echo $units; ?></td>
					<td><?php echo $upc; ?></td>
					<td><?php echo $cc; ?></td>
					<td><?php echo $cp; ?></td>
					<td><?php echo $uc; ?></td>
					<td><?php echo $up; ?></td>
					<td><?php echo $total_cost; ?></td>
					<td><?php echo $total_price; ?></td>

					<td><!-- <button type="button" class="text-white btn btn-success" data-toggle="modal" data-target="#a">Sell Unit / Carton </button> -->
<a type="button" class="btn btn-success btn-small" id="custId" data-toggle="modal" data-target="#modal<?php echo $id ?>" data-id="'.$id.'" onclick="">Sell Unit / Carton</a>
							<!-- <input type="hidden" value="<?php  $id ?>" id="getID" name="<?php  $id ?>" > -->
					</td>
					</tr>
					<div class="modal fade" id="modal<?php echo $id ?>" role="dialog"  >
	
	<?php

	
	$select = mysqli_query($con, "SELECT * FROM products WHERE id='$id'");
	$fetch = mysqli_fetch_array($select);
	$productName = $fetch['products'];
	$unit = $fetch['units'];
	$carton = $fetch['cartons'];

	?>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sell Units / Cartons <span id="event_id"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post">

						<h4 style="display: inline-block;">Product Name:  <?php echo $productName; ?> </h4>  
						<div class="form-group">
							<label for="product" class="text-dark">Current Unit</label>
							<input required="required" type="number" class="form-control" id="unit" name="updateuc" value="<?php echo $unit; ?>">
						</div>
						<div class="form-group">
							<label for="product" class="text-dark">Current Price</label>
							<input required="required" type="number" class="form-control" id="carton" name="updateup" value="<?php echo $cc; ?>">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success" name="sellProduct">SELL PRODUCT</button>
						</div>

					</form>
					 <!-- <div class="fetched-data"></div>  -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


					
					<?php endwhile ?>
					
				</tbody>
				
			</table>
			
			
			</div>
		</div>


	</div>



<!-- Modal -->



</body>
</html>
<script src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

<script>

		document.querySelector("#item-add").addEventListener('click', (e) => {
		
			if(e.button === 0){
					$("#hide_button").show();
					$("#add_form").show();
			} else {
				$("#add_form").hide();
				$("#hide_button").show()
			}
		
		})
		document.querySelector("#hide_button").addEventListener('click', (e) => {
			if(e.button === 0){
					$("#hide_button").hide();
					$("#add_form").hide();
					
			} else {
				$("#add_form").hide();
				$("#hide_button").show()
			}
		
		});
		var productID = $("#getID").val();
		function setEventId(event_id) {
			document.querySelector("#event_id").innerHTML = event_id;
		}
			
		
</script>