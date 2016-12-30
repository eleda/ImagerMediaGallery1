
<label>Kép:</label>
<select name="<?= $id; ?>" id="<?= $id; ?>" class="form-control">

<?php for($i = 0; $i < count ( $data['parray'] ); $i ++): ?>
	<option value="<?php echo $data['parray'][$i]; ?>"><?php echo $data['parray'][$i]; ?></option>
<?php endfor; ?>

</select>
</label>
<br>
<caption>Választható képek</caption><br>
<?php for($i = 0; $i < count ( $data['parray'] ); $i ++): ?>
	<?php $fi = $data['direc'] . "/" . $data['parray'][$i]; ?>
	<img src="<?= $fi; ?>" alt="<?= $fi; ?>" width="100" height="50" />
	&lsaquo;<?php echo $data['parray'][$i]; ?>
<?php endfor; ?>
