<?php

include("config.php");

function jsonToLua($jsonFile,$luaFile,$assetNameLua) {


        $json = file_get_contents($jsonFile);

	$jsonArray = json_decode($json, TRUE);
/*
        $jsonIterator = new RecursiveIteratorIterator(
                new RecursiveArrayIterator($json_a),
                RecursiveIteratorIterator::SELF_FIRST);

        $jsonArray = iterator_to_array($jsonIterator, true);
*/

        //var_dump($json_a);
        //var_dump($jsonArray);
	//echo $jsonArray[0]["id"];

	$fh = fopen($luaFile, "w"); 
        for ($i=0; $i < count($jsonArray); $i++) {
                if ($jsonArray[$i]["type"] == "rect") {
                        //echo "lsakdjlasd";
                        // If it is id=0 (Background)
			//echo $jsonArray[0]["id"]; 
                        if(($jsonArray[$i]["id"] == 0) || ($jsonArray[$i]["data"]["type"] == "Canvas")){ 
                                $xas = $jsonArray[$i]["data"]["xres"] / $jsonArray[$i]["attrs"]["width"];
                                $yas = $jsonArray[$i]["data"]["yres"] / $jsonArray[$i]["attrs"]["height"];
                                $line = "gl.setup(" . $jsonArray[$i]["data"]["xres"] . "," . $jsonArray[$i]["data"]["yres"] . ")\n";
				fwrite($fh,$line);
				//echo $line;
                                $line = "function node.render()\n";
				//echo $line;
				fwrite($fh,$line);
				//$assetNameLua = $jsonArray[$i]["attrs"]["title"];
				//echo $assetNameLua;
				//echo $assetName;

                        }
                        else
                        {
                                $line = "resource.render_child(\"" 
                                        . $jsonArray[$i]["attrs"]["title"]
                                        . "\"):draw("
                                        . round($jsonArray[$i]["attrs"]["x"] * $xas)
                                        . ","
                                        . round($jsonArray[$i]["attrs"]["y"] * $yas)
                                        . ","
                                        . round(($jsonArray[$i]["attrs"]["x"] + $jsonArray[$i]["attrs"]["width"]) * $xas)
                                        . ","
                                        . round(($jsonArray[$i]["attrs"]["y"] + $jsonArray[$i]["attrs"]["height"]) * $yas)
                                        . ")\n"
                                ;
				//echo $line;
				fwrite($fh,$line);
				$sourceDir = ASSET_MODULE . "/" . $jsonArray[$i]["data"]["type"] . "/*";
				$destDir = ASSET_EDIT . "/" . $assetNameLua . "/" . $jsonArray[$i]["attrs"]["title"];
				//echo $sourceDir ." ";
				//echo $destDir . " ";
				copyToDir($sourceDir, $destDir);
				//echo $jsonArray[$i]["data"]["type"]; 
				if($jsonArray[$i]["data"]["type"] == "Video")
				{
					createPlaylist($destDir);
				}
				if($jsonArray[$i]["data"]["type"] == "RunningText")
				{
					ob_start(); 
					$command = ASSET_SCRIPT . "/feed2node.ds " . $destDir . "/feed.input";
					$status = system($command);
					ob_end_clean();

				}
                        }
                }
        }
	$line = "end\n";
	//echo $line;
	fwrite($fh,$line);
	fclose($fh);
}

?>
