<!-- EZ AZ ADMIN FELULET!!! -->
<?php require_once('scripts/admin_helper.php'); ?>

<?php
// setcookie
$picp = 0;
$pw = isset ( $_POST ["pw"] ) ? $_POST ["pw"] : "";

if ($pw == "*") {
	setcookie ( "pw", "" );
	$picp = 0;
}
if ($pw != "") {
	setcookie ( "pw", md5 ( $pw ) );
}

$pw = isset ( $_COOKIE ["pw"] ) ? $_COOKIE ["pw"] : $pw;

$meth = isset ( $_GET ["method"] ) ? $_GET ["method"] : "";
$npw = isset ( $_POST ["npw"] ) ? $_POST ["npw"] : "";

$pwf = "#&@[]~$$~@#";
?>

<?php include('scripts/generate_password.php'); ?>

<?php include('templates/admin_header.php'); ?>
<?php include('templates/admin_body.php'); ?>
<?php include('templates/admin_footer.php'); ?>