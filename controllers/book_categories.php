<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "../database/db_connection.php";


if(isset($_POST["category"])){
	$category_query = "SELECT * FROM book_categories";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Book Languages Avalible </h4></a></li>
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["cat_id"];
			$cat_name = $row["cat_title"];
			echo "
					<li><a href='#' class='category' cid='$cid'>$cat_name</a></li>
			";
		}
		echo "</div>";
	}
}

// include fetch_products.php file
include ('_fetch_products.php');
		
?>