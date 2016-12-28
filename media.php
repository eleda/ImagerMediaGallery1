<?php


// helper fv
require_once('scripts/media_helper.php');
// GET
$view = isset($_GET ["view"]) ? $_GET["view"] : "";
$art_cat = isset($_GET["category"]) ? $_GET["category"] : "";
$art_file = isset ( $_GET ["id"] ) ? $_GET ["id"] : "";
// /GET

include ('templates/index_header.php');
include ('templates/index_body.php');
include ('templates/index_footer.php');
