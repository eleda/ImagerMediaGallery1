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

		function pictures($typ, $fold) {
			$dirs = array ();
			$dirn = array ();
			array_push ( $dirs, "news" );
			array_push ( $dirn, "Hírekben" );
			array_push ( $dirs, "downloads" );
			array_push ( $dirn, "Letöltésekben" );
			array_push ( $dirs, "media" );
			array_push ( $dirn, "Médiatárban" );
			array_push ( $dirs, "gallery" );
			array_push ( $dirn, "Galériában" );
			
			if (($typ != "") && ($fold != "")) {
				
				$di = $typ . "/" . $fold;
				$dir = opendir ( $di );
				echo "<h2>Képek:" . $di . "</h2>";
				echo "<p><a href=" . $curpurl . "?method=pictures>&lt;&lt;Gyökér</a></p>";
				
				echo "<table width=500 border=1 cellspacing=0 cellpadding=0>";
				
				while ( ($fil = readdir ( $dir )) !== false ) {
					if (($fil != '.') && ($fil != '..')) {
						
						switch (substr ( $fil, strlen ( $fil ) - 4 )) {
							case ".jpg" :
							case ".gif" :
							case ".png" :
								echo "  <tr>";
								echo "    <td><p>" . $fil . "</p></td>";
								
								echo "    <td width=200><img src=" . $di . "/" . $fil . " width=100 height=75></td>";
								echo "  </tr>";
						}
					}
				}
				echo "</table>";
			} else {
				// HA NINCS TÍPUS MEGJELÖLVE
				echo "<h2>Képek</h2>";
				
				echo "<ul>";
				for($i = 0; $i < count ( $dirs ); $i ++) {
					echo "<li>" . $dirn [$i] . " (" . $dirs [$i] . ")</li>";
					
					$dir = opendir ( $dirs [$i] );
					echo "<ul>";
					
					while ( ($fil = readdir ( $dir )) !== false ) {
						$pon = (substr ( stristr ( $fil, "." ), 0, 1 ) == ".");
						
						if ($pon != 1) {
							
							$lin = $curpurl . "?method=pictures&dir=" . $dirs [$i]		
				 . "&subdir=" . $fil;
							echo "<li><a href=" . $lin . ">" . $fil . "</a></li>";
						}
					}
					
					closedir ( $dir );
					
					echo "</ul>";
				}
				echo "</ul>";
			}
		}

		function choosemethod() {
			$meths = array ();
			$methn = array ();
			//array_push ( $meths, "article" );
			//array_push ( $methn, "Új cikk" );
			//array_push ( $meths, "download" );
			//array_push ( $methn, "Feltöltés a letöltőközpontba" );
			array_push ( $meths, "media" );
			array_push ( $methn, "Feltöltés a médiatárba" );
			//array_push ( $meths, "mail" );
			//array_push ( $methn, "Maxor Levélküldő" );
			
			echo "Kattintson a kívánt műveletre!";
			for($i = 0; $i < count ( $meths ); $i ++) {
				
				$lin = curpurl () . "?method=" . $meths [$i];
				echo "<li><a href=" . $lin . ">" . $methn [$i] . "</a></li>";
			}
		}


		function filecombo($dir, $ext, $id) {
			echo "    <label>Kategória";
			echo "    <select name='" . $id . "' id='" . $id . "'>";
			
			$dir = opendir ( $dir );
			while ( ($fil = readdir ( $dir )) !== false ) {
				if ((substr ( $fil, strlen ( $fil ) - 4 ) == $ext) && ($fil != '.') && ($fil != '..')) {
					$fin = substr ( $fil, 0, strlen ( $fil ) - 4 );
					echo "<option value='" . $fin . "'>" . $fin . "</option>";
				}
			}
			echo "    </select>";
			echo "    </label>";
		}
		function filesc($dir, $negext, $id) {
			echo "    <label>Fájl:";
			echo "    <select name='" . $id . "' id='" . $id . "'>";
			$dir = opendir ( $dir );
			while ( ($fil = readdir ( $dir )) !== false ) {
				if ((substr ( $fil, strlen ( $fil ) - 4 ) != $negext) && ($fil != '.') && ($fil != '..')) {
					$fin = substr ( $fil, 0, strlen ( $fil ) - 4 );
					echo "<option value='" . $fil . "'>" . $fil . "</option>";
				}
			}
			echo "    </select>";
			echo "    </label>";
		}



		

		function images($dir, $id) {
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
			
			// $fin=substr($fil,0,strlen($fil)-4);
			
			echo "    <label>Kép:";
			echo "    <select name='" . $id . "' id='" . $id . "'>";
			
			for($i = 0; $i < count ( $parray ); $i ++) {
				echo "<option value='" . $parray [$i] . "'>" . $parray [$i] . "</option>";
			}
			
			echo "    </select>";
			echo "    </label>";
			echo "</br>";
			
			echo "<table width=700 border=1 cellspacing=0 cellpadding=0>";
			echo "<caption>Választható képek</caption>";
			echo "    <tr>";
			echo "  <td>";
			
			for($i = 0; $i < count ( $parray ); $i ++) {
				$fi = $direc . "/" . $parray [$i];
				echo "<img src='" . $fi . "' alt='" . $fi . "' width='100' height='50'/>";
				echo "&lsaquo; " . $parray [$i];
			}
			
			echo "  </td>";
			echo "    </tr>";
			echo "  </table>";
			
			// $l=curpurl()."?method=pictures&dir=". http://imager.fw.hu/upload.php?method=pictures&dir=news&subdir=maxor
		}

				function galleryform() {
			$gn = $_POST ["gn"];
			$des = $_POST ["des"];
			$picno = $_POST ["picno"];
			
			echo "<h2>Új galéria</h2>";
			
			if ($picno != "") {
				if (($picno > 10) && ($picno < 0)) {
					echo "<p class=info>A feltöltendő képek száma 0 és 10 között lehet!</p>";
					echo "<p><a href=" . $curpurl . "?method=gallery>Újra</a><p>";
				} else {
					echo "<h3>2. lépés: A feltöltendő képek elérési útvonala</h3>";
					echo "<form id='form2' name='form2' enctype='multipart/form-data' method='post' action='uploader.php'>";
					echo "  <label><br />";
					echo "  </label>";
					echo "  <h3>2. Feltöltendő képek elérési útvonala</h3>";
					echo "  <p class=info>Jelölje meg a feltöltendő képeket. A feltöltendő képek legyenek kis formátumúak, ajánlott a 640x480 vagy 800x600 felbontás. Csak JPG formátumú képet lehet feltölteni.</p>";
					
					for($i = 1; $i <= $picno; $i ++) {
						echo "  <label>" . $i . ". kép:";
						echo "  <input type='file' name='p" . $i . "' id='p" . $i . "' />";
						echo "  </label>";
					}
					echo "<input type=hidden name='method' id='method' value='gallery'>";
					echo "<input type=hidden name='gn' id='gn' value='" . $gn . "'>";
					echo "<input type=hidden name='desc' id='desc' value='" . $des . "'>";
					echo "<input type=hidden name='picno' id='picno' value='" . $picno . "'>";
					echo "  <p>";
					echo "    <label>";
					echo "    <input type='submit' name='pup' id='pup' value='Képek feltöltése' />";
					echo "    </label>";
					echo "  </p>";
					echo "</form>";
				}
			} else {
				echo "<h3>1. lépés: Az új galéria neve és leírása</h3>";
				echo "<form id='form1' name='form1' method='post' action='upload.php?method=gallery'>";
				echo "  <label>Galéria címe:";
				echo "  <input name='gn' type='text' id='gn' size='100'   value='" . $gn . "'/>";
				echo "  <br />";
				echo "Galéria leírása:";
				echo "<textarea name='des' id='des' cols='45' rows='5' value='" . $des . "'></textarea>";
				echo "<br />";
				echo "Feltöltendő képek száma:";
				echo "  <input name='picno' type='text' id='picno' value='" . $picno . "' />";
				echo "(Max. 10 db)</label>";
				echo "  <label>";
				echo "  <input type='submit' name='sm' id='sm' value='Frissítés' />";
				echo "  </label>";
				echo "  <p class=info>Csak azután töltse ki a leírási részt, miután pontossan kiválasztotta, hány kép lesz a tárlatban!</p>";
				
				echo "</form>";
			}
		}



		function downloadform() {
			$cat = isset ( $_POST ["kat"] ) ? $_POST ["kat"] : "";
			
			echo "<h2>Új letöltés a Letöltőközpontba</h2>";
			echo "<h3>1. Kategória kiválasztása</h3>";
			
			echo "<form action='upload.php?method=download' method='post' enctype='multipart/form-data' name='form1' id='form1'>";
			//
			filecombo ( "downloads", ".txt", "kat" );
			echo "    <input type='submit' name='ffel' id='ffel' value='Kategóriaváltás' />";
			
			echo "</form>";
			if ($cat == "") {
				echo "<p class='info'>Miután kiválasztotta a kategóriát, kattintson a Tovább gombra.</p>";
			}
			
			if ($cat != "") {
				echo "<h3>2. Fájl feltöltése</h3>";
				echo "<p class='info'> Töltse fel FTP kliens (pl. Total Commander segítségével a fájlt. Miután elkészült kattintson újra a <strong>Kategóriaváltás</strong> gombra!</br>";
				echo "Ahova fel kell tölteni: <strong>downloads/" . $cat . "</strong></b>";
				
				echo "<h3>3. Fontos adatok kitöltése</h3>";
				
				echo "<form action='uploader.php' method='post' enctype='multipart/form-data' name='form1' id='form1'>";
				
				echo "  </p>";
				echo "  <label>Cím";
				echo "  <input type='text' name='cim' id='cim' />";
				echo "  </label>";
				echo "  <p>";
				filesc ( "downloads/" . $cat, ".dow", "ufile" );
				echo "  </p>";
				echo "  <p>";
				images ( "downloads/" . $cat, "kep" );
				// echo "<a href='".$curpurl."?method=pictures"."' target='_blank'>Kép neve...</a></p>" ;
				echo "  </p>";
				echo "  <p>";
				echo "    <label>Részletes leírás";
				echo "    <textarea name='szoveg' id='szoveg' cols='50' rows='10'></textarea>";
				echo "    </label>";
				echo "  </p>";
				echo "  <p class='info'>Mindent kötelező kitölteni! A feltöltendő fájl neve nem tartalmazhat ékezetes betűt!</p>";
				echo "  <p>";
				echo "    <label>";
				echo "<input type=hidden name='method' id='method' value='download'>";
				echo "<input type=hidden name='kat' id='kat' value='" . $cat . "'>";
				echo "    <input type='submit' name='fel' id='fel' value='Feltöltés!' />";
				echo "    </label>";
				echo "    <br />";
				echo "        </p>";
				echo "</form>";
			}
		}

			function mediaform() {			

			$cat = isset($_POST["kat"]) ? $_POST ["kat"] : "";
			
			echo "<h2>Új elem a médiatárba</h2>";
			echo "<h3>1. Kategória kiválasztása</h3>";
			
			echo "<form action='index.php?method=media' method='post' enctype='multipart/form-data' name='form1' id='form1'>";
			//
			filecombo ( "../media", ".txt", "kat" );
			echo "    <input type='submit' name='ffel' id='ffel' value='Kategóriaváltás' />";
			
			echo "</form>";
			if ($cat == "") {
				echo "<p class='info'>Miután kiválasztotta a kategóriát, kattintson a Tovább gombra.</p>";
			}
			
			if ($cat != "") {
				echo "<h3>2. Fájl feltöltése</h3>";
				echo "<p class='info'> Töltse fel FTP kliens (pl. Total Commander segítségével a fájlt. Miután elkészült kattintson újra a <strong>Kategóriaváltás</strong> gombra!</br>";
				echo "Ahova fel kell tölteni: <strong>media/" . $cat . "</strong></b>";
				
				echo "<h3>3. Fontos adatok kitöltése</h3>";
				
				echo "<form action='uploader.php' method='post' enctype='multipart/form-data' name='form1' id='form1'>";
				
				echo "  </p>";
				echo "  <label>Cím";
				echo "  <input type='text' name='cim' id='cim' />";
				echo "  </label>";
				echo "  <p>";
				filesc ( "../media/" . $cat, ".med", "ufile" );
				echo "  </p>";
				echo "  <p>";
				images ( "../media/" . $cat, "kep" );
				// echo "<a href='".$curpurl."?method=pictures"."' target='_blank'>Kép neve...</a></p>" ;
				echo "  </p>";
				echo "  <p>";
				echo "    <label>Részletes leírás";
				echo "    <textarea name='szoveg' id='szoveg' cols='50' rows='10'></textarea>";
				echo "    </label>";
				echo "  </p>";
				echo "  <p class='info'>Mindent kötelező kitölteni! A feltöltendő fájl neve nem tartalmazhat ékezetes betűt!</p>";
				echo "  <p>";
				echo "    <label>";
				echo "<input type=hidden name='method' id='method' value='media'>";
				echo "<input type=hidden name='kat' id='kat' value='" . $cat . "'>";
				echo "    <input type='submit' name='fel' id='fel' value='Feltöltés!' />";
				echo "    </label>";
				echo "    <br />";
				echo "        </p>";
				echo "</form>";
			}
		}


	
		function articleform() {
			$cat = isset ( $_POST ["kat"] ) ? $_POST ["kat"] : "";
			
			echo "<h2>Hír feltöltése</h2>";
			
			echo "<form action='upload.php?method=article' method='post' enctype='multipart/form-data' name='form1' id='form1'>";
			//
			filecombo ( "news", ".txt", "kat" );
			echo "    <input type='submit' name='ffel' id='ffel' value='Kategóriaváltás' />";
			
			echo "</form>";
			if ($cat == "") {
				echo "<p class='info'>Miután kiválasztotta a kategóriát, kattintson a Tovább gombra.</p>";
			}
			
			if ($cat != "") {
				
				echo "<form id='form1' name='form1' method='post' action='uploader.php'>";
				// echo " <label>Fájlnév (kiterjesztés nélkül)</label>";
				// echo " <input type='text' name='fajl' id='fajl'/>";
				// echo " <br />";
				echo "  <label>Hír címe</label>";
				echo "  <input type='text' name='cim' id='cim'/>";
				echo "  </label>";
				
				echo "  <p>";
				echo "    <label>Szerző:";
				echo "    <input type='text' name='szerzo' id='szerzo' />";
				echo "    </label>";
				echo "  </p>";
				
				images ( "news/" . $cat, "kep" );
				
				// echo " <p>";
				// echo " <label>Kép neve:";
				// echo " <input type='text' name='kep' id='kep' />";
				// echo " </label>";
				// echo "<a href='".$curpurl."?method=pictures"."' target='_blank'>Kép neve...</a></p>" ;
				// echo " </p>";
				
				echo "  <p>";
				echo "    <label>Szöveg";
				echo "    <textarea name='szoveg' id='szoveg' cols='100' rows='15'></textarea>";
				echo "    </label>";
				echo "  </p>";
				echo "  <p>Mindent kötelező kitölteni.</p>";
				echo "  <p>";
				echo "    <label>";
				echo "<input type=hidden name='method' id='method' value='article'>";
				echo "<input type=hidden name='kat' id='kat' value='" . $cat . "'>";
				echo "    <input type='submit' name='ok' id='ok' value='Feltöltés!' />";
				echo "    </label>";
				echo "  </p>";
				echo "  <p>&nbsp;</p>";
				echo "</form>";
			}
		}