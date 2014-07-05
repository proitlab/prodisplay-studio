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
$types = array('video/mp4');  
if (in_array($_FILES["video"]["type"], $types)) {
 	if ($_FILES["video"]["error"] == UPLOAD_ERR_OK) {
        	$tmp_name = $_FILES["video"]["tmp_name"];
        	$realname = str_replace(" ", "",$_FILES["video"]["name"]);
		$assetname = $_POST['assetname'];
		$title = $_POST['title'];
		$destdir = $basedir . "/" . $assetname . "/" . $title;
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

?>

<h2><?php echo "Layout : ".$title; ?></h2>
<br />
<p id="counter">X1,Y1 : <?php echo floor($x*$xar).",".floor($y*$yar); ?></p>
<p id="counter">X2,Y2 : <?php echo floor(($x+$w)*$xar).",".floor(($y+$h)*$yar); ?></p>

<?php

$dirname=$basedir . "/" . $assetname . "/" . $title;
if (!file_exists($dirname)) { 
	mkdir($dirname, 0755, true);
}

echo "<div align=\"center\">\n";
echo "<div id=\"upload-wrapper\">\n";
echo "<span>Video MP4 with 720 resolution and max size 100MB</span>\n";
echo "<form action=\"video.php\" method=\"post\" enctype=\"multipart/form-data\">\n";
//echo "<p id=\"section\">\n";
echo "<input type=\"file\" name=\"video\" />\n";
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
//echo "</p>\n";
echo "</form>\n";
echo "</div>\n";
echo "</div>\n";
//echo "<hr />\n";


//echo "<hr />\n";
echo "<h3>List Video Files</h3>";

if ($handle = opendir($dirname)) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != ".." && $entry != "node.lua" && $entry != "playlist.txt" ) {


		echo "<p id=\"".$entry."\"><button style=\"margin: 0; padding: 0;\" onclick=\"deleteFile('".$dirname."/".$entry."');\"><img src=\"../images/deleteIcon.png\" width=10px height=10px /></button>".$entry."</p>";
		//echo "<p id=\"".$entry."\">".$entry."</p>\n";
            	//echo "$entry\n";
            	//echo "<br />";
        }
    }

    closedir($handle);
}
?>
</div>
</body>
