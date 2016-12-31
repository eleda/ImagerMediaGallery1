
	<?php include('templates/fragments/banner.php'); ?>
	<h1>
	<?php echo $data['c_title']; ?>
	</h1>
	
	<p><?php echo $data['c_desc']; ?></p>
	
	<?php echo medialist ( $cat, 'col-md-3' ); ?>

