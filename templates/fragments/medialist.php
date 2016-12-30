	<div class="row medlist">
	<?php	
	for($i = 0; $i < count ( $data['a_title'] ); $i ++) {		
		$lin = curpurl () . "?view=media&category=" . $cat . "&id=" . $data['a_id'][$i];
		$fullfilename = "media/" . $cat . "/" . $data['a_file'][$i];
		$fsize = filsize ( $fullfilename );
		?>
		<div class="row">
		  <div class="col-sm-2">
		    <img src="media/<?php echo $cat;?>/<?php echo $data['a_picture'][$i]; ?>" alt="pict" width="80" height="60"/>
		  </div>
		  <div class="col-sm-10">
		    <p>
		      <strong>
		        <a href="<?php echo $lin; ?>">
		          <img src="images/med.gif" alt="kezdő bullet" width="15" height="15"/>
		          <?php echo $data['a_title'][$i]; ?> 
		          <?php shownew ( $data['a_unixdate'][$i] ) ?>
		        </a>
		      </strong>
		      <br>
		      Dátuma: <?php echo setdat ( filectime ( $fullfilename ) ); ?>
		      	<br>
		      Feltöltve: <?php echo setdat ( $data['a_unixdate'][$i] ); ?></p>	
		   </div>
		</div>
		<?php
	}
	?>	
	</div>