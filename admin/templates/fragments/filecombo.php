<div class="form-group">
<label>Kategória</label>
<select name="<?= $id; ?>" id="<?= $id; ?>" class="form-control">
	<?php foreach ($data['files'] as $fin): ?>
	  <option value="<?= $fin; ?>"><?= $fin; ?></option>
	<?php endforeach; ?>			
</select>
</div>
