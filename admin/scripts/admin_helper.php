<?php

// GET CURRENT URL ROOT
function curURL() {
	$pageURL = 'http';
	$pageURL .= "://";
	if ($_SERVER ["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER ["SERVER_NAME"] . ":" . $_SERVER ["SERVER_PORT"];
	} else {
		$pageURL .= $_SERVER ["SERVER_NAME"];
	}
	$pageURL .= dirname ( $_SERVER ['PHP_SELF'] );
	return $pageURL;
}

// GET CURRENT PHP FILE WITH FULL PATH
function curpurl() {
	return curURL () . '/' . basename ( $_SERVER ['PHP_SELF'] );
}

// /

// VIEW FUNCS


function mkpw() {
	?>
	<form name=form1 method=post action="index.php">
	<input type=text name=npw id=npw>
	<input type=submit name=snd id=snd value="Ok">
	</form>
	<?php
}

function enterpw($p) {
	?>
	<form name=form1 method=post action='index.php'>
	<?php
	if ($p == '') {
		?>
		<p>A feltöltő használatához írja be a jelszót.</p>
		<?php
	} else {
		?>
		<p>Rossz jelszó. Írja be a helyes jelszót.</p>
		<?php
	}
	?>	
	Jelszó
	<input type=password name='pw' id='pw'>
	</label>
	<label>
	<input type=submit name=snd2 id=snd2 value='Bejelentkezés'>
	</label>
	</form>
	<?php
}

function get_methods()
{
	$meths = array ();
	$methn = array ();
	array_push ( $meths, "media" );
	array_push ( $methn, "Feltöltés a médiatárba" );

	$data = array();
	$data['meths'] = $meths;
	$data['methn'] = $methn;
	return $data;
}

function get_files($dir, $ext)
{
	$files = array();
	$dir = opendir ( $dir );
	while ( ($fil = readdir ( $dir )) !== false ) {
		if ((substr ( $fil, strlen ( $fil ) - 4 ) == $ext) && ($fil != '.') && ($fil != '..')) {
			$fin = substr ( $fil, 0, strlen ( $fil ) - 4 );
			array_push ($files, $fin);
		}
	}
	closedir ( $dir );

	$data = array();
	$data['files'] = $files;
	return $data;
}

function get_files_negative($dir, $negext)
{
	$files = array();
	$dir = opendir ( $dir );
	while ( ($fil = readdir ( $dir )) !== false ) {
		if ((substr ( $fil, strlen ( $fil ) - 4 ) != $negext) && ($fil != '.') && ($fil != '..')) {
			$fin = substr ( $fil, 0, strlen ( $fil ) - 4 );
			array_push ($files, $fil);
		}
	}
	closedir ( $dir );
	$data['files'] = $files;
	return $data;
}

function get_images($dir)
{
	$parray = array ();
	
	$direc = $dir;
	$dir = opendir ( $dir );
	
	while ( ($fil = readdir ( $dir )) !== false ) {
		if (($fil != '.') && ($fil != '..') && ($fil != 'banner.jpg')) {
			
			switch (strtolower ( substr ( $fil, strlen ( $fil ) - 4 ) )) {
				case ".jpg" :
				case ".gif" :
				case ".png" :
					
					array_push ( $parray, $fil );
					break;
				default :
			}
		}
	}

	$data = array();
	$data['parray'] = $parray;
	$data['direc'] = $direc;
	return $data;
}

function choosemethod() {
	$menu = get_methods();
	include('templates/fragments/choosemethod.php');			
}


function filecombo($dir, $ext, $id) {
	$data = get_files($dir, $ext);
	include('templates/fragments/filecombo.php');
}


function filesc($dir, $negext, $id) {
	$data = get_files_negative($dir, $negext);
	include('templates/fragments/filesc.php');
}


function images($dir, $id) {			
	$data = get_images($dir);
	include('templates/fragments/images.php');
}


function mediaform() {
	$cat = isset($_POST["kat"]) ? $_POST ["kat"] : "";
	include('templates/fragments/mediaform.php');
}