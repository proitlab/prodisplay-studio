<?php
	include("luaLibrary.php");	
	$basedir = ASSET_EDIT;

	header('Content-Type: application/json');

	if(isset($_POST['assetName'])) {
		$assetName = $_POST['assetName'];
		$targetDir = ASSET_EDIT ."/".$assetName;
		$targetFile = $targetDir."/".$assetName.".json";
		if (!file_exists($targetDir)) {
        		mkdir($targetDir, 0755, true);
		}
		file_put_contents($targetFile,json_decode($_POST['json'],true));

		jsonToLua($targetFile,$targetDir."/node.lua",$assetName);
		xcopy(ASSET_EDIT . "/" . $assetName, ASSET_SAVE . "/" . $assetName);
		
		echo $assetName;
		//echo "Saved!";
	}
	else
	{
		echo "Failed!";
	}

?>
