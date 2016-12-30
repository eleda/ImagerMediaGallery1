<ul class="nav nav-pills nav-stacked">
<?php for($i = 0; $i < count ( $menu['methn'] ); $i ++): ?>
  <?php $lin = curpurl () . "?method=" . $menu['meths'][$i]; ?>
  <li><a href="<?php echo $lin; ?>"><?php echo $menu['methn'][$i]; ?></a></li>
<?php endfor; ?>			
</ul>


	
	
			