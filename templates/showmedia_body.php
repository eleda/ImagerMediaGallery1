<?php $playertype = 4; ?>

<div class="row">
	<div class="col-md-8">
	<h1>
		<?php echo $data['a_title']; ?>
		<?php downloadbutton ( $data['url'] ) ?>
	</h1>
	<?php player ( $data['fullfilename'], $playertype ) ?>
	
	<p class="alert alert-warning war">
		Ha a lejátszó nem jelenik meg, kattintson az URL címre az letöltéshez.
	</p>
	
	<p>Kategória: <a href="<?php echo $data['clin']; ?>"><?php echo $data['c_title']; ?></a>
	<br>
	URL: <a href="<?php echo $data['url'];?>"><?php echo $data['url']; ?></a>
	<br>
	Mérete: <?php echo $data['fsize']; ?> ( <?php echo filesize ( $data['fullfilename'] ) ?> bájt)
	<br>
	Dátuma: <?php echo setdat ( filectime ( $data['fullfilename'] ) ); ?>
	<br>
	Feltöltve: <?php echo $data['uda']; ?>
	<br>
	<hr>	
	<?php foreach ($data['bottom_text'] as $bottom_text): ?>
		<?php echo $bottom_text; ?>
	<?php endforeach; ?>	
	
	</div>
	<div class="col-md-4">	
	<h3>Adások</h3>	
	<?php medialist ( $cat ); ?>	
	<h3>Csatornák</h3>	
	<?php categorylist (); ?>	
	</div>
	</div>