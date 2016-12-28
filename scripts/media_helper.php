<?php

// HELPER FUNS 

function curURL() {
	$pageURL = 'http';
	// if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER ["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER ["SERVER_NAME"] . ":" . $_SERVER ["SERVER_PORT"];
	} else {
		$pageURL .= $_SERVER ["SERVER_NAME"];
	}
	return "";
	// return $pageURL;
}
function curpurl() {
	return "";
	// return curURL() . $_SERVER["SCRIPT_NAME"];
}

// DÁTUM FÜGGVÉNYEK - JAVÍTVA!
function getdat($dat) // paraméter pl: 2011-01-27-11-56-00
{
	$y = substr ( $dat, 0, 4 );
	$m = substr ( $dat, 5, 2 );
	$d = substr ( $dat, 8, 2 );
	$h = substr ( $dat, 11, 2 );
	$mi = substr ( $dat, 14, 2 );
	if (strlen ( $dat ) == 19) {
		$se = ( int ) (substr ( $dat, 17, 2 ));
	} else {
		$se = 0;
	}
	
	$da = mktime ( $h, $mi, $se, $m, $d, $y );
	
	return $da;
}
function dupnum($nu) {
	if (strlen ( $nu ) == 1) {
		return "0" . $nu;
	}
}
function setdat($dat) // paraméter: unix timestamp
{
	return idate ( "Y", $dat ) . "." . idate ( "m", $dat ) . "." . idate ( "d", $dat ) . ". " . idate ( "H", $dat ) . ":" . idate ( "i", $dat ) . ":" . idate ( "s", $dat );
}
function isnew($dat) // paraméter: unix timestamp
{
	// echo $dat-time();
	if (time () - $dat <= 1000000) {
		return true;
	} else {
		return false;
	}
}

function filsize($fname) {
	$fs = filesize ( $fname );
	$mag = 0;
	
	while ( $fs > 1024 ) {
		$fs /= 1024;
		$fs = round ( $fs );
		$mag ++;
	}
	
	switch ($mag) {
		case 0 :
			return $fs . " byte";
			break;
		case 1 :
			return $fs . " KB";
			break;
		case 2 :
			return $fs . " MB";
			break;
		case 3 :
			return $fs . " GB";
			break;
		case 4 :
			return $fs . " TB";
			break;
		default :
			return $fs;
	}
}

// /HELPER FUNS

// VIEW FUNS

function downloadbutton($lnk) {
	?>
	<?php include('templates/fragments/downloadbutton.php'); ?>
	<?php
}

function shownew($dat) {
	if (isnew ( $dat ) ) {
		include ('templates/fragments/shownew.php');		
	}
}

// DÁTUM FÜGGVÉNYEK VÉGE.
function showcategory($cat) {

	// load
	$file = fopen ( "media/" . $cat . ".txt", "r" ) or exit ( "Nincs ilyen kategória." );
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$c_title = $mcdat;
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$c_desc = $mcdat;
	$cururl = curURL();

	?>

	<?php include ('templates/fragments/showcategory.php'); ?>
	
	<?php 
	while ( ! feof ( $file ) ) {
		$mc = fgets ( $file );
		$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
		$a_text = $mcdat;
		echo $a_text;
	}
	fclose ( $file );
}


function categorylist() {
	$categs = array ();
	$categn = array ();
	// KATEGÓRIÁK ÖSSZEGYŰJTÉSE
	$dir = opendir ( "media" );
	while ( ($fil = readdir ( $dir )) !== false ) {
		if ((substr ( $fil, strlen ( $fil ) - 4 ) == ".txt") && ($fil != ".") && ($fil != "..")) {
			$n = substr ( $fil, 0, strlen ( $fil ) - 4 );
			array_push ( $categs, $n );
			$file = fopen ( "media/" . $n . ".txt", "r" ) or exit ( "Nincs ilyen kategória." );
			$mc = fgets ( $file );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $categn, $mcdat );
			fclose ( $file );
		}
	}
	?>
	<?php include('templates/fragments/categorylist.php'); ?>
	<?php
}

function medialist($cat) {
	$a_title = array ();
	$a_id = array ();
	$a_file = array ();
	$a_picture = array ();
	$a_text = array ();
	$a_unixdate = array ();

	// load
	
	$dir = opendir ( "media/" . $cat );
	
	while ( ($fil = readdir ( $dir )) !== false ) {
				
		if ((substr ( $fil, strlen ( $fil ) - 4 ) == ".med") && ($fil != ".") && ($fil != "..")) {
			
			array_push ( $a_id, substr ( $fil, 0, strlen ( $fil ) - 4 ) );
			
			$ffile = fopen ( "media/" . $cat . "/" . $fil, "r" ) or exit ( "Nincs ilyen média." );
			$mc = fgets ( $ffile );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $a_title, $mcdat );
			$mc = fgets ( $ffile );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $a_unixdate, getdat ( $mc ) );
			$mc = fgets ( $ffile );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $a_file, $mcdat );
			$mc = fgets ( $ffile );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $a_picture, $mcdat );
			
			$mc = fgets ( $ffile );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $a_text, $mcdat );
			fclose ( $ffile );
		}
	}
	
	$rend = false;
	
	while ( $rend == false ) {
		$rend = true;
		// echo "*";
		
		for($i = 0; $i < count ( $a_unixdate ) - 1; $i ++) {
			// echo $a_unixdate[$i+1] ." ". $a_unixdate[$i];
			if ($a_unixdate [$i + 1] > $a_unixdate [$i]) {
				$rend = false;
				$n_id = $a_id [$i + 1];
				$a_id [$i + 1] = $a_id [$i];
				$a_id [$i] = $n_id;
				$n_title = $a_title [$i + 1];
				$a_title [$i + 1] = $a_title [$i];
				$a_title [$i] = $n_title;
				$n_file = $a_file [$i + 1];
				$a_file [$i + 1] = $a_file [$i];
				$a_file [$i] = $n_file;
				$n_picture = $a_picture [$i + 1];
				$a_picture [$i + 1] = $a_picture [$i];
				$a_picture [$i] = $n_picture;
				$n_text = $a_text [$i + 1];
				$a_text [$i + 1] = $a_text [$i];
				$a_text [$i] = $n_text;
				$n_unixdate = $a_unixdate [$i + 1];
				$a_unixdate [$i + 1] = $a_unixdate [$i];
				$a_unixdate [$i] = $n_unixdate;
			}
		}
	}
	?>
	<?php include ('templates/fragments/medialist.php') ?>
	<?php
}


// CIKK MEGJELENÍTÉSE
function showmedia($cat, $id) {
	?>
	<?php include ('templates/showmedia_control.php');?>
	<?php include ('templates/fragments/showmedia.php'); ?>
	<?php
}


function player($file, $typ) {
	switch ($typ) {
		case 1 :
			?>
			<?php include('templates/fragments/silverlight_player.php'); ?>
			<?php
			break;
		case 2 :
			?>
			<?php include('templates/fragments/wmp_player.php'); ?>
			<?php
			break;
		case 3 :
			?>
			<?php include('templates/fragments/videojs_player.php'); ?>
			<?php
			break;
		case 4 :
			?>
			<?php include('templates/fragments/html5_player.php'); ?>
			<?php
			break;
		default :
			?>
			<p>Nincs lejátszó</p>
			<?php
	}
}