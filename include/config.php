<?php

/**
*
* Parameter Start
*
**/
$version = "v0.705";
define(STUDIO_VERSION, "v0.705");
define(STUDIO_PHP, "studio.php");

// Change to final asset directory in production
//$baseURL = http://localhost:wq
$assetDir = "/var/www/html/studio/assets";
$assetEdit = $assetDir . "/edit"; 
$assetSaved = $assetDir . "/saved"; 
$assetBasename = basename($assetDir) . "/" . basename($assetEdit);
define(ASSET_DIR, $assetDir); 
define(ASSET_MODULE, $assetDir . "/modules"); 
define(ASSET_EDIT, $assetDir . "/edit"); 
define(ASSET_SAVE, $assetDir . "/saved"); 
define(ASSET_SCRIPT, $assetDir . "/scripts"); 
define(ASSET_BASENAME, basename($assetDir) . "/" . basename($assetEdit));

// Asset Directory in Server
$asserDirServer ="/home/proit/channel/deploy";
define(ASSET_DIR_SERVER, "/home/proit/channel/deploy");
// Where the modules are
$moduleDir = "";
$db = "proit";
$dbUser = "root";
$dbPass = "godbl3ssm3";
$assetTable = "assets";

/**
*
* Parameter End, Function Start
*
**/

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


function copyToDir($pattern, $dir)
{
    foreach (glob($pattern) as $file) {
        if(!is_dir($file) && is_readable($file)) {
		if(!file_exists($dir)) {
			mkdir($dir, 0755, true);
		}
            	$dest = realpath($dir) . DIRECTORY_SEPARATOR . basename($file);
            	copy($file, $dest);
        }
    }    
}

/**
 * Copy a file, or recursively copy a folder and its contents
 * @param       string   $source    Source path
 * @param       string   $dest      Destination path
 * @param       string   $permissions New folder creation permissions
 * @return      bool     Returns true on success, false on failure
 */
function xcopy($source, $dest, $permissions = 0755)
{
    // Check for symlinks
    if (is_link($source)) {
        return symlink(readlink($source), $dest);
    }

    // Simple copy for a file
    if (is_file($source)) {
        return copy($source, $dest);
    }

    // Make destination directory
    if (!is_dir($dest)) {
        mkdir($dest, $permissions);
    }

    // Loop through the folder
    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }

        // Deep copy directories
        xcopy("$source/$entry", "$dest/$entry");
    }

    // Clean up
    $dir->close();
    return true;
}

function createPlaylist($dirname)
{

   $playlist = $dirname . "/playlist.txt";
//echo $playlist;
   if ($handle = opendir($dirname)) {
	$fhPlaylist = fopen($playlist , "w");

    	while (false !== ($entry = readdir($handle))) {

        	if ($entry != "." && $entry != ".." && $entry != "node.lua" && $entry != "playlist.txt") {

			fwrite($fhPlaylist,$entry."\n");
        	}
    	}
	fclose($fhPlaylist);
    	closedir($handle);
   }
}

?>
