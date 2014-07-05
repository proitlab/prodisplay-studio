<?php

	if(isset($_POST['filename'])) {
    		$file = $_POST['filename'];	
		if (file_exists($file)) {
        		unlink($file);
    		}
	}
	return true;
?>
