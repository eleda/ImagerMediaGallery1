
<?php $car_media = get_all_media(null, 10);  ?>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
  <?php for ($i=0; $i < count($car_media['a_title']); $i++): ?>
    <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" <?php echo $i == 0 ? 'class="active"' : '' ?> ></li>
  <?php endfor; ?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php for ($i=0; $i < count($car_media['a_title']); $i++): ?>
    <?php
        $cat = $car_media['a_cat'][$i];
        $lin = curpurl () . "?view=media&category=" . $cat . "&id=" . $car_media['a_id'][$i];
        $fullfilename = "media/" . $cat . "/" . $car_media['a_file'][$i];
        $fsize = filsize ( $fullfilename );
        $imagefile = 'media/' . $cat . '/' . $car_media['a_picture'][$i];
    ?>

    <div class="item<?php echo (($i == 0) ? ' active' : ""); ?>" >
      <img src="<?php echo $imagefile; ?>" alt="Chania" width="100%">
      <div class="carousel-caption">
          <a href="<?php echo $lin; ?>" title="<?php echo $car_media['a_title'][$i]; ?>">
          <h3><?php echo $car_media['a_title'][$i]; ?></h3>
          <p><?php echo $car_media['a_text'][$i]; ?></p>
          </a>
      </div>
    </div>
    <?php endfor; ?>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>