	<table width="400" border="0" cellspacing="0" cellpadding="0" class="medlist">
	<?php	
	for($i = 0; $i < count ( $a_title ); $i ++) {		
		$lin = curpurl () . "?view=media&category=" . $cat . "&id=" . $a_id [$i];
		$fullfilename = "media/" . $cat . "/" . $a_file [$i];
		$fsize = filsize ( $fullfilename );
		?>

		<tr>
		  <td width="100">
		    <img src="media/<?php echo $cat;?>/<?php echo $a_picture [$i]; ?>" alt="pict" width="80" height="60"/>
		  </td>
		  <td>
		    <p>
		      <b>
		        <a href="<?php echo $lin; ?>">
		          <img src="images/med.gif" width="15" height="15" border="0"/>
		          <?php echo $a_title [$i]; ?> <?php shownew ( $a_unixdate [$i] ) ?>
		        </a>
		      </b>
		      </br>
		      Dátuma: <?php echo setdat ( filectime ( $fullfilename ) ); ?><br>
		      Feltöltve: <?php echo setdat ( $a_unixdate [$i] ); ?></p>		
		   </td>
		</tr>
		<?php
	}
	?>	
	</table>