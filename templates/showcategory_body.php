
	<h1>
	<img src="med_ind.gif" width="15" height="15" border="0"/>
	<!-- kis kepecske -->
	<?php echo $c_title ?>
	</h1>
	
	<p><?php echo $c_desc; ?></p>
	
	<?php echo medialist ( $cat ) ?>
	
	<?php
	while ( ! feof ( $file ) ) {
		$mc = fgets ( $file );
		$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
		$a_text = $mcdat;
		echo $a_text;
	}
	?>
	
	<?php fclose ( $file ); ?>
