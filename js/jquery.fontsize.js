jQuery.fn.fontresizermanager = function () {
	var startFontSize = parseFloat(jQuery("div#innerbody").css("font-size"));
	var savedSize = jQuery.cookie('fontSize');
	if(savedSize != "") {
		jQuery('div#innerbody').css("font-size", savedSize + "px");
	}
	jQuery('.fontresizermanager_add').css("cursor","pointer");
	jQuery('.fontresizermanager_minus').css("cursor","pointer");
	jQuery('.fontresizermanager_reset').css("cursor","pointer");
	jQuery('.fontresizermanager_add').click(function() {
		var newFontSize = parseFloat(jQuery("div#innerbody").css("font-size"))
		newFontSize=newFontSize+1.6;
		jQuery('div#innerbody').css("font-size",newFontSize);
		jQuery.cookie('fontSize', newFontSize, {expires: 31, path: '/'});
	});
	jQuery('.fontresizermanager_minus').click(function() {
		var newFontSize = parseFloat(jQuery("div#innerbody").css("font-size"))
		newFontSize=newFontSize-1.6;
		jQuery('div#innerbody').css("font-size",newFontSize);			 
		jQuery.cookie('fontSize', newFontSize, {expires: 31, path: '/'});
	});
	jQuery('.fontresizermanager_reset').click(function() {
		jQuery('div#innerbody').css("font-size",startFontSize);			 
		jQuery.cookie('fontSize', startFontSize, {expires: 31, path: '/'});
	});
}
