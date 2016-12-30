<!-- EGESZ -->
<div class="row">
   <!-- video CATEGORY -->
   <?php for($i = 0; $i < count ( $data['categs'] ); $i ++): ?>
   <!-- CIM -->
   <h3><?php echo $data['categn'][$i]; ?></h3>
   <!-- HAROM LINK -->
   <div class="row">
      <!-- 1. get data -->
      <?php $cat = $data['categs'][$i]; ?>
      <?php $media_data = get_all_media($cat); ?>
      <?php $lin_category = curpurl () . "?view=channel&category=" . $cat; ?>

      <div class="col-sm-10">
      <?php for($j = 0; $j < 3; $j ++): ?>
         <?php $id = $media_data['a_id'][$j]; ?>
         <?php 
            $lin = curpurl () . "?view=media&category=" . $cat . "&id=" . $media_data['a_id'][$j];
            $fullfilename = "media/" . $cat . "/" . $media_data['a_file'][$j];
            $fsize = filsize ( $fullfilename );
         ?>
         <!-- /get data -->
            <div class="col-sm-4">
               <p>
               <p><a href="<?php echo $lin; ?>"><img src="media/<?php echo $cat;?>/<?php echo $media_data['a_picture'][$j]; ?>" width="120" height="100" alt="<?php echo $media_data["a_title"];?> képe"><br><?php echo $media_data['a_title'][$j];?></a></p>
            </div>
      <?php endfor; ?>
      <div class="col-sm-2">
         <p><b><a href="<?php echo $lin_category; ?>">&gt;&gt;</a></b></p>
      </div>
      </div>
   </div>
   <?php endfor; ?>
</div>