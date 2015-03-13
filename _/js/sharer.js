/*!
 * Sharer
 */

/*
 * Pop up window for share buttons
 */

 function shareFbWindow(specs){
	var url = "https://www.facebook.com/sharer/sharer.php?u=";
	window.open(url + specs, '', 'width=626,height=436');
 }
 
 function shareTwWindow(specs){
	window.open('http://twitter.com/share?text=' + specs, '', 'width=626,height=436');
 }
 
 function shareGoogleWindow(specs){
	window.open('https://plus.google.com/share?url=' + specs, '', 'width=626,height=436');
 }


 
