<h2>Új elem a médiatárba</h2>
<h3>1. Kategória kiválasztása</h3>
<form action='index.php?method=media' method='post' enctype='multipart/form-data' name='form1' id='form1'>
   <?php filecombo ( "../media", ".txt", "kat" ); ?>
   <input type='submit' name='ffel' id='ffel' value='Kategóriaváltás' />
</form>
<?php if ($cat == ""): ?>
<p class='info'>Miután kiválasztotta a kategóriát, kattintson a Tovább gombra.</p>
<?php endif; ?>
<?php if ($cat != ""): ?>
<h3>2. Fájl feltöltése</h3>
<p class='info'> Töltse fel FTP kliens (pl. Total Commander segítségével a fájlt. Miután elkészült kattintson újra a <strong>Kategóriaváltás</strong> gombra!</br>
   Ahova fel kell tölteni: <strong>media/<?= $cat ?></strong></b>	
<h3>3. Fontos adatok kitöltése</h3>
<form action='uploader.php' method='post' enctype='multipart/form-data' name='form1' id='form1'>
   </p>
   <label>Cím
   <input type='text' name='cim' id='cim' />
   </label>
   <p>
      <?php filesc ( "../media/" . $cat, ".med", "ufile" ); ?>
   </p>
   <p>
      <?php images ( "../media/" . $cat, "kep" ); ?>	
   </p>
   <p>
      <label>Részletes leírás
      <textarea name='szoveg' id='szoveg' cols='50' rows='10'></textarea>
      </label>
   </p>
   <p class='info'>Mindent kötelező kitölteni! A feltöltendő fájl neve nem tartalmazhat ékezetes betűt!</p>
   <p>
      <label>
         <input type="hidden" name='method' id='method' value='media'>
         <input type="hidden" name='kat' id='kat' value="<?= $cat; ?>">
         <input type='submit' name='fel' id='fel' value='Feltöltés!' />
      </label>
      <br />
   </p>
</form>
<?php endif; ?>