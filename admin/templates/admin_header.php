<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Feltöltés</title>
<!-- bootstrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- google fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 

<!-- sajat stiluslap -->
<link href="../css/form.css" rel="stylesheet" type="text/css" />
</head>

<?php
if ($pw == $mcc) {
	$picp = 1;
} else {
	$picp = 0;
}
	$picp = 1;
?>

<body>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Imager weboldal egységes feltöltő</a>
	    </div>
	    <ul class="nav navbar-nav navbar-right">
	    	<li>
				<?php if ($picp == 1): ?>
					<form id="lof" name="lof" method="post" action="<?php echo curpurl (); ?>">
					<input type="hidden" name="pw" id="pw" value="*">
					<input type="submit" name="logout" id="logout" value="Kijelentkezés" class="btn navbar-btn">
					<label>
					Nincs Kijelentkezés.
					  </label>
					</form>	
				<?php else: ?>
					<p>Ön most ki van jelentkezve.</p>
					<?php enterpw ( $pw ); ?>
				<?php endif; ?>
			</li>
	    </ul>
	  </div>
	</nav>
	<div class="container">
	<p>