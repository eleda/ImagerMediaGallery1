<?php
// #### HELPER FUNCTIONS ####
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

// NULL PREFIX FOR NUMBERS
function dupnum($nu) {
	if (strlen ( $nu ) == 1) {
		return "0" . $nu;
	}
}
// SET DATE
function setdat($dat) // paraméter: unix timestamp
{
	return idate ( "Y", $dat ) . "." . idate ( "m", $dat ) . "." . idate ( "d", $dat ) . ". " . idate ( "H", $dat ) . ":" . idate ( "i", $dat ) . ":" . idate ( "s", $dat );
}
// IS A NEW CONTENT?
function isnew($dat) // paraméter: unix timestamp
{
	// echo $dat-time();
	if (time () - $dat <= 1000000) {
		return true;
	} else {
		return false;
	}
}
// ############# BUILDER FUNCTIONS #############
// SHOW "NEW!!" SPAN.
function shownew($dat) {
	if (isnew ( $dat ) == true) {
		echo "<img src='" . curURL () . "/uj.png' border=0/>"; // kis kepecske
		// echo "új!";
	}
}

function GetCategories($datatype) 
{
	$categories = array();
	
	$extension = "";
	$directory = "";
	$name = "";
	$url_view_cat = "";
	$url_view_art = "";
	$url_phpfile = "index";
	
	switch ($datatype) {
		case 0 :
			$extension = ".txt";
			$directory = "news";
			$name = "Hírek";
			$url_view_cat = "articles";
			$url_view_art = "article";
			$url_phpfile = "index";
			break;
		case 1 :
			$extension = ".med";
			$directory = "media";
			$name = "Videók";
			$url_view_cat = "channel";
			$url_view_art = "media";
			$url_phpfile = "media";
			break;
		case 2 :
			$extension = ".dow";
			$directory = "downloads";
			$name = "Letöltések";
			$url_view_cat = "downloads";
			$url_view_art = "download";
			$url_phpfile = "downloads";
			break;
	}	
		
	$category = array();
	
	// KATEGÓRIÁK ÖSSZEGYŰJTÉSE
	$dir = opendir ( $directory );
	while ( ($fil = readdir ( $dir )) !== false ) {	
		if ((substr ( $fil, strlen ( $fil ) - 4 ) == ".txt") && ($fil != ".") && ($fil != "..")) {
			$n = substr ( $fil, 0, strlen ( $fil ) - 4 );
			$file = fopen ( $directory . "/" . $n . ".txt", "r" ) or exit ( "Nincs ilyen kategória." );
			$mc = fgets ( $file );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			fclose ( $file );
			$category["categurl"] = $n;
			$category["categname"] = $mcdat;
			array_push($categories, $category);
		}
	}
	return $categories;	
}



function GetNewestArticles($datatype, $catfoldername) 
{
	
	
	$categories = GetCategories($datatype);
	

	$extension = "";
	$directory = "";
	$name = "";
	$url_view_cat = "";
	$url_view_art = "";
	$url_phpfile = "index";
	
	switch ($datatype) {
		case 0 :
			$extension = ".txt";
			$directory = "news";
			$name = "Hírek";
			$url_view_cat = "articles";
			$url_view_art = "article";
			$url_phpfile = "index";
			break;
		case 1 :
			$extension = ".med";
			$directory = "media";
			$name = "Videók";
			$url_view_cat = "channel";
			$url_view_art = "media";
			$url_phpfile = "media";
			break;
		case 2 :
			$extension = ".dow";
			$directory = "downloads";
			$name = "Letöltések";
			$url_view_cat = "downloads";
			$url_view_art = "download";
			$url_phpfile = "downloads";
			break;
	}
	
	// one or all categs.
	if($catfoldername == "") // all categs 
	{
		$cats = $categories;
	} else  // one categ
	{
		foreach($categories as $category) {
			if ($category["categurl"] == $catfoldername) {
				$cats = array($category);
			}
		}
	}
	
	// collect all articles
	$articles = array();
	foreach($cats as $cat) {
		$article = array();
		
		$dir = opendir ( $directory . "/" . $cat["categurl"] );	
		
		while ( ($fil = readdir ( $dir )) !== false ) {
		
			if ((substr ( $fil, strlen ( $fil ) - 4 ) == $extension) && ($fil != ".") && ($fil != "..")) {
		
				$file = fopen ( $directory . "/" . $cat["categurl"] . "/" . $fil, "r" ) or exit ( "Nincs ilyen fájl." );
				
				
				$n = substr ( $fil, 0, strlen ( $fil ) - 4 );
				// array_push ( $nid, $n );
				$article["nid"] = $n;
				
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				// array_push ( $nt, $mcdat );
				$article["nt"] = $mcdat;
				
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				// array_push ( $nd, getdat ( $mc ) );
				$article["nd"] = getdat($mc);
				
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				// array_push ( $np, $mcdat );
				$article["np"] = $mcdat;
		
				fclose ( $file );				
				
				
				$article["imgsrc"] = $directory . "/" . $cat["categurl"] . "/" . $article["np"][0];
				$article["lz"] = curURL () . '/' . $url_phpfile . ".php?view=" . $url_view_art . "&category=" . $cat["categurl"] . "&id=" . $article["nid"][0];
							
				
				array_push ($articles, $article);
	}
		}
	}
		
	// RENDEZÉS A DÁTUM SZERINTI CSÖKKENŐ SORRENDBEN
	$rend = false;
	
	while ( $rend == false ) {
		$rend = true;		
		for($j = 0; $j < count ( $articles ) - 1; $j ++) {
			if ($articles[$j + 1]["nd"] > $articles[$j]["nd"]) {
				$rend = false;
				$nnd = $articles[$j + 1];
				$articles[$j + 1] = $articles[$j];
				$articles[$j] = $nnd;
			}
		}
	}	
		
	return $articles;
}


// DÁTUM FÜGGVÉNYEK VÉGE.
function newsbox($datatype, $alignment) {
	$extension = "";
	$directory = "";
	$name = "";
	$url_view_cat = "";
	$url_view_art = "";
	$url_phpfile = "index";

	// echo "Ez az adat kerül ide:". $datatype;
	switch ($datatype) {
		case 0 :
			$extension = ".txt";
			$directory = "news";
			$name = "Hírek";
			$url_view_cat = "articles";
			$url_view_art = "article";
			$url_phpfile = "index";
			break;
		case 1 :
			$extension = ".med";
			$directory = "media";
			$name = "Videók";
			$url_view_cat = "channel";
			$url_view_art = "media";
			$url_phpfile = "media";
			break;
		case 2 :
			$extension = ".dow";
			$directory = "downloads";
			$name = "Letöltések";
			$url_view_cat = "downloads";
			$url_view_art = "download";
			$url_phpfile = "downloads";
			break;
	}

	echo "<div>";
	echo "<h2>" . $name . "</h2>";

	// HIREK/////////////////////////////////////////////////////
	$categs = array ();
	$categn = array ();

	// KATEGÓRIÁK ÖSSZEGYŰJTÉSE
	$dir = opendir ( $directory );
	while ( ($fil = readdir ( $dir )) !== false ) {

		if ((substr ( $fil, strlen ( $fil ) - 4 ) == ".txt") && ($fil != ".") && ($fil != "..")) {
			$n = substr ( $fil, 0, strlen ( $fil ) - 4 );
			array_push ( $categs, $n );
			$file = fopen ( $directory . "/" . $n . ".txt", "r" ) or exit ( "Nincs ilyen kategória." );
			$mc = fgets ( $file );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $categn, $mcdat );
			fclose ( $file );
		}
	}

	echo "<div class='lis'>";

	// /KATEGÓRIÁN KÍVÜL ÖSSZES ELEM KIIRATÁSA
	for($i = 0; $i < count ( $categs ); $i ++) {
		$nid = array ();
		$nt = array ();
		$nd = array ();
		$np = array ();

		$dir = opendir ( $directory . "/" . $categs [$i] );
		while ( ($fil = readdir ( $dir )) !== false ) {
				
			if ((substr ( $fil, strlen ( $fil ) - 4 ) == $extension) && ($fil != ".") && ($fil != "..")) {

				$file = fopen ( $directory . "/" . $categs [$i] . "/" . $fil, "r" ) or exit ( "Nincs ilyen fájl." );

				$n = substr ( $fil, 0, strlen ( $fil ) - 4 );
				array_push ( $nid, $n );

				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				array_push ( $nt, $mcdat );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				array_push ( $nd, getdat ( $mc ) );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				array_push ( $np, $mcdat );

				fclose ( $file );
			}
		}
		// RENDEZÉS A DÁTUM SZERINTI CSÖKKENŐ SORRENDBEN
		$rend = false;

		while ( $rend == false ) {
			$rend = true;
				
			for($j = 0; $j < count ( $nd ) - 1; $j ++) {
				if ($nd [$j + 1] > $nd [$j]) {
					$rend = false;
					$nnid = $nid [$j + 1];
					$nid [$j + 1] = $nid [$j];
					$nid [$j] = $nnid;
					$nnt = $nt [$j + 1];
					$nt [$j + 1] = $nt [$j];
					$nt [$j] = $nnt;
					$nnp = $np [$j + 1];
					$np [$j + 1] = $np [$j];
					$np [$j] = $nnp;
					$nnd = $nd [$j + 1];
					$nd [$j + 1] = $nd [$j];
					$nd [$j] = $nnd;
				}
			}
		}

		echo "<div class='lisle'>";

		echo "<img src='" . $directory . "/" . $categs [$i] . "/" . $np [0] . "' alt='6' width='68' height='58' class=indpic align='left' />";
		echo "</div>";

		$lz = curURL () . '/' . $url_phpfile . ".php?view=" . $url_view_art . "&category=" . $categs [$i] . "&id=" . $nid [0];
		echo "<div class='lisri'>";
		echo "<a href=" . $lz . "><h3>" . $nt [0] . " ";
		shownew ( $nd [0] );
		echo "</a></h3>";

		$c = 3;
		if (count ( $nid ) < 3) {
			$c = count ( $nid );
		} else {
			$c = 3;
		}
		echo "<p>";
		for($j = 1; $j < $c; $j ++) {
			$lz = curURL () . "/" . $url_phpfile . ".php?view=" . $url_view_art . "&category=" . $categs [$i] . "&id=" . $nid [$j];
			echo "<a href=" . $lz . ">" . $nt [$j] . " ";
			shownew ( $nd [$j] );
			echo "</a></br>";
		}
		echo "</p>";
		$lc = curURL () . "/" . $url_phpfile . ".php?view=" . $url_view_cat . "&category=" . $categs [$i];
		echo "          <p><i><a href=" . $lc . ">" . $categn [$i] . "</a></i></p>";
		echo "</div>";
	}
	// ////////////HIR LISTA VÉGE

	echo "</div>";

	echo "    <p>&nbsp;</p>";

	echo "</div>";
}

function GetCategory($cat) 
{
	$category = array();
		
	$file = fopen ( "news/" . $cat . ".txt", "r" ) or exit ( "Nincs ilyen kategória." );
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$c_title = $mcdat;
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$c_desc = $mcdat;
	fclose ( $file );
	
	$a_title = array ();
	$a_id = array ();
	$a_author = array ();
	$a_picture = array ();
	$a_text = array ();
	$a_unixdate = array ();
	
	//echo "<h1>" . $c_title . "</h1>";
	//echo "<p>" . $c_desc . "</p>";
	
	$dir = opendir ( "news/" . $cat );
	
	while ( ($fil = readdir ( $dir )) !== false ) {
	
		if ((substr ( $fil, strlen ( $fil ) - 4 ) == ".txt") && ($fil != ".") && ($fil != "..")) {
			array_push ( $a_id, substr ( $fil, 0, strlen ( $fil ) - 4 ) );
			$file = fopen ( "news/" . $cat . "/" . $fil, "r" ) or exit ( "Nincs ilyen cikk." );
			$mc = fgets ( $file );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $a_title, $mcdat );
			$mc = fgets ( $file );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $a_unixdate, getdat ( $mc ) );
			$mc = fgets ( $file );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $a_author, $mcdat );
			$mc = fgets ( $file );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $a_picture, $mcdat );
			$mc = fgets ( $file );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $a_text, $mcdat );
			fclose ( $file );
		}
	}
	
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
				$n_author = $a_author [$i + 1];
				$a_author [$i + 1] = $a_author [$i];
				$a_author [$i] = $n_author;
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
	
	$category["cat"] = $cat;
	$category["c_title"] = $c_title;
	$category["c_desc"] = $c_desc;
	$category["a_id"] = $a_id;
	$category["a_title"] = $a_title;
	$category["a_picture"] = $a_picture;
	$category["a_unixdate"] = $a_unixdate;
	
	return $category;
}

// SHOW A CATEGORY LIST
function showcategory($cat) {
	$file = fopen ( "news/" . $cat . ".txt", "r" ) or exit ( "Nincs ilyen kategória." );
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$c_title = $mcdat;
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$c_desc = $mcdat;
	fclose ( $file );

	$a_title = array ();
	$a_id = array ();
	$a_author = array ();
	$a_picture = array ();
	$a_text = array ();
	$a_unixdate = array ();

	echo "<h1>" . $c_title . "</h1>";
	echo "<p>" . $c_desc . "</p>";

	$dir = opendir ( "news/" . $cat );

	while ( ($fil = readdir ( $dir )) !== false ) {

		if ((substr ( $fil, strlen ( $fil ) - 4 ) == ".txt") && ($fil != ".") && ($fil != "..")) {
			array_push ( $a_id, substr ( $fil, 0, strlen ( $fil ) - 4 ) );
			$file = fopen ( "news/" . $cat . "/" . $fil, "r" ) or exit ( "Nincs ilyen cikk." );
			$mc = fgets ( $file );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $a_title, $mcdat );
			$mc = fgets ( $file );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $a_unixdate, getdat ( $mc ) );
			$mc = fgets ( $file );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $a_author, $mcdat );
			$mc = fgets ( $file );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $a_picture, $mcdat );
			$mc = fgets ( $file );
			$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
			array_push ( $a_text, $mcdat );
			fclose ( $file );
		}
	}

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
				$n_author = $a_author [$i + 1];
				$a_author [$i + 1] = $a_author [$i];
				$a_author [$i] = $n_author;
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

	echo "<div class='lis'>";

	for($i = 0; $i < count ( $a_title ); $i ++) {
		$lin = curpurl () . "?view=article&category=" . $cat . "&id=" . $a_id [$i];
		echo "<div class='lisle'>";
		echo "<img src=news/" . $cat . "/" . $a_picture [$i] . " alt=pict width=80 height=60/>";
		echo "</div>";
		echo "<div>";
		echo "<h2><a href=" . $lin . ">" . $a_title [$i] . "</a></h2>";
		echo "    <p>" . "Hír készült: " . setdat ( $a_unixdate [$i] ) . "</p>";
		echo "</div>";
	}

	echo "</div>";
}
function GetArticle($cat, $id) 
{
	$article = array();
	
	// get $mcdat, c_desc
	$file = fopen ( "news/" . $cat . ".txt", "r" ) or exit ( "Nincs ilyen kategória." );
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$c_title = $mcdat;
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$c_desc = $mcdat;
	fclose ( $file );
	
	// get a_title, a_date, a_picture
	$file = fopen ( "news/" . $cat . "/" . $id . ".txt", "r" ) or exit ( "Nincs ilyen cikk." );
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
	$a_author = $mcdat;
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$a_picture = $mcdat;
	
	$clin = curpurl () . "?view=articles&category=" . $cat;
	$a_text = "";
	while ( ! feof ( $file ) ) {
		$mc = fgets ( $file );
		$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
		$a_text .= $mcdat;
		//echo $a_text;
	}
	
	fclose ( $file );
	
	// $a_title, $uda, $clin, $c_title, $a_author, $a_text
	$article["a_title"] = $a_title;
	$article["uda"] = $uda;
	$article["clin"] = $clin;
	$article["c_title"] = $c_title;
	$article["a_author"] = $a_author;
	$article["a_text"] = $a_text;
	
	return $article;
}
// CIKK MEGJELENÍTÉSE
function showarticle($cat, $id) {

	$file = fopen ( "news/" . $cat . ".txt", "r" ) or exit ( "Nincs ilyen kategória." );
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$c_title = $mcdat;
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$c_desc = $mcdat;
	fclose ( $file );

	$file = fopen ( "news/" . $cat . "/" . $id . ".txt", "r" ) or exit ( "Nincs ilyen cikk." );
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
	$a_author = $mcdat;
	$mc = fgets ( $file );
	$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
	$a_picture = $mcdat;

	$clin = curpurl () . "?view=articles&category=" . $cat;
	echo "<h1>" . $a_title . "</h1>";
	echo "<p>" . $uda . "<br />";
	echo "  kategória: <a href=" . $clin . ">" . $c_title . "</a> | szerző: " . $a_author . "</p>";
	echo "<p class='tex'>";
	while ( ! feof ( $file ) ) {
		$mc = fgets ( $file );
		$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
		$a_text = $mcdat;
		echo $a_text;
	}
	echo "</p>";

	fclose ( $file );

	echo $a_text;
}

function GetMenuData() 
{

	$menu = array();
	
	$dir = opendir ( getcwd () );
	$file = fopen ( "menuitems.txt", "r" ) or exit ( "A navigációs menüt nem sikerült létrehozni" );
	$iname = array ();
	$ipage = array ();
	$itype = array ();
	$mc = fgets ( $file );
	while ( ! feof ( $file ) ) {
		$mc = fgets ( $file );
		$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
		$mcdata = substr ( $mcdat, 2 );
		switch ($mcdat) {
			case "[item]" :
				array_push ( $itype, 0 );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $iname, $mcdata );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $ipage, $mcdata );
				break;
			case "[articles]" :
				array_push ( $itype, 3 );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $iname, $mcdata );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $ipage, $mcdata );
				break;
			case "[dcenter]" :
				array_push ( $itype, 4 );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $iname, $mcdata );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $ipage, $mcdata );
				break;
			case "[mcenter]" :
				array_push ( $itype, 5 );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $iname, $mcdata );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $ipage, $mcdata );
				break;
			case "[wholepage]" :
				array_push ( $itype, 2 );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $iname, $mcdata );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $ipage, $mcdata );
				break;
			case "[header]" :
				array_push ( $itype, 1 );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $iname, $mcdata );
				array_push ( $ipage, "#" );
				break;
		}
	}
	fclose ( $file );
	
	
	// build the menu
	
	$menuopened = false;
	// build menu
	// whole menubar
	// $menubar -> menus -> menu -> menuitems
	$menubar = array ();
	$menubar ["menus"] = array ();
	// one menu
	$menu = array ();
	$menu ["title"] = "(unnamed)";
	$menu ["menuitems"] = array ();
	
	for($i = 0; $i < count ( $iname ); $i ++) {
		if ($itype [$i] > 1) { // add new element	
			// one menu item
			$menuitem = array ();
			switch ($itype [$i]) {
				case 0 :
					$lin = curpurl () . "?page=" . $ipage [$i];
					break;
				case 2 :
					$lin = curURL () . "/" . $ipage [$i];
					break;
				case 3 :
					$lin = curpurl () . "?view=articles&category=" . $ipage [$i];
					break;
				case 4 :
					$lin = curURL () . "/" . "downloads.php?view=downloads&category=" . $ipage [$i];
					break;
				case 5 :
					$lin = curURL () . "/" . "media.php?view=channel&category=" . $ipage [$i];
					break;
			}
			$menuitem ["title"] = $iname [$i];
			$menuitem ["a"] = $lin;
			array_push($menu ["menuitems"], $menuitem);
		} else if ($itype [$i] === 1) { // another menu
			    array_push($menubar ["menus"], $menu);
				$menuopened = false;
			// new menu
			$menu = array ();
			$menu ["title"] = $iname [$i];
			$menu ["menuitems"] = array ();
		}
	}
	
		array_push($menubar ["menus"], $menu);
		$menuopened = false;
	
	return $menubar;
	
}

// SHOW MENU ON THE LEFT SIDE
function showmenu() {

	$dir = opendir ( getcwd () );
	$file = fopen ( "menuitems.txt", "r" ) or exit ( "A navigációs menüt nem sikerült létrehozni" );
	$iname = array ();
	$ipage = array ();
	$itype = array ();
	$mc = fgets ( $file );
	while ( ! feof ( $file ) ) {
		$mc = fgets ( $file );
		$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
		$mcdata = substr ( $mcdat, 2 );
		switch ($mcdat) {
			case "[item]" :
				array_push ( $itype, 0 );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $iname, $mcdata );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $ipage, $mcdata );
				break;
			case "[articles]" :
				array_push ( $itype, 3 );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $iname, $mcdata );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $ipage, $mcdata );
				break;
			case "[dcenter]" :
				array_push ( $itype, 4 );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $iname, $mcdata );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $ipage, $mcdata );
				break;
			case "[mcenter]" :
				array_push ( $itype, 5 );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $iname, $mcdata );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $ipage, $mcdata );
				break;
			case "[wholepage]" :
				array_push ( $itype, 2 );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $iname, $mcdata );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $ipage, $mcdata );
				break;
			case "[header]" :
				array_push ( $itype, 1 );
				$mc = fgets ( $file );
				$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
				$mcdata = substr ( $mcdat, 2 );
				array_push ( $iname, $mcdata );
				array_push ( $ipage, "#" );
				break;
		}
	}
	fclose ( $file );

	// MENÜ KIRAJZOLÁSA
	echo "<div class='lb'>";
	for($i = 0; $i < count ( $iname ); $i ++) {
		echo "  <div>";
		switch ($itype [$i]) {
			case 0 :
				echo "    <div height='25' class='mnuitem'>";
				$lin = curpurl () . "?page=" . $ipage [$i];
				echo "<a href=" . $lin . ">";
				echo $iname [$i];
				echo "</a>";
				break;
			case 2 :
				echo "    <div height='25' class='mnuitem'>";
				$lin = curURL () . "/" . $ipage [$i];
				echo "<a href='" . $lin . "' target='_top'>";
				echo $iname [$i];
				echo "</a>";
				break;
					
			case 3 :
				echo "    <div height='25' class='mnuitem'>";
				$lin = curpurl () . "?view=articles&category=" . $ipage [$i];
				echo "<a href='" . $lin . "'>";
				echo $iname [$i];
				echo "</a>";
				break;
			case 4 :
				echo "    <div height='25' class='mnuitem'>";
				$lin = curURL () . "/" . "downloads.php?view=downloads&category=" . $ipage [$i];
				echo "<a href='" . $lin . "'>";
				echo $iname [$i];
				echo "</a>";
				break;
			case 5 :
				echo "    <div height='25' class='mnuitem'>";
				$lin = curURL () . "/" . "media.php?view=channel&category=" . $ipage [$i];
				echo "<a href='" . $lin . "'>";
				echo $iname [$i];
				echo "</a>";
				break;
			case 1 :
				echo "    <div height='25' class='mnuheader'>";
				echo $iname [$i];
				break;
		}
		echo "</div>";
		echo "  </div>";
	}
	echo "  <div>";
	echo "   <div height=100% valign='top'>";
	include ("aftermenu.html");
	echo "</div>";
	echo "  </div>";
	echo "</div>";
	
	
	
}



?>
