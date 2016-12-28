		<?php
		// echo $picp;
		
		if ($pw == $mcc) {
			$picp = 1;
		} else {
			$picp = 0;
		}
		$picp = 1;
		if ($picp == 1) {
			
			// setcookie("pw", md5($pw), time()+3600);
			
			echo "<p>Állapota bejelentkezve.";
			
			echo "<form id=lof name=lof method=post action=" . curpurl () . ">";
			echo "  <label>";
			echo "<input type=hidden name='pw' id='pw' value='*'>";
			echo "<input type=submit name=logout id=logout value=Kijelentkezés />";
			echo "  </label>";
			echo "</form></p>";
			
			switch ($meth) {
				case "article" :
					articleform ();
					break;
				case "pictures" :
					$fol = $_GET ["dir"];
					$sfol = $_GET ["subdir"];
					pictures ( $fol, $sfol );
					break;
				case "download" :
					downloadform ();
					break;
				case "media" :
					mediaform ();
					break;
				case "gallery" :
					galleryform ();
					break;
				case "mkpw" :
					mkpw ();
					break;
				default :
					choosemethod ();
			}
		} else {
			?><p>Ön most ki van jelentkezve.</p>
			<?php			
			enterpw ( $pw );
		}