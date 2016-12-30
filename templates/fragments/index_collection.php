<!-- EGESZ -->
<div class="row">
   <!-- video CATEGORY -->
   <?php for($i = 0; $i < count ( $data['categs'] ); $i ++): ?>
   <!-- CIM -->
   <h2><?php echo $data['categn'][$i]; ?></h2>
   <!-- HAROM LINK -->
   <div class="row">
      <!-- 1. get data -->
      <?php $cat = $data['categs'][$i]; ?>
      <?php $media_data = get_all_media($cat); ?>
      <?php $lin_category = curpurl () . "?view=channel&category=" . $cat; ?>

      <div class="col-sm-11">
      <?php for($j = 0; $j < 3; $j ++): ?>
         <?php $id = $media_data['a_id'][$j]; ?>
         <?php 
            $lin = curpurl () . "?view=media&category=" . $cat . "&id=" . $media_data['a_id'][$j];
            $fullfilename = "media/" . $cat . "/" . $media_data['a_file'][$j];
            $fsize = filsize ( $fullfilename );
         ?>
         <!-- /get data -->
            <div class="col-sm-4">
               <a href="<?php echo $lin; ?>">
               <img src="media/<?php echo $cat;?>/<?php echo $media_data['a_picture'][$j]; ?>" class="img-thumbnail" width="100%" alt="<?php echo $media_data["a_title"];?> képe">
               <br>
               <p><?php echo $media_data['a_title'][$j];?></p>
               </a>
            </div>
      <?php endfor; ?>
      </div>
      <div class="col-sm-1">
         <p><b><a href="<?php echo $lin_category; ?>" class="btn btn-success btn-block"><span class="glyphicon glyphicon-arrow-right" style="font-size: 20px;"></span></a></b></p>
      </div>
      </div>
   </div>
   <?php endfor; ?>
</div>