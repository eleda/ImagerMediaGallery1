<?php $playertype = 4; ?>

<div class="row">
	<div class="col-md-8">
	<?php player ( $data['fullfilename'], $playertype ) ?>
	<h1>
		<?php echo $data['a_title']; ?>
		<?php downloadbutton ( $data['url'] ) ?>
	</h1>
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
		<p class="alert alert-warning war">
		Ha a lejátszó nem jelenik meg, kattintson az URL címre az letöltéshez.
	</p>
	<?php foreach ($data['bottom_text'] as $bottom_text): ?>
		<?php echo $bottom_text; ?>
	<?php endforeach; ?>	
	</div>
	<div class="col-md-4">	
	<div class="row">
    	<?php include('templates/fragments/banner.php'); ?>
	</div>
	<?php medialist ( $cat, true ); ?>	
	<h3>Csatornák</h3>	
	<?php categorylist (); ?>	
	</div>
	</div>