

	    <!-- SWITCH -->
		<?php

		switch ($view) {
			case "media" :
				$cat = $art_cat;
				$id = $art_file;
				include ('scripts/showmedia_control.php');
				include('templates/showmedia_body.php');
				// showmedia ( $art_cat, $art_file );
				break;
			case "channel" :
				$cat = $art_cat;
				include('scripts/showcategory_control.php');
				include('templates/showcategory_body.php');
				// showcategory ( $art_cat );
				break;
			default :
				 if (isset($_GET["page"])) :
				   if (file_exists ( $_GET ["page"] )):
						include ($_GET ["page"]);
					endif;
     			  else:
					$data = get_all_category();

					include('templates/index_frame.php');

				  endif;
		 }		
		?>
		<!-- /SWITCH -->

