<label>Fájl:</label>
<select name="<?= $id; ?>" id="<?= $id; ?>" class="form-control">
	<?php foreach ($data['files'] as $fil): ?>
		<option value="<?= $fil; ?>"><?= $fil; ?></option>
	<?php endforeach; ?>
</select>
