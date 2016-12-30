<div class="row medlist">	
<?php for($i = 0; $i < count ( $data['categs'] ); $i ++): ?>
<?php $lin = curpurl () . "?view=channel&category=" . $data['categs'][$i]; ?>
	<div class="row">
		<p>
			<img src="images/med.gif" width="15" height="15" alt="kezdő bullet"/>
			<a href="<?php echo $lin; ?>"><?php echo $data['categn'][$i]; ?></a>
		</p>
	</div>
<?php endfor; ?>
</div>