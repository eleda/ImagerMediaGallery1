<?php
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
?>