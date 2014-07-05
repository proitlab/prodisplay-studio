<?php
        include("config.php");
        $basedir = $assetDir;
?>

<?php

if(isset($_POST['upload'])) {
$types = array('video/mp4');
if (in_array($_FILES["video"]["type"], $types)) {
        if ($_FILES["video"]["error"] == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["video"]["tmp_name"];
                $realname = $_FILES["video"]["name"];
                $assetname = $_POST['assetname'];
                $title = $_POST['title'];
                //$basedir = "/tmp";
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

