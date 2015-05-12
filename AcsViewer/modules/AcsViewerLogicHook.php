<?php
class AcsViewerLogicHook {
	function openViewer($event, $arguments) {
		echo '<script type="text/javascript">

			window.onclick = hrefEvent;

			function PopupCenter(url, title, w, h) {
			    // Fixes dual-screen position 
			    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
			    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

			    width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
			    height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

			    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
			    var top = ((height / 2) - (h / 2)) + dualScreenTop;
			    var newWindow = window.open(url, title, "scrollbars=yes, width=" + w + ", height=" + h + ", top=" + top + ", left=" + left);

			    // Puts focus on the newWindow
			    if (window.focus) {
			        newWindow.focus();
			    }
			}

			function hrefEvent(e){
				e = e || window.event;
				var t = e.target || e.srcElement
				if ( t.href ){
					//alert ( t.name + "\n" + t.href + "\n" + t.className);
					var targetString = "entryPoint=download&id=";
					var n = t.href.indexOf(targetString);
					if (n > 0) {
						n += targetString.length; //beginning to file id				
						var fileId = t.href.substr(n, 36);
						var url = "index.php?entryPoint=acsViewer&id="+fileId;
						PopupCenter(url, "ACS Viewer", 775, 700);	
						return false; /* needed to avoid the href execution */
					}
				}
			}
		</script>';
    }
}