<?php
	//echo $_GET['title'];
	if((isset($_GET['type'])) && (isset($_GET['title'])) && (isset($_GET['assetname']))
		&& (isset($_GET['index'])) && (isset($_GET['x'])) && (isset($_GET['y']))
		&& (isset($_GET['w'])) && (isset($_GET['h'])))
	{
	   $queryString = $_SERVER['QUERY_STRING'];
	   switch($_GET['type']) {
		case 'Video':
			$script = "video.php";
		break;
		case 'SlideShow':
			$script = "slideshow.php";
		break;
		case 'RunningText':
			$script = "runningtext.php";
		break;
		case 'Logo':
			$script = "logo.php";
		break;
		default:
			if(isset($_GET['id'])) {
				$script = "canvas.php";
			} else {
				$script = "common.php";
			}
		break;
	   }
	   header("Location: ".$script."?".$queryString);
	}
?>
