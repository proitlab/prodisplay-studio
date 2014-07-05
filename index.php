<?php
	include("include/config.php");
	
	if(isset($_GET['assetname'])) 
	{
		// Sync from Server 
		$queryString = $_SERVER['QUERY_STRING'];
		delTree(ASSET_EDIT . "/" . $_GET['assetname']);
		xcopy(ASSET_DIR_SERVER . "/" . $_GET['assetname'] , ASSET_EDIT . "/" . $_GET['assetname']);
		ob_start(); 
		$command = ASSET_SCRIPT . "/node2array.ds " . ASSET_EDIT . "/" . $_GET['assetname'] . "/node.lua";
		echo $command;
		$status = system($command);
		ob_end_clean();
		header("Location: ". STUDIO_PHP . "?" . $queryString . "&edit=1");
	}
	else
	{
		header("Location: ". STUDIO_PHP);
	}

?>
