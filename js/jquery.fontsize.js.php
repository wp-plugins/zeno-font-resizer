<?php
$parent = '../';
$tmp = '';
while (!function_exists('get_option')) {
    if(is_file($tmp . "wp-config.php"))
        @require_once($tmp . "wp-config.php");
    $tmp .= $parent;
}
$fontResizer = get_option('fontResizer');
$fontResizer_element = $fontResizer;
if($fontResizer == "innerbody") {
    $fontResizer_element = "div#innerbody";
} elseif($fontResizer == "ownid") {
    $fontResizer_element = "div#" . get_option('fontResizer_ownid');
} elseif($fontResizer == "ownelement") {
    $fontResizer_element = get_option('fontResizer_ownelement');
}
?>
jQuery.fn.fontresizermanager = function () {
	var startFontSize = parseFloat(jQuery("<?php echo $fontResizer_element; ?>").css("font-size"));
	var savedSize = jQuery.cookie('fontSize');
	if(savedSize != "") {
		jQuery('<?php echo $fontResizer_element; ?>').css("font-size", savedSize + "px");
	}
	jQuery('.fontresizermanager_add').css("cursor","pointer");
	jQuery('.fontresizermanager_minus').css("cursor","pointer");
	jQuery('.fontresizermanager_reset').css("cursor","pointer");
	jQuery('.fontresizermanager_add').click(function() {
		var newFontSize = parseFloat(jQuery("<?php echo $fontResizer_element; ?>").css("font-size"))
		newFontSize=newFontSize+1.6;
		jQuery('<?php echo $fontResizer_element; ?>').css("font-size",newFontSize);
		jQuery.cookie('fontSize', newFontSize, {expires: 31, path: '/'});
	});
	jQuery('.fontresizermanager_minus').click(function() {
		var newFontSize = parseFloat(jQuery("<?php echo $fontResizer_element; ?>").css("font-size"))
		newFontSize=newFontSize-1.6;
		jQuery('<?php echo $fontResizer_element; ?>').css("font-size",newFontSize);			 
		jQuery.cookie('fontSize', newFontSize, {expires: 31, path: '/'});
	});
	jQuery('.fontresizermanager_reset').click(function() {
		jQuery('<?php echo $fontResizer_element; ?>').css("font-size",startFontSize);			 
		jQuery.cookie('fontSize', startFontSize, {expires: 31, path: '/'});
	});
}
