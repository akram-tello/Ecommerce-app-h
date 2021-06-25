<?php
if (isset($_GET["register"])) {	
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
// include registration_form_body.php file
include ('layouts/components/_registration_form_body.php');
?>	

<?php
// include Footer.php file
include ('layouts/common/Footer.php');
?>



<?php
}

?>