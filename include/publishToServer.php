<?php

	include("config.php");
	if(isset($_POST['assetName'])) {
		$command="rsync -ravv --delete-delay --delay-updates " 
			. ASSET_SAVE . "/" 
			. $_POST['assetName']
			. " "
			. ASSET_DIR_SERVER 
			. "/";
		ob_start(); 
		$status = system($command);
		ob_end_clean();
		echo $_POST['assetName'];
	}
	else
	{
		echo "Failed!";
	}
?>
