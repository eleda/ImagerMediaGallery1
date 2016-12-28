<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td valign="top">	
	<h1>
		<img src="med.gif" width="15" height="15" border="0"/>
		<!-- kis kepecske -->
		<?php echo $a_title; ?>
		<?php downloadbutton ( $url ) ?>
	</h1>
	<?php player ( $fullfilename, 1 ) ?>
	
	<p class='war'>
		Ha a lejátszó nem jelenik meg, kattintson az URL címre az letöltéshez.
	</p>
	
	<p>Kategória: <a href="<?php echo $clin; ?>"><?php echo $c_title; ?></a></br>
	URL: <a href="<?php echo $url;?>"><?php echo $url; ?></a></br>
	Mérete: <?php echo $fsize ?> ( <?php echo filesize ( $fullfilename ) ?> bájt)</br>
	Dátuma: <?php echo setdat ( filectime ( $fullfilename ) ) ?> </br>
	Feltöltve: <?php echo $uda ?> </br>
	<p></hr></p>
	
	<?php 
	while ( ! feof ( $file ) ) {
		$mc = fgets ( $file );
		$mcdat = substr ( $mc, 0, strlen ( $mc ) - 2 );
		$a_text = $mcdat;
		echo $a_text;
	}
	?>
	
	<?php fclose ( $file ); ?>
	
	</td>
	<td valign="top">
	
	<h3>Adások</h3>
	
	<?php medialist ( $cat ); ?>
	
	<h3>Csatornák</h3>
	
	<?php categorylist (); ?>
	
	</td>
	</tr>
	</table>