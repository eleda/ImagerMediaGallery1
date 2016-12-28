<?php
if ($npw != "") {
	echo "Most új jelszó jön létre:";
	$file = fopen ( $pwf, "w" );
	echo fwrite ( $file, md5 ( $npw ) );
	echo $npw;
	echo "Új jelszó létrehozva.";
	fclose ( $file );
}

if (file_exists ( $pwf )) {
	$file = fopen ( $pwf, "r" );
	$mcc = fgets ( $file );
	fclose ( $file );
} else {
	echo "Még nincsen jelszó.";
	$picp = 1;
	$meth = "mkpw";
}