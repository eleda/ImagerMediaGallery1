	<table width="400" class="medlist">	
	<?php
	for($i = 0; $i < count ( $categs ); $i ++) {
		$lin = curpurl () . "?view=channel&category=" . $categs [$i];
		?>
		<tr>
			<td>
			<p>
				<img src="images/med.gif" width="15" height="15" border="0"/>
				<a href="<?php echo $lin; ?>"><?php echo $categn [$i]; ?></a>
			</p>
			</td>
		</tr>
		<?php
	}	
	?>
	</table>