<html>
<head>
<title>ProDisplay Studio</title>
<link rel="stylesheet" type="text/css" href="css/dm.css" />
<link rel="stylesheet" type="text/css" href="css/table.css" />
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="stylesheet" type="text/css" href="css/abeezee.css">

<!--<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" /> -->
<script src="js/dm.js" type="text/javascript"></script>
<script src="js/raphael-min.js" type="text/javascript"></script>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/proit.js" type="text/javascript"></script>
<script src="js/proit.json.js" type="text/javascript"></script>
<!--
<script src="js/proit.ajax.js" type="text/javascript"></script>
-->
</head>
<!--
<body onLoad="checkRefresh();" onUnload="prepareForRefresh();">
-->
<body>
<?php
	include("include/config.php");
?>

<div id="container">
  <div id="row">
    <div id="left">
	<h2>Menu</h2>
	<ul id="sddm">
		<li><a href="#"
       		 	onmouseover="mopen('m1')" 
       		 	onmouseout="mclosetime()">Layout #1</a>
		<div id="m1"
       		     onmouseover="mcancelclosetime()" 
       		     onmouseout="mclosetime()">
    			<a href="#" id="Video">Video</a>
    			<a href="#" id="SlideShow">SlideShow</a>
    			<a href="#" id="RunningText">RunningText</a>
    			<a href="#" id="Logo">Logo</a>
		</div>
		</li>
	</ul>
	<br />
	<br />
	<ul id="sddm">
       		<li><a href="#"
                	onmouseover="mopen('m2')" 
                	onmouseout="mclosetime()">Layout #2 </a>
        	<div id="m2"
            		onmouseover="mcancelclosetime()" 
            		onmouseout="mclosetime()">
        		<a href="#" id="DigitalClock">DigitalClock</a>
        		<a href="#" id="AnalogClock">AnalogClock</a>
        		<a href="#" id="Background">Background</a>
        	</div>
        	</li>
	</ul>
	<br />
	<br />
        <ul id="sddm">
                <li><a href="#"
                        onmouseover="mopen('m3')" 
                        onmouseout="mclosetime()">Layout #3 </a>
                <div id="m3"
                        onmouseover="mcancelclosetime()" 
                        onmouseout="mclosetime()">
                        <a href="#" id="RunningTextRSS" onclick="alert('Coming Soon!');">RunningText RSS</a>
                        <a href="#" id="VideoYoutube" onclick="alert('Coming Soon!');">Youtube Video</a>
                        <a href="#" id="SlideShowWeb" onclick="alert('Coming Soon!');">Web SlideShow</a>
                </div>
                </li>
        </ul>
	<br />
	<br />
	<br />
	<br />
	<ul id="sddm">
		<li><a href="#" id="RemoveLayout">Remove Layout</a></li>
	<br />
	<br />
	<br />
	<br />
		<li><a href="#" id="SaveAsset">Save Asset</a></li>
	<br />
	<br />
		<li><a href="#" id="PublishToServer">Publish to Server</a></li>
	</ul>
    </div>
    <div id="middle" style="padding: 5px;">
	<h1 align="center">ProDisplay Studio <?php echo STUDIO_VERSION; ?></h1>
	<div id="paper"></div>
	<div id="here">0,0</div>
   </div>
<!--
    <div id="middle">
	<h2>@</h2>
	<iframe frameborder="0" scrolling="auto" width="10" height="445" name="middleIframe" id="middleIFrame"></iframe>
    </div>
-->
    <div id="right">
<?php
	(isset($_GET['assetname']) ? $assetname = $_GET['assetname'] : $assetname = "asset-" . rand()); 
	//echo "<h1>" . $assetname . "</h1>";
	echo "<h2>Property</h2>";
?>
	<iframe frameborder="none" style="width:400px;height:450px" scrolling="no" name="property" id="property"></iframe>
    </div>
  </div>
</div>

<!--
<p><strong>Layout 1</strong> is layout which require an input such uploading videos or images</p>
<p>Layout 2 is layout which doesn't require an input. It is predefined layout</p>
<p>Remove Layout is to remove layout. Select the layout by click in it, then click on Remove Layout button<p>
-->
<script type="text/javascript">
		
<?php
	//(!isset($assetname) ? $assetname = $_GET['assetname'] : $assetname = "asset-" . rand()); 
	echo "	backgroundRectTitle = \"" . $assetname . "\";";
?>

<?php
	$canvasWidth = 800;
	$canvasHeight = 450;
	if((isset($_GET['edit'])) && (isset($_GET['assetname']))) {
        	//$string =  file_get_contents("/tmp/node.lua.proit");
		$nodeLuaArrayFile = ASSET_EDIT . "/" . $_GET['assetname'] . "/node.lua.array";
		if(file_exists($nodeLuaArrayFile)) {
        		//$string =  file_get_contents("/tmp/node.lua.proit");
        		$string =  file_get_contents($nodeLuaArrayFile);
        		$string =  str_replace('(' , ',' , $string);
        		$string =  str_replace(')' , ' ' , $string);
        		$nodeLuaArray = explode("\n", $string);
        		for($i = 0; $i < count($nodeLuaArray); $i++) {
                		$layoutArray = explode(',' , $nodeLuaArray[$i]);
                		if($layoutArray[0] == "canvas") {
					$xres = $layoutArray[1];
					//$xar = intval($layoutArray[1]) / $canvasWidth;
					$xar = $layoutArray[1] / $canvasWidth;
					$yres = $layoutArray[2];
					$yar = $layoutArray[2] / $canvasHeight;
					echo "var laman = initCanvas(paper,true,".$xres.",".$yres.",1);\n";
				} else {
			   		if($layoutArray[0] != "") {
						echo "//" . $layoutArray[0] . "\n";
						//$nodeTitle = $layoutArray[0];
        					$nodeType = explode('-', $layoutArray[0]);
						//$nodeWidth = ($layoutArray[3] - $layoutArray[1]) / $xar;
						//$nodeHeight = ($layoutArray[4] - $layoutArray[2]) / $yar;
						echo "addNode(laman"
							.",\"". $nodeType[0] . "\""
							.",\"". $layoutArray[0] . "\""
							.", 0"
							.",". round($layoutArray[1] / $xar)
							.",". round($layoutArray[2] / $yar)
							.",". round($layoutArray[3] / $xar)
							.",". round($layoutArray[4] / $yar)
							.");\n";
			   		}
				}
			
        		}
		}
		else
		{
			echo "var laman = initCanvas();\n";
		}
	} else {
		echo "var laman = initCanvas();\n";
	}
?>
		
	//var laman = initCanvas();
	var nodeIndex = null;
	var ElIDs = [
		"Video",
		"SlideShow",
		"RunningText",
		"Logo",
		"DigitalClock",
		"AnalogClock",
		"Background"
	];

	var ElHandlers = new Array();
	for ( i = 0 ; i < ElIDs.length ; i++ ) {
		ElHandlers[i] = document.getElementById(ElIDs[i]);
	}
	// Video
	ElHandlers[0].onclick = function() { addNode(laman,ElIDs[0]); };
	// SlideShow
	ElHandlers[1].onclick = function() { addNode(laman,ElIDs[1]); };
	// RunningText
	ElHandlers[2].onclick = function() { addNode(laman,ElIDs[2]); };
	// Logo
	ElHandlers[3].onclick = function() { addNode(laman,ElIDs[3]); };
	// DigitalClock
	ElHandlers[4].onclick = function() { addNode(laman,ElIDs[4]); };
	// AnalogClock
	ElHandlers[5].onclick = function() { addNode(laman,ElIDs[5]); };
	// Background
	ElHandlers[6].onclick = function() { addNode(laman,ElIDs[6]); };

	var RemoveNode = document.getElementById('RemoveLayout');
	var SaveAsset = document.getElementById('SaveAsset');
	var PublishToServer = document.getElementById('PublishToServer');
	//var ExitFromStudio = document.getElementById('ExitFromStudio');
	RemoveNode.onclick = removeNode;
	SaveAsset.onclick = function() { saveAsset(laman); };
	PublishToServer.onclick = function() { publishToServer(backgroundRectTitle); };
	//ExitFromStudio.onclick = function() { window.close(); };
</script>
<div id="bar"></div>
</body>
</html>
