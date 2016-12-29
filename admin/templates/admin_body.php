		<?php
	
		if ($pw == $mcc) {
			$picp = 1;
		} else {
			$picp = 0;
		}
		$picp = 1;
		if ($picp == 1) {
			?>

			<p>Állapota bejelentkezve.
			<form id="lof" name="lof" method="post" action="<?php echo curpurl (); ?>">
			  <label>
			<input type="hidden" name="pw" id="pw" value="*">
			<input type="submit" name="logout" id="logout" value="Kijelentkezés" />
			Nincs Kijelentkezés.
			  </label>
			</form>

			</p>
			
			<?php
			switch ($meth) {
				case "media" :
					mediaform ();
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