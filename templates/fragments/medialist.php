	<div class="row medlist">
	<?php
	for($i = 0; $i < count ( $data['a_title'] ); $i ++) {		
		$cat = $data['a_cat'][$i];
		$lin = curpurl () . "?view=media&category=" . $cat . "&id=" . $data['a_id'][$i];
		$fullfilename = "media/" . $cat . "/" . $data['a_file'][$i];
		$fsize = filsize ( $fullfilename );
		$imagefile = 'media/' . $cat . '/' . $data['a_picture'][$i];
		?>
		<div class="<?php echo $bootstrap_coltype; ?>">
		  <div class="row" style="padding-left:10px; padding-right:10px;">
		    <img src="<?php echo $imagefile; ?>" alt="pict" class="img-responsive img-thumbnail"/>
		  </div>
		  <div class="row" style="padding-left:10px; padding-right:10px;">
		    <p>
		      <strong>
		        <a href="<?php echo $lin; ?>">
		          <?php echo $data['a_title'][$i]; ?> 
		          <?php shownew ( $data['a_unixdate'][$i] ) ?>
		        </a>
		      </strong>
		      <div style="font-size:0.9em;">
		      Dátuma: <?php echo setdat ( filectime ( $fullfilename ) ); ?>
		      	<br>
		      Feltöltve: <?php echo setdat ( $data['a_unixdate'][$i] ); ?></p>	
		      </div>
		   </div>
		</div>
		<?php
	}
	?>	
	</div>