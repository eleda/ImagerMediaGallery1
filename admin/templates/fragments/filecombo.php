<label>Kategória
<select name="<?= $id; ?>" id="<?= $id; ?>">
	<?php foreach ($data['files'] as $fin): ?>
	  <option value="<?= $fin; ?>"><?= $fin; ?></option>
	<?php endforeach; ?>			
</select>
</label>