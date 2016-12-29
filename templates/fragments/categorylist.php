<table width="400" class="medlist">	
<?php for($i = 0; $i < count ( $data['categs'] ); $i ++): ?>
<?php $lin = curpurl () . "?view=channel&category=" . $data['categs'][$i]; ?>
	<tr>
		<td>
		<p>
			<img src="images/med.gif" width="15" height="15" border="0"/>
			<a href="<?php echo $lin; ?>"><?php echo $data['categn'][$i]; ?></a>
		</p>
		</td>
	</tr>
<?php endfor; ?>
</table>