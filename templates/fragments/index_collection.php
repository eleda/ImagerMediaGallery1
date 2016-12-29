<table>
   <!-- video CATEGORY -->
   <?php for($i = 0; $i < count ( $data['categs'] ); $i ++): ?>
   <tr>
      <td colspan=4>
         <h3><?php echo $data['categn'][$i]; ?></h3>
         <p><b>Lorem Ipsum Donor</b></p>
      </td>
   </tr>
   <tr>
      <!-- VIDEO -->
      <?php $cat = $data['categs'][$i]; ?>
      <?php $media_data = get_all_media($cat); ?>
      <?php $lin_category = curpurl () . "?view=channel&category=" . $cat; ?>

      <?php for($j = 0; $j < 3; $j ++): ?>
         <?php $id = $media_data['a_id'][$j]; ?>
      <?php 
         $lin = curpurl () . "?view=media&category=" . $cat . "&id=" . $media_data['a_id'][$j];
         $fullfilename = "media/" . $cat . "/" . $media_data['a_file'][$j];
         $fsize = filsize ( $fullfilename );
      ?>
      <td width="350px" height=148 align=center>
         <p>
         <p><a href="<?php echo $lin; ?>"><img src="media/<?php echo $cat;?>/<?php echo $media_data['a_picture'][$j]; ?>" width=120 height=100><br><?php echo $media_data['a_title'][$j];?></a></p>
      </td>
      <?php endfor; ?>
      <td width=30 height=148 align=left>
         <p><b><a href=<?php echo $lin_category; ?>>&gt;&gt;</a></b></p>
      </td>
   </tr>
   <?php endfor; ?>
</table>