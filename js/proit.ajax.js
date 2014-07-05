//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
    {
       
        if( !$('#imageInput').val()) //check empty input filed
        {
            $("#output").html("Are you kidding me?");
            return false
        }
       
        var fsize = $('#imageInput')[0].files[0].size; //get file size
        var ftype = $('#imageInput')[0].files[0].type; // get file type
       

        //allow only valid image file types
        switch(ftype)
        {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                break;
            default:
                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
                return false
        }
       
        //Allowed file size is less than 1 MB (1048576)
        if(fsize>1048576)
        {
            $("#output").html("<b>"+fsize +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
            return false
        }
               
        $('#submit-btn').hide(); //hide submit button
        $('#loading-img').show(); //hide submit button
        $("#output").html("");  
    }
    else
    {
        //Output error to older unsupported browsers that doesn't support HTML5 File API
        $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
        return false;
    }
}


function OnProgress(event, position, total, percentComplete)
{
    //Progress bar
    progressbar.width(percentComplete + '%') //update progressbar percent complete
    statustxt.html(percentComplete + '%'); //update status text
    if(percentComplete>50)
        {
            statustxt.css('color','#fff'); //change status text to white after 50%
        }
}

var basename = function(path) {
   	return path.split('/').reverse()[0];
};


var deleteFile = function(filename) {
	var confirmDelete = confirm("Delete " + basename(filename) + "?");

	if (confirmDelete) {
	$.ajax ({
		type : "POST",
		url : "deleteFile.php",
		dataType: "text",
		//async: false,
		data: {
			filename: filename
		},
		success: function(response){removeElement(basename(filename))},
		error: function(){ alert("Unexpected Error!")}
	});
	}
};


var removeElement = function(element) {
    var elem = document.getElementById(element);
    elem.parentNode.removeChild(elem);
    return false;
};

function checkRefresh()
{
	// Get the time now and convert to UTC seconds
	var today = new Date();
	var now = today.getUTCSeconds();

	// Get the cookie
	var cookie = document.cookie;
	var cookieArray = cookie.split('; ');

	// Parse the cookies: get the stored time
	for(var loop=0; loop < cookieArray.length; loop++)
	{
		var nameValue = cookieArray[loop].split('=');
		// Get the cookie time stamp
		if( nameValue[0].toString() == 'SHTS' )
		{
			var cookieTime = parseInt( nameValue[1] );
		}
		// Get the cookie page
		else if( nameValue[0].toString() == 'SHTSP' )
		{
			var cookieName = nameValue[1];
		}
	}

	if( cookieName &&
		cookieTime &&
		cookieName == escape(location.href) &&
		Math.abs(now - cookieTime) < 5 )
	{
		// Refresh detected

		// Insert code here representing what to do on
		// a refresh

		// If you would like to toggle so this refresh code
		// is executed on every OTHER refresh, then 
		// uncomment the following line
		// refresh_prepare = 0; 
		confirm("Refresh is detected!");
	}	

	// You may want to add code in an else here special 
	// for fresh page loads
}

function prepareForRefresh()
{
	if( refresh_prepare > 0 )
	{
		// Turn refresh detection on so that if this
		// page gets quickly loaded, we know it's a refresh
		var today = new Date();
		var now = today.getUTCSeconds();
		document.cookie = 'SHTS=' + now + ';';
		document.cookie = 'SHTSP=' + escape(location.href) + ';';
	}
	else
	{
		// Refresh detection has been disabled
		document.cookie = 'SHTS=;';
		document.cookie = 'SHTSP=;';
	}
}

function disableRefreshDetection()
{
	// The next page will look like a refresh but it actually
	// won't be, so turn refresh detection off.
	refresh_prepare = 0;

	// Also return true so this can be placed in onSubmits
	// without fear of any problems.
	return true;
} 

// By default, turn refresh detection on
var refresh_prepare = 1;
