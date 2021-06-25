<?php
require "database/config/constants.php";

session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}
?>

<?php
// include Header.php file
include ('layouts/common/Header.php');
?>

<?php
// include _profile_navbar.php file
include ('layouts/components/_profile_navbar.php');
?>

<?php
// include container.php file
include ('layouts/common/container.php');
?>

<?php
// include _pagination.php file
include ('layouts/components/_pagination.php');
?>

<?php
// include Footer.php file
include ('layouts/common/Footer.php');
?>
















































