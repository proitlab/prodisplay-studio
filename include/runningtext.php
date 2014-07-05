<html>
<head>
<title>ProDisplay Studio</title>
<link rel="stylesheet" type="text/css" href="../css/progressbar.css">
<link rel="stylesheet" type="text/css" href="../css/dm.css" />
<link rel="stylesheet" type="text/css" href="../css/table.css" />
<link rel="stylesheet" type="text/css" href="../css/styles.css">
<link rel="stylesheet" type="text/css" href="../css/abeezee.css">
<link rel="stylesheet" type="text/css" href="../css/proit.css">
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/txtlimit.js"></script>
</head>
<body>
<?php
        include("config.php");
        $basedir = ASSET_EDIT;
?>

<div id="w">
<?php
	if((isset($_GET['title'])) && (isset($_GET['assetname']))) {
		$title = $_GET['title'];
		$assetname = $_GET['assetname'];
		$index = $_GET['index'];
		$x = $_GET['x'];
		$y = $_GET['y'];
		$w = $_GET['w'];
		$h = $_GET['h'];
		$xar = $_GET['xar'];
		$yar = $_GET['yar'];
	}

	if((isset($_POST['title'])) && (isset($_POST['assetname']))) {
		$title = $_POST['title'];
		$assetname = $_POST['assetname'];
		$index = $_POST['index'];
		$x = $_POST['x'];
		$y = $_POST['y'];
		$w = $_POST['w'];
		$h = $_POST['h'];
		$xar = $_POST['xar'];
		$yar = $_POST['yar'];
	}

	$feedInput = $basedir . "/" . $assetname . "/" . $title . "/feed.input";
	define(FEED_INPUT, $feedInput);
	function Read() {
		return @file_get_contents(FEED_INPUT);
	}

	$dirname=$basedir . "/" . $assetname . "/" . $title;
	if (!file_exists($dirname)) {
        	mkdir($dirname, 0755, true);
	}

?>

<h2><?php echo "Layout : ".$title; ?></h2>
<br/>
<p id="counter">X1,Y1 : <?php echo floor($x*$xar).",".floor($y*$yar); ?></p>
<p id="counter">X2,Y2 : <?php echo floor(($x+$w)*$xar).",".floor(($y+$h)*$yar); ?></p>

<!--  	<h1>Running Text Editor</h1>
-->
<?php
	if(isset($_POST['Submit']))
   	{
		$data = $_POST["text"];
		// Clean up of new lines
		$string = trim(preg_replace('/\s+/', ' ', $data));
        	@file_put_contents(FEED_INPUT, $string);
		echo "<script type=\"text/javascript\">alert('Text is saved');</script>\n";
	}
?>
	<div align="center">
	<div id="upload-wrapper">
  	
  	<p id="counter"><span><?php $txt = Read(); echo strlen($txt);?></span> characters. (Up to 256 characters)</p>
  	
	<form name="RunningTextForm" method="POST" action="runningtext.php">
  	<textarea name="text" id="text" class="txt" tabindex="1" style="width: 320; height: 200;"><?php $txt = Read(); echo $txt;?></textarea>
<?php
	echo "<input type=\"hidden\" name=\"assetname\" value=\"" . $assetname . "\" />\n";
	echo "<input type=\"hidden\" name=\"title\" value=\"" . $title . "\" />\n";
	echo "<input type=\"hidden\" name=\"index\" value=\"" . $index . "\" />\n";
	echo "<input type=\"hidden\" name=\"x\" value=\"" . $x . "\" />\n";
	echo "<input type=\"hidden\" name=\"y\" value=\"" . $y . "\" />\n";
	echo "<input type=\"hidden\" name=\"w\" value=\"" . $w . "\" />\n";
	echo "<input type=\"hidden\" name=\"h\" value=\"" . $h . "\" />\n";
	echo "<input type=\"hidden\" name=\"xar\" value=\"" . $xar . "\" />\n";
	echo "<input type=\"hidden\" name=\"yar\" value=\"" . $yar . "\" />\n";
?>
	<input name="Submit" type="submit" id="submit-btn" value="Submit">
	</form>
	</div>
	</div>
  </div>
</body>
</div>
</body>
</html>
