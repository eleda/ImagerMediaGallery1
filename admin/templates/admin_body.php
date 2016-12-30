		<?php if ($picp == 1): ?>
			<div class="row">
			<div class="col-sm-3">
				<?php choosemethod ();?>
			</div>
			<div class="col-sm-8">
				<?php switch ($meth) { 
				     case "media" : ?>
					<?php mediaform (); ?>
					<?php break; ?>
				<?php case "mkpw" : ?>
					mkpw ();
					<?php break; ?>
				<?php default : ?>
					<p class="lead">
						Üdvözöllek az Admin felületen! <br>
						Ez egy feltöltőprogram az Imager weboldalhoz.
					</p>
					<p>A folytatáshoz válaszd a <strong>Feltöltés a Médiatárba</strong> lehetőséget.</p>
			<?php } ?>
			</div>
			</div>
		<?php endif; ?>