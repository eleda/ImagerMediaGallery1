	<div class="row medlist">
	<?php	
	for($i = 0; $i < count ( $data['a_title'] ); $i ++) {		
		$lin = curpurl () . "?view=media&category=" . $cat . "&id=" . $data['a_id'][$i];
		$fullfilename = "media/" . $cat . "/" . $data['a_file'][$i];
		$fsize = filsize ( $fullfilename );
		?>
		<div class="<?php echo $smallview ? 'col-sm-6' : 'col-sm-3'; ?>">
		  <div class="row" style="padding-left:10px; padding-right:10px;">
		    <img src="media/<?php echo $cat;?>/<?php echo $data['a_picture'][$i]; ?>" alt="pict" class="img-responsive img-thumbnail"/>
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