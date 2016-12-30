<?php 
  $backurl = curURL ();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
<!-- <meta lang="HU"> -->
<meta charset="UTF-8">
<title>Imager Médiatár</title>

<!-- BOOTSTRAP -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- /BOOTSTRAP -->

<link rel="stylesheet" type="text/css" href="css/media.css" />

<!-- VIDEO.JS -->
<link href="http://vjs.zencdn.net/5.8.8/video-js.css" rel="stylesheet">

<!-- If you'd like to support IE8 -->
<script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<!-- /VIDEO.JS -->

<!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">  
<!-- /GOOGLE FONTS -->


<style type="text/css">
.fadeSome {
	opacity: 0.30;
	filter: alpha(opacity = 30);
	-moz-opacity: 30%;
}

.fadeLots {
	opacity: 0.50;
	filter: alpha(opacity = 50);
	-moz-opacity: 0.5;
}

.fadeCompletely {
	opacity: 0.0;
	filter: alpha(opacity = 0);
	-moz-opacity: 0.0;
}

#silverlightControlHost {
	
}
</style>
<script type="text/javascript">
// SILVERLIGHT LEJÁTSZÓHOZ
function onSilverlightError(sender, args) {

    var appSource = "";
    if (sender != null && sender != 0) {
        appSource = sender.getHost().Source;
    }
    var errorType = args.ErrorType;
    var iErrorCode = args.ErrorCode;

    var errMsg = "Unhandled Error in Silverlight Application " + appSource + "\n";

    errMsg += "Code: " + iErrorCode + "    \n";
    errMsg += "Category: " + errorType + "       \n";
    errMsg += "Message: " + args.ErrorMessage + "     \n";

    if (errorType == "ParserError") {
        errMsg += "File: " + args.xamlFile + "     \n";
        errMsg += "Line: " + args.lineNumber + "     \n";
        errMsg += "Position: " + args.charPosition + "     \n";
    }
    else if (errorType == "RuntimeError") {
        if (args.lineNumber != 0) {
            errMsg += "Line: " + args.lineNumber + "     \n";
            errMsg += "Position: " + args.charPosition + "     \n";
        }
        errMsg += "MethodName: " + args.methodName + "     \n";
    }

    throw new Error(errMsg);
}

function highlightDownloadArea(fOn) {
    document.getElementById("overlay").className = (fOn) ? "fadeSome" : "fadeLots";            
}

function CloseWindow()
{
window.close();
}
   </script>


</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo $_SERVER["SCRIPT_NAME"]; ?>">
      <span class="glyphicon glyphicon-hand-right"></span>
      </a>
    </div>
    <?php $data = get_all_category(); ?>
    <ul class="nav navbar-nav">
            <?php for($i = 0; $i < count ( $data['categs'] ); $i ++): ?>
            <?php $lin = curpurl () . "?view=channel&category=" . $data['categs'][$i]; ?>
            <li><a href="<?php echo $lin; ?>" title="<?php echo $data['categn'][$i]; ?>">
                <?php echo $data['categn'][$i]; ?>
            </a></li>
            <?php endfor; ?>
    </ul>
  </div>
<header>
    <?php if (file_exists ( "media/" . $art_cat . "/banner.jpg" )) { ?>
       <img class="img-responsive" src="<?php echo 'media/' . $art_cat . '/banner.jpg'; ?>" alt=banner width="100%"/>
    <?php } ?>
</header>
</nav>
<div class="container-fluid">
<div class="container">
<div class="row">
  <div class="row">