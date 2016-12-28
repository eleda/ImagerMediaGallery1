<?php 
  $backurl = curURL ();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="hu" />
<title>Imager Médiatár</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/media.css" />


<!-- VIDEO.JS -->
<link href="http://vjs.zencdn.net/5.8.8/video-js.css" rel="stylesheet">

<!-- If you'd like to support IE8 -->
<script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<!-- /VIDEO.JS -->



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

<table width='1200px' cellspacing=0 cellpadding=0>
  <tr height=100px>
    <td>
    <?php if (file_exists ( "media/" . $art_cat . "/banner.jpg" )) { ?>
       <img src="<?php echo 'media/' . $art_cat . '/banner.jpg'; ?>" alt=banner width=1200 height=110 />
    <?php } else { ?>
       <h1>Imager Médiatár</h1>
    <?php } ?>

      </td>
    </tr>
  <tr>
  <td valign=top>
    <table width='100%' border='0' height='100%'>
      <tr>
        <td valign='top' class='cont'>