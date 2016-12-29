<label>Kép:
<select name="<?= $id; ?>" id="<?= $id; ?>">

<?php for($i = 0; $i < count ( $data['parray'] ); $i ++): ?>
	<option value="<?php echo $data['parray'][$i]; ?>"><?php echo $data['parray'][$i]; ?></option>
<?php endfor; ?>

</select>
</label>
</br>

<table width="700" border="1" cellspacing="0" cellpadding="0">
<caption>Választható képek</caption>
<tr>
<td>

<?php for($i = 0; $i < count ( $data['parray'] ); $i ++): ?>
	<?php $fi = $data['direc'] . "/" . $data['parray'][$i]; ?>
	<img src="<?= $fi; ?>" alt="<?= $fi; ?>" width="100" height="50" />
	&lsaquo;<?php echo $data['parray'][$i]; ?>
<?php endfor; ?>

</td>
</tr>
</table>

