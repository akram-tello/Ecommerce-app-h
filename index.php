<?php
require "database/config/constants.php";

session_start();
if(isset($_SESSION["uid"])){
	header("location:profile.php");
}

?>

<?php
// include Header.php file
include ('layouts/common/Header.php');
?>

<?php
// include _loader.php file
include ('layouts/components/_loader.php');
?>

<?php
// include _index_navbar.php file
include ('layouts/components/_index_navbar.php');
?>

<?php
// include container.php file
include ('layouts/common/container.php');
?>

<?php
// include Footer.php file
include ('layouts/common/Footer.php');
?>
















































