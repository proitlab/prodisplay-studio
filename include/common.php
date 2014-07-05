<html>
<head>
<title>ProDisplay Studio</title>
<link rel="stylesheet" type="text/css" href="../css/progressbar.css">
<link rel="stylesheet" type="text/css" href="../css/dm.css" />
<link rel="stylesheet" type="text/css" href="../css/table.css" />
<link rel="stylesheet" type="text/css" href="../css/styles.css">
<link rel="stylesheet" type="text/css" href="../css/abeezee.css">
<link rel="stylesheet" type="text/css" href="../css/proit.css">
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

	$dirname=$basedir . "/" . $assetname . "/" . $title;
	if (!file_exists($dirname)) {
        	mkdir($dirname, 0755, true);
	}

?>

<h2><?php echo "Layout : ".$title; ?></h2>
<br/>
<p id="counter">X1,Y1 : <?php echo floor($x*$xar).",".floor($y*$yar); ?></p>
<p id="counter">X2,Y2 : <?php echo floor(($x+$w)*$xar).",".floor(($y+$h)*$yar); ?></p>
</div>
</body>
</html>
