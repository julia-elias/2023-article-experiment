<?php include 'inc/functions.php';?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iframe Test</title>
    <style>

        body {
            margin-top: 0;
            padding-top: 200px;
        }

        iframe {
            border: 1px solid #ddd;
        }


    </style>
</head>
<body>
<iframe id="cme-iframe" width="100%" height="10000" src="<?php echo get_site_url();?>/articles/hit-and-run"></iframe>

<script>

    window.addEventListener('message', CmeReceiveIframeMessage, false);

    // What to do when we receive a postMessage
    function CmeReceiveIframeMessage(event) {
        var iframe;
        // parse the JSON data
        var data = JSON.parse(event.data);
        // get the iframe
        var iframe = document.getElementById('cme-iframe');
        console.log(data)

        // find out what we need to do with it
        if(data.action === 'scrollTo') {

            // check the height of the parent window content
            // window.height

            scroll(0, data.scrollToPosition);

        }

        if(data.action === 'pageClick') {

            // scroll to the top of the iframe
            scroll(0, iframe.offsetTop);
        }
    }








/*
    // set the height of the iframe to the height of the client window
    function setFbStudyIframeHeight() {
        //document.getElementById('fb-iframe').style.height = window.innerHeight + 'px';
    }

    setFbStudyIframeHeight();

    // debounce function for resize
    var fbStudyResizeWindow = fbStudy_debounce(function() {
        setFbStudyIframeHeight();
    }, 250);
    // resize listener
    window.addEventListener('resize', fbStudyResizeWindow);

    function fbStudy_debounce(func, wait, immediate) {
    	var timeout;
    	return function() {
    		var context = this, args = arguments;
    		var later = function() {
    			timeout = null;
    			if (!immediate) func.apply(context, args);
    		};
    		var callNow = immediate && !timeout;
    		clearTimeout(timeout);
    		timeout = setTimeout(later, wait);
    		if (callNow) func.apply(context, args);
    	};
    };
    */
</script>
</body>
</html>
