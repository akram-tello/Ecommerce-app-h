<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "../database/db_connection.php";

if(isset($_POST["getProduct"])){
	$limit = 9;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$product_query = "SELECT * FROM products LIMIT $start,$limit";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			echo "
				<div class='col-md-4'>
					<div class='panel panel-info'>
						<div class='panel-heading' style='background-color: #293B5F !important;' style='background-color: #293B5F !important;'>$pro_title</div>
						<div class='panel-body'>
							<img src='assets/img/product_images/$pro_image' style='width:220px; height:250px;'/>
						</div>
						<div class='panel-heading' style='background-color: #293B5F !important;'>".CURRENCY.". $pro_price.00/-
							<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Add To Cart</button>
						</div>
					</div>
				</div>	
			";
		}
	}
}

?>