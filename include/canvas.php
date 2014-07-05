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

/*
	function delTree($dir) {
    		$files = glob( $dir . '*', GLOB_MARK );
    		foreach( $files as $file ){
        		if( substr( $file, -1 ) == '/' )
            			delTree( $file );
       			 else
            			unlink( $file );
    		}
    		rmdir( $dir );
	} 
*/
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

	// Canvas Initialization
	if(isset($_GET['initCanvas'])) {
		$dirNode = $basedir."/".$assetname;	
		if(!isset($_GET['edit'])) {
			delTree($dirNode);
		}
	}
	
	// In even removeNode (call by removeNode by signalling with variable "childName"
	if(isset($_GET['childName'])) {
		$dirNode = $basedir."/".$assetname."/".$_GET['childName'];	
		delTree($dirNode);
	}

	// Create Directory if not created yet;
	$dirname = $basedir . "/" . $title;
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
