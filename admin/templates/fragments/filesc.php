<label>Fájl:
	<select name="<?= $id; ?>" id="<?= $id; ?>">
		<?php foreach ($data['files'] as $fil): ?>
			<option value="<?= $fil; ?>"><?= $fil; ?></option>
		<?php endforeach; ?>
	</select>
</label>