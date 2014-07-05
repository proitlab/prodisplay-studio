<head>
<title>ProDisplay Studio</title>
<link rel="stylesheet" type="text/css" href="../css/progressbar.css">
<link rel="stylesheet" type="text/css" href="../css/dm.css" />
<link rel="stylesheet" type="text/css" href="../css/table.css" />
<link rel="stylesheet" type="text/css" href="../css/styles.css">
<link rel="stylesheet" type="text/css" href="../css/abeezee.css">
<link rel="stylesheet" type="text/css" href="../css/proit.css">
<script src="../js/proit.ajax.js" type="text/javascript"></script>
<script src="../js/jquery.min.js" type="text/javascript"></script>
</script>
</head>
<body>
<div id="w">

<?php
	include("config.php");
	$basedir = ASSET_EDIT;
	$assetBasename = ASSET_BASENAME;
	//$assetBasename = basename(ASSET_DIR) . "/" . basename(ASSET_EDIT);
?>


<?php

if(isset($_POST['upload'])) {
$types = array('image/jpg', 'image/jpeg', 'image/png');  
if (in_array($_FILES["image"]["type"], $types)) {
 	if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
		$assetname = $_POST['assetname'];
		$title = $_POST['title'];
		$destdir = $basedir . "/" . $assetname . "/" . $title;
		if (file_exists($destdir."/logo.png")) {
        		unlink($destdir."/logo.png");
		}
		if (file_exists($destdir."/logo.jpg")) {
        		unlink($destdir."/logo.jpg");
		}
        	$tmp_name = $_FILES["image"]["tmp_name"];
		$path_info = pathinfo($_FILES["image"]["name"]);
        	$realname = "logo." . $path_info['extension'];
        	move_uploaded_file($tmp_name, $destdir."/".$realname);
        	//echo $realname . " upload is OK!<br />";
    	}
	else
	{
		echo "Error Upload";
	}
}
else
{
	echo "Error Type";
}
}
?>

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
	$layoutDir = $assetname . "/" . $title;
	$dirname = $basedir . "/" . $assetname . "/" . $title;
	if (!file_exists($dirname)) { 
		mkdir($dirname, 0755, true);
	}


?>

<h2><?php echo "Layout : ".$title; ?></h2>
<br />
<p id="counter">X1,Y1 : <?php echo floor($x*$xar).",".floor($y*$yar); ?></p>
<p id="counter">X2,Y2 : <?php echo floor(($x+$w)*$xar).",".floor(($y+$h)*$yar); ?></p>

<?php

echo "<div align=\"center\">\n";
echo "<div id=\"upload-wrapper\">\n";
echo "<span>Image type jpeg or png</span>\n";
echo "<form action=\"logo.php\" method=\"post\" enctype=\"multipart/form-data\">\n";
echo "<input type=\"file\" name=\"image\" />\n";
echo "<input type=\"hidden\" name=\"assetname\" value=\"" . $assetname . "\" />\n";
echo "<input type=\"hidden\" name=\"title\" value=\"" . $title . "\" />\n";
echo "<input type=\"hidden\" name=\"index\" value=\"" . $index . "\" />\n";
echo "<input type=\"hidden\" name=\"x\" value=\"" . $x . "\" />\n";
echo "<input type=\"hidden\" name=\"y\" value=\"" . $y . "\" />\n";
echo "<input type=\"hidden\" name=\"w\" value=\"" . $w . "\" />\n";
echo "<input type=\"hidden\" name=\"h\" value=\"" . $h . "\" />\n";
echo "<input type=\"hidden\" name=\"xar\" value=\"" . $xar . "\" />\n";
echo "<input type=\"hidden\" name=\"yar\" value=\"" . $yar . "\" />\n";
echo "<input type=\"hidden\" name=\"upload\" />\n";
echo "<input type=\"submit\" id=\"submit-btn\" value=\"Upload\" />\n";
echo "</form>\n";
echo "</div>\n";
echo "</div>\n";


echo "<h3>Logo Image</h3>";

if ($handle = opendir($dirname)) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != ".." && $entry != "node.lua" && $entry != "playlist.txt" ) {

		echo "<a href=\"#\" id=\""
			.$entry."\"><img src=\"../"
			.$assetBasename."/".$layoutDir."/" 
			. $entry . "\" width=\"160\"/></a>";
        }
    }

    closedir($handle);
}
?>
</div>
</body>
