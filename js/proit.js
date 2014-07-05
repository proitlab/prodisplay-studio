var selected = null;                
var selectedStroke = null;                
var selectedStrokeW = null;                
var xar = null;                
var yar = null;                
var nodeLua = new Array();
var backgroundRect = null;
var backgroundRectTitle = null;
var nodeCanvas = new Array();
var VIDEO = 0;
var SLIDESHOW = 1;
var RUNNINGTEXT = 2;
var LOGO = 3;
var DIGITALCLOCK = 4;
var ANALOGCLOCK = 5;
var BACKGROUND = 6;
var nodeURI = "include/router.php";
var cWidth = 800;
var cHeight = 450;


var initCanvas = function(canvas="paper", showGrid=true, xres=1920, yres=1080, isEdit=0){
	xar = xres / cWidth;	
	yar = yres / cHeight;	
	var nodeCanvas = Raphael(canvas,cWidth,cHeight);
	backgroundRect = nodeCanvas.rect(0, 0, cWidth, cHeight);
//	if(backgroundRectTitle == null) {
//		backgroundRectTitle = "asset-" + Math.floor(Math.random() * 100000);
//	}
	backgroundRect.attr({
		fill: '#fff', 
		stroke: '#CCCCCC', 
		//stroke: 'none', 
		'stroke-width' : 2, 
		'fill-opacity' : 1,
		'title' : backgroundRectTitle
	});
	backgroundRect.data({
		'index' : 0,
		'type' : 'Canvas',
		'xres' : xres,
		'yres' : yres
	});
	backgroundRect.mousemove(showCoordinate);
	backgroundRect.click(selectNode);
/*
	backgroundRect.dblclick(function() { 
			URI = nodeURI + "?" + "title=" + backgroundRect.attr('title') 
				+ "&" + "type=" + backgroundRect.data('type')
				+ "&" + "index=" + backgroundRect.data('index')
				+ "&" + "x=" + backgroundRect.attr('x')
				+ "&" + "y=" + backgroundRect.attr('y')
				+ "&" + "w=" + backgroundRect.attr('width')
				+ "&" + "h=" + backgroundRect.attr('height')
				+ "&" + "xar=" + xar
				+ "&" + "yar=" + yar
				+ "&" + "assetname=" + backgroundRectTitle
				+ "&" + "id=" + backgroundRect.id
				;
				targetURINode(URI); 
			});
*/
	if(isEdit == 0) {
	   URI = nodeURI + "?" + "title=" + backgroundRect.attr('title') 
		+ "&" + "type=" + backgroundRect.data('type')
		+ "&" + "index=" + backgroundRect.data('index')
		+ "&" + "x=" + backgroundRect.attr('x')
		+ "&" + "y=" + backgroundRect.attr('y')
		+ "&" + "w=" + backgroundRect.attr('width')
		+ "&" + "h=" + backgroundRect.attr('height')
		+ "&" + "xar=" + xar
		+ "&" + "yar=" + yar
		+ "&" + "assetname=" + backgroundRectTitle
		+ "&" + "id=" + backgroundRect.id
		+ "&" + "initCanvas=" + 1
		;
	} else {
	   URI = nodeURI + "?" + "title=" + backgroundRect.attr('title') 
		+ "&" + "type=" + backgroundRect.data('type')
		+ "&" + "index=" + backgroundRect.data('index')
		+ "&" + "x=" + backgroundRect.attr('x')
		+ "&" + "y=" + backgroundRect.attr('y')
		+ "&" + "w=" + backgroundRect.attr('width')
		+ "&" + "h=" + backgroundRect.attr('height')
		+ "&" + "xar=" + xar
		+ "&" + "yar=" + yar
		+ "&" + "assetname=" + backgroundRectTitle
		+ "&" + "id=" + backgroundRect.id
		+ "&" + "initCanvas=" + 1
		+ "&" + "edit=" + 1
		;
	}
	targetURINode(URI); 

	// Draw the grid lines
	if(showGrid) {
	var MINOR_COLOR = "#F0F0F0";
	var MAJOR_COLOR = "#CCCCCC";
	var w = nodeCanvas.width;
	var h = nodeCanvas.height;
	var sp = 50;
	var px = '1';
	var n = 0;

	for (var i = 0; i < w; i += sp) {
	    var p = nodeCanvas.path('M ' + i + ' ' + 0 + ' v ' + h);
	    p.attr("stroke-width", px);
	    if (n % 5 == 0) {
	        p.attr('stroke', MAJOR_COLOR);
	    } else {
	        p.attr('stroke', MINOR_COLOR);
	        p.toBack();
	    }
	    n=n+sp;
	    p.transform('...t.5,.5');
	}
	n = 0;
	for (var j = 0; j < h; j += sp) {
	    var p = nodeCanvas.path('M ' + 0 + ' ' + j + ' h ' + w);
	    p.attr("stroke-width", px);
	    if (n % 5 == 0) {
	        p.attr('stroke', MAJOR_COLOR);
	    } else {
	        p.attr('stroke', MINOR_COLOR);
	        p.toBack();
	    }
	    //++n;
	    n=n+sp;
	    //p.transform('...t.5,.5');
	    p.transform('...t.10,.10');
	}
	}
	return nodeCanvas;
};


var addNode = function(canvas=nodeCanvas,nodeType="Video",nodeTitle="Node",isNew=1,x1=375,y1=175,x2=475,y2=250){
	// Add new node
	var fillOpacity = 0.8;
	var index = nodeLua.length;
	//var x1 = 375;
	//var y1 = 175;
	//var x2 = 475;
	//var y2 = 275;

	// Find null index
	for( i = 0; i < nodeLua.length; i++ ) {
		if(nodeLua[i] == null) { index=i; };
	}

	switch(nodeType) {
		case 'Video':
			fillColor = '#FF0000';
			if(isNew == 1) {
				x1 = 600;
				y1 = 100; 
				x2 = 800;
				y2 = 250;
			}
		break;
		case 'SlideShow':
			fillColor = '#CC0099';
			if(isNew == 1) {
				x1 = 0;
				y1 = 0; 
				x2 = 600;
				y2 = 425;
			}
		break;
		case 'RunningText':
			fillColor = '#0033CC';
			if(isNew == 1) {
				x1 = 0;
				y1 = 425; 
				x2 = 800;
				y2 = 450;
			}
		break;
		case 'Logo':
			fillColor = '#999933';
			if(isNew == 1) {
				x1 = 600;
				y1 = 0; 
				x2 = 800;
				y2 = 100;
			}
		break;
		case 'DigitalClock':
			fillColor = '#00FF33';
			if(isNew == 1) {
				x1 = 700;
				y1 = 420; 
				x2 = 800;
				y2 = 450;
			}
		break;
		case 'AnalogClock':
			fillColor = '#FF9900';
			if(isNew == 1) {
				x1 = 600;
				y1 = 250; 
				x2 = 800;
				y2 = 425;
			}
		break;
		case 'Background':
			fillColor = '#FF99FF';
		break;
		default:
			fillColor = '#FFFFFF';
		break;

	}
	// Check if Node is created by editor or not
	if(isNew==1) {
		nodeTitle = nodeType + '-' + index;
	
	} else {
		nodeTitle = nodeTitle;
	}

	nodeLua[index] = canvas.add ([{
		'type' : 'rect',
		'x' : x1,
		'y' : y1,
		'width' : x2 - x1,
		'height' : y2 - y1,
		'fill' : fillColor,
		'fill-opacity' : fillOpacity,
		'stroke' : '#3b5068',
		'stroke-width' : 1 ,
		'title' : nodeTitle
	}]);

	// Create Data
	nodeLua[index].data({
		'index' : index,
		'type'	: nodeType
		});

	// Attach "Mouse Over" handler to rectangle
	nodeLua[index].mousemove(changeCursor);

	//Attach "Drag" handlers to rectangle
	nodeLua[index].drag(dragMove, dragStart, dragEnd);

	//Attach "Click" handlers to rectangle
	nodeLua[index].click(selectNode);

	if (nodeURI != null) {
		//Attach "DoubleClick" handlers to rectangle
		nodeLua[index].dblclick(function() { 
				URI = nodeURI + "?" + "title=" + this.attr('title') 
					+ "&" + "type=" + this.data('type')
					+ "&" + "index=" + this.data('index')
					+ "&" + "x=" + this.attr('x')
					+ "&" + "y=" + this.attr('y')
					+ "&" + "w=" + this.attr('width')
					+ "&" + "h=" + this.attr('height')
					+ "&" + "xar=" + xar
					+ "&" + "yar=" + yar
					+ "&" + "assetname=" + backgroundRectTitle
					;
				targetURINode(URI); 
			});
		//nodeLua[index].dblclick(targetURINode("echo.php"));
	}
	return index;
};

var targetURINode = function(iframeURI) { 
	parent.property.location.href=iframeURI;
};


var selectNode = function(){

	if (this != backgroundRect) {
	   //if (selected == backgroundRect) {
        	if (selected != null) {
                	//change attributes
                	selected.attr({
                        	'stroke' : selectedStroke,
                        	'stroke-width' : selectedStrokeW,
	      			'stroke-dasharray' : [""]
                	});
        	}
		selectedStroke = this.attr('stroke');
		selectedStrokeW = this.attr('stroke-width');
        	this.attr({
              		'stroke' : 'black',
              		'stroke-width' : 1, 
	      		'stroke-dasharray' : ["--"]
        	});  
        	selected = this;
	}
	else
	{
	   if (selected != backgroundRect) {
                selected.attr({
                       	'stroke' : selectedStroke,
                       	'stroke-width' : selectedStrokeW,
	      		'stroke-dasharray' : [""]
                });
           selected = this;
	   }
	}
	if(selected == backgroundRect) {
		URI = nodeURI + "?" + "title=" + this.attr('title') 
			+ "&" + "type=" + this.data('type')
			+ "&" + "index=" + this.data('index')
			+ "&" + "x=" + this.attr('x')
			+ "&" + "y=" + this.attr('y')
			+ "&" + "w=" + this.attr('width')
			+ "&" + "h=" + this.attr('height')
			+ "&" + "xar=" + xar
			+ "&" + "yar=" + yar
			+ "&" + "assetname=" + backgroundRectTitle
			+ "&" + "id=" + backgroundRect.id
			;
	} else {
		URI = nodeURI + "?" + "title=" + this.attr('title') 
			+ "&" + "type=" + this.data('type')
			+ "&" + "index=" + this.data('index')
			+ "&" + "x=" + this.attr('x')
			+ "&" + "y=" + this.attr('y')
			+ "&" + "w=" + this.attr('width')
			+ "&" + "h=" + this.attr('height')
			+ "&" + "xar=" + xar
			+ "&" + "yar=" + yar
			+ "&" + "assetname=" + backgroundRectTitle
			;
	}
	targetURINode(URI); 
	console.log(selected.attr('title'));
};

var removeNode = function() {
	console.log(selected.attr('title'));
	if (selected != backgroundRect) {
		nodeIndex = selected.data('index');
		var x = confirm("Removing " + selected.attr('title') + "?");
		if (x) {
			URI = nodeURI + "?" + "title=" + backgroundRect.attr('title') 
				+ "&" + "type=" + backgroundRect.data('type')
				+ "&" + "index=" + backgroundRect.data('index')
				+ "&" + "x=" + backgroundRect.attr('x')
				+ "&" + "y=" + backgroundRect.attr('y')
				+ "&" + "w=" + backgroundRect.attr('width')
				+ "&" + "h=" + backgroundRect.attr('height')
				+ "&" + "xar=" + xar
				+ "&" + "yar=" + yar
				+ "&" + "assetname=" + backgroundRectTitle
				+ "&" + "childName=" + selected.attr('title')
				+ "&" + "id=" + backgroundRect.id
				;
			selected.removeData();
			selected.remove();
			nodeLua[nodeIndex] = null;
			selected = backgroundRect;
			targetURINode(URI); 
		}
	}
};


	var dragStart = function() {

		// Save some starting values
                this.ox = this.attr('x');
                this.oy = this.attr('y');
                this.ow = this.attr('width');
                this.oh = this.attr('height');
                        
                        this.dragging = true;
                };

/*
		var dataShow = function() {
			var assetName = this.data('assetName');
			var assetOrder = this.data('assetOrder');
			alert(assetName+" "+assetOrder);
		};
*/

                var dragMove = function(dx, dy) {

                        // Inspect cursor to determine which resize/move process to use
                        switch (this.attr('cursor')) {

                                case 'nw-resize' :
                                        this.attr({
                                                x: this.ox + dx, 
                                                y: this.oy + dy, 
                                                width: this.ow - dx, 
                                                height: this.oh - dy
                                        });
                                        break;

                                case 'n-resize':
                                        this.attr({
                                                y: this.oy + dy,
                                                height: this.oh - dy
                                        });
                                        break;

                                case 'ne-resize' :
                                        this.attr({ 
                                                y: this.oy + dy , 
                                                width: this.ow + dx, 
                                                height: this.oh - dy
                                        });
                                        break;
				case 'w-resize':
					this.attr({
                                                x: this.ox + dx,
                                                width: this.ow - dx
                                        });
				break;

                                case 'se-resize' :
                                        this.attr({
                                                width: this.ow + dx, 
                                                height: this.oh + dy
                                        });
                                        break;

				case 'e-resize':
                                        this.attr({
						width: this.ow + dx
					});
                                        break;

                                case 'sw-resize' :
                                        this.attr({ 
                                                x: this.ox + dx, 
                                                width: this.ow - dx, 
                                                height: this.oh + dy
                                        });
                                        break;

				case 's-resize':
					this.attr({
						height: this.oh + dy
                                        });
                                        break;

                                default :
                                        this.attr({
                                                x: this.ox + dx, 
                                                y: this.oy + dy
                                        });
                                        break;

                        }
                };
                var dragEnd = function() {
                        this.dragging = false;
                };

                var changeCursor = function(e, mouseX, mouseY) {

                        // Don't change cursor during a drag operation
                        if (this.dragging === true) {
                                return;
                        }

                        // X,Y Coordinates relative to shape's orgin
                        var relativeX = mouseX - $('#paper').offset().left - this.attr('x');
                        var relativeY = mouseY - $('#paper').offset().top - this.attr('y');

                        var shapeWidth = this.attr('width');
                        var shapeHeight = this.attr('height');

                        var resizeBorder = 10;

                        // Change cursor
                        if (relativeX < resizeBorder && relativeY < resizeBorder) { 
                                this.attr('cursor', 'nw-resize');
                        } else if (relativeX > shapeWidth-resizeBorder && relativeY < resizeBorder) { 
                                this.attr('cursor', 'ne-resize');
                        } else if (relativeX > shapeWidth-resizeBorder && relativeY > shapeHeight-resizeBorder) { 
                                this.attr('cursor', 'se-resize');
                        } else if (relativeX < resizeBorder && relativeY > shapeHeight-resizeBorder) { 
                                this.attr('cursor', 'sw-resize');
                        } else { 
                                this.attr('cursor', 'move');
                        }
			//showCoordinate;
			var paperX = (mouseX - $('#paper').offset().left) * xar | 0; 
			//var paperX = (mouseX - $('#paper').offset().left) * 2.4; 
			var paperY = (mouseY - $('#paper').offset().top) * yar | 0; 
			//var paperY = (mouseY - $('#paper').offset().top) * 2.4; 
			here.textContent = paperX + ","+ paperY;
                };
/*
                var changeCursor = function(e, mouseX, mouseY) {
                        if (this.dragging) {
                                return;
                        }
                        var side = sideDection(e, this);
			console.log(side);
                        // if the user's mouse is along the edge we want resize
                        if (side) {
                                this.state = 'resizable';
                        }
                        // else it's towards the middle and we want to move
                        else {
                                this.state = 'movable';
                        }
                        var cursor = (side) ? side + '-resize' : 'move';
                        this.attr('cursor', cursor);
                };
*/

                var sideDection = function(event, ct) {
                        var ctFactor = 2;
                        var directions = {
                                n: Math.abs(event.offsetY - ct.attr('y')) <= ctFactor,
                                s: Math.abs(event.offsetY - (ct.attr('height') + ct.attr('y'))) <= ctFactor,
                                e: Math.abs(event.offsetX - (ct.attr('width') + ct.attr('x'))) <= ctFactor,
                                w: Math.abs(event.offsetX - ct.attr('x')) <= ctFactor
                        },side = '';
                        for (var key in directions) { // loop through all 4 sides and concate the ones that are true
                                if (directions.hasOwnProperty(key)) {
                                        if (directions[key]) {
                                                side = side + key;
                                        }
                                }
                        }
                        return side;
                };

                var showCoordinate = function(e, mouseX, mouseY) {
			//var paperX = mouseX - $('#paper').offset().left; 
			var paperX = (mouseX - $('#paper').offset().left) * xar | 0; 
			//var paperY = mouseY - $('#paper').offset().top; 
			var paperY = (mouseY - $('#paper').offset().top) * yar | 0; 
			here.textContent = paperX + ","+ paperY;
			return true;
		};

/*
var saveClits = function(canvas=NodeCanvas) {
	var json = canvas.toJSON();
	alert(json); // so far I get the alert containing valid JSON text
	$.post("include/tot.php", {json: JSON.stringify(json)}, function(data){alert(data);});
};
*/

var saveAsset = function(canvas=NodeCanvas) {
	assetName = backgroundRectTitle;
	//var assetDesc = prompt("Saving Asset \"" + assetName + "\". Add description?");
	assetDesc = assetName;
	if(assetDesc != null) {
		//backgroundRect.data({
		//	'description' : assetDesc
		//	});
		var json = canvas.toJSON();

		$.ajax ({
  			type : "POST",
  			url : "include/saveAsset.php",
  			dataType: "text",
  			async: false,
  			data: {
				json: JSON.stringify(json),
				assetName: assetName
			},
  			success: function(response){ alert("Asset \"" + response + "\" is saved.")},
  			//success: function(response){ alert("Asset \"" + assetDesc + "\" is saved.")},
  			error: function(){ alert("Unexpected Error!")}
		});
	}
	else
	{
		alert("Not Saved!");
	}
};

var publishToServer = function(assetName=backgroundRectTitle) {
        $.ajax ({
                type : "POST",
                url : "include/publishToServer.php",
                dataType: "text",
                async: false,
                data: {
                         assetName: assetName
                },
                success: function(response){ alert("Asset \"" + response + "\" is published to Server.")},
                error: function(){ alert("Unexpected Error!")}
        });
};

/*
		function (e) {
    			var httpRequest = new XMLHttpRequest();
    			httpRequest.onreadystatechange = function() {
        			if (httpRequest.readyState === 4) {
            				if (httpRequest.status === 200) {
                				var msg = JSON.parse(httpRequest.responseText);

                				// do stuff, for example show a popup

            				} else {

                				// fail

            				}
        			}
    			};
    			httpRequest.open('GET', url);
    			httpRequest.send();
		}

*/
