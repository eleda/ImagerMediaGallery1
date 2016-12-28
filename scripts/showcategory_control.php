<?php 
	$file = fopen ( "media/" . $cat . ".txt", "r" ) or exit ( "Nincs ilyen kategória." );
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$c_title = $mcdat;
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$c_desc = $mcdat;
?>	