<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "../database/db_connection.php";

if(isset($_POST["type_of_book"])){
	$type_of_book_query = "SELECT * FROM type_of_book";
	$run_query = mysqli_query($con,$type_of_book_query);
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Type Of Books Avalible</h4></a></li>
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$bid = $row["brand_id"];
			$brand_name = $row["brand_title"];

			echo "
                <li><a href='#' class='type_of_book' bid='$bid'>$brand_name</a></li>
			";
		}
		echo "</div>";
	}
}


// include fetch_products.php file
include ('_fetch_products.php');


?>