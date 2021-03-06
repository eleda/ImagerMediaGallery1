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

function get_all_category() 
{
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

	$data = array();
	$data['categs'] = $categs;
	$data['categn'] = $categn;

	return $data;
}

function get_category($cat) 
{
	$file = fopen ( "media/" . $cat . ".txt", "r" ) or exit ( "Nincs ilyen kategória." );
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$c_title = $mcdat;
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$c_desc = $mcdat;

	$bottom_text = array();

	while ( ! feof ( $file ) ) {
		$mc = fgets ( $file );
		$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
		$a_text = $mcdat;
		array_push($bottom_text, $a_text);
	}	
	fclose ( $file );

	$data = array();
	$data['bottom_text'] = $bottom_text;
	$data['c_title'] = $c_title;
	$data['c_desc'] = $c_desc;

	return $data;
}

function get_all_media($one_cat, $elems = -1) 
{
	$categories = array();

	if ($one_cat != null) // egy kategoria
	{
		array_push($categories, $one_cat);
	}
	else // mind
	{
		$cats = get_all_category();
		foreach ($cats['categs'] as $curr_cat) {
			array_push($categories, $curr_cat);
		}
	}

	// load
	$a_title = array ();
	$a_id = array ();
	$a_file = array ();
	$a_picture = array ();
	$a_text = array ();
	$a_unixdate = array ();
	$a_cat = array();
	
	$celem = 0;
		foreach ($categories as $cat) {
			$dir = opendir ( "media/" . $cat );
			while ( ($fil = readdir ( $dir )) !== false)  {

				if ($elems > -1 && $celem == $elems) 
				{
					break;
				}
						
				if ((substr ( $fil, strlen ( $fil ) - 4 ) == ".med") && ($fil != ".") && ($fil != "..")) {
					
					array_push( $a_cat, $cat );
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
					
					$celem++;
				}
			}
		}
	
	// az osszeset unix datum szerint rendezi!
	$rend = false;
	
	while ( $rend == false ) {
		$rend = true;
		
		for($i = 0; $i < count ( $a_unixdate ) - 1; $i ++) {
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
				$n_cat = $a_cat [$i + 1];
				$a_cat [$i + 1] = $a_cat [$i];
				$a_cat [$i] = $n_cat;
			}
		}
	}

	$data = array();
	$data['a_title'] = $a_title;
	$data['a_cat'] = $a_cat;
	$data['a_id'] = $a_id;
	$data['a_file'] = $a_file;
	$data['a_picture'] = $a_picture;
	$data['a_text'] = $a_text;
	$data['a_unixdate'] = $a_unixdate;

	return $data;
}

function get_media($cat, $id) 
{
	// GET MEDIA DATA
	$file = fopen ( "media/" . $cat . ".txt", "r" ) or exit ( "Nincs ilyen kategória." );
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$c_title = $mcdat;
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$c_desc = $mcdat;
	fclose ( $file );

	$file = fopen ( "media/" . $cat . "/" . $id . ".med", "r" ) or exit ( "Nincs ilyen cikk." );

	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$a_title = $mcdat;
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$a_date = $mcdat;
	$da = getdat ( $a_date );
	$uda = setdat ( $da );
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$a_file = $mcdat;
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$a_picture = $mcdat;

	$clin = curpurl () . "?view=channel&category=" . $cat;

	$fullfilename = "media/" . $cat . "/" . $a_file;

	$fsize = filsize ( $fullfilename );
	$url = $fullfilename;

	$cururl = curURL();
	// /GET MEDIA DATA


	$bottom_text = array();
	while ( ! feof ( $file ) ) {
		$mc = fgets ( $file );
		$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
		$a_text = $mcdat;
		array_push($bottom_text, $a_text);
	}
	fclose($file);

	$data = array();
	$data['cururl'] = $cururl;
	$data['url'] = $url;
	$data['fsize'] = $fsize;
	$data['fullfilename'] = $fullfilename;
	$data['clin'] = $clin;
	$data['bottom_text'] = $bottom_text;
	$data['a_title'] = $a_title;
	$data['a_date'] = $a_date;
	$data['a_file'] = $a_file;
	$data['a_picture'] = $a_picture;
	$data['c_title'] = $c_title;
	$data['c_desc'] = $c_desc;
	$data['uda'] = $uda;

	return $data;
}


function categorylist() {
	$data = get_all_category();
	?>

	<?php include('templates/fragments/categorylist.php'); ?>
	<?php
}

function medialist($cat, $bootstrap_coltype, $elems = -1) {
	$data = get_all_media($cat, $elems);
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