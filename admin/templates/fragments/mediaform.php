<h2>Új elem a médiatárba</h2>
<h3>1. Kategória kiválasztása</h3>
<form action='index.php?method=media' method='post' enctype='multipart/form-data' name='form1' id='form1' class="form-inline">
   <?php filecombo ( "../media", ".txt", "kat" ); ?>
   <input type='submit' name='ffel' id='ffel' value='Kategóriaváltás' class="btn btn-success" />
</form>
<?php if ($cat == ""): ?>
   <br>
<div class="alert alert-info info">
<p>Miután kiválasztotta a kategóriát, kattintson a Tovább gombra.</p>   
</div>
<?php endif; ?>
<?php if ($cat != ""): ?>
<h3>2. Fájl feltöltése</h3>
<div class="alert alert-info info"> 
   <p>Töltse fel FTP kliens (pl. Total Commander segítségével a fájlt. Miután elkészült kattintson újra a <strong>Kategóriaváltás</strong> gombra!</br>
      Ahova fel kell tölteni: <strong>media/<?= $cat ?></strong></b>
   </p>
</div>
<h3>3. Fontos adatok kitöltése</h3>
<form action='uploader.php' method='post' enctype='multipart/form-data' name='form1' id='form1'>
   <div class="form-group">
      <label>Cím</label>
      <input type='text' name='cim' id='cim' class="form-control" />
   </div>
   <div class="form-group">
      <?php filesc ( "../media/" . $cat, ".med", "ufile" ); ?>
   </div>
   <div class="form-group">
      <?php images ( "../media/" . $cat, "kep" ); ?>	
   </div>
   <div class="form-group">
      <label>Részletes leírás</label>
      <textarea name='szoveg' id='szoveg' cols='50' rows='10' class="form-control"></textarea>
   </div>
   <div class="alert alert-info info">
         <p>
         Mindent kötelező kitölteni. A feltöltendő fájl neve nem tartalmazhat ékezetes betűt!
         </p>      
   </div>   
   <p>
      <label>
         <input type="hidden" name='method' id='method' value='media'>
         <input type="hidden" name='kat' id='kat' value="<?= $cat; ?>">
         <div class="text-center">
             <input type='submit' name='fel' id='fel' value='Feltöltés!' class="btn btn-lg btn-block btn-success" />
         </div>
      </label>
      <br />
   </p>
</form>
<?php endif; ?>