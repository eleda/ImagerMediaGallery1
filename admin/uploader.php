<!-- EZ AZ ADATFELTOLTO!!!!! -->
<?php require_once ('scripts/uploader_helper.php'); ?>
<?php include ('templates/uploader_header.php'); ?>

<?php
$meth = isset ( $_POST ["method"] ) ? $_POST ["method"] : "";

switch ($meth) {
	case "media" :
		newmedia ();
		break;
	default :
		echo "Feltöltési hiba.";
}
?>

<p><a href="upload.php">Új feltöltés</a></p>
<p><a href="index.php">A főoldalra</a></p>

<?php include ('templates/uploader_footer.php'); ?>