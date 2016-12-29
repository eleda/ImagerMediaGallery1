<?php $playertype = 4; ?>

<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td valign="top">	
	<h1>
		<img src="images/med.gif" width="15" height="15" border="0"/>
		<!-- kis kepecske -->
		<?php echo $data['a_title']; ?>
		<?php downloadbutton ( $data['url'] ) ?>
	</h1>
	<?php player ( $data['fullfilename'], $playertype ) ?>
	
	<p class='war'>
		Ha a lejátszó nem jelenik meg, kattintson az URL címre az letöltéshez.
	</p>
	
	<p>Kategória: <a href="<?php echo $data['clin']; ?>"><?php echo $data['c_title']; ?></a></br>
	URL: <a href="<?php echo $data['url'];?>"><?php echo $data['url']; ?></a></br>
	Mérete: <?php echo $data['fsize']; ?> ( <?php echo filesize ( $data['fullfilename'] ) ?> bájt)</br>
	Dátuma: <?php echo setdat ( filectime ( $data['fullfilename'] ) ); ?> </br>
	Feltöltve: <?php echo $data['uda']; ?> </br>
	<p></hr></p>
	
	<?php foreach ($data['bottom_text'] as $bottom_text): ?>
		<?php echo $bottom_text; ?>
	<?php endforeach; ?>	
	
	</td>
	<td valign="top">
	
	<h3>Adások</h3>
	
	<?php medialist ( $cat ); ?>
	
	<h3>Csatornák</h3>
	
	<?php categorylist (); ?>
	
	</td>
	</tr>
	</table>