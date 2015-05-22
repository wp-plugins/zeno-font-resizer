<?php
    /* 
    Plugin Name: Font Resizer
    Plugin URI: http://www.cubetech.ch/products/font-resizer
    Description: Font Resizer with jQuery and Cookies
    Author: cubetech.ch
    Version: 1.1.0
    Author URI: http://www.cubetech.ch/
    */

    add_action('admin_menu', 'fontResizer_addAdminPage');
    add_option('fontResizer', 'body', '', 'yes');
    add_option('fontResizer_ownid', '', '', 'yes');
    add_option('fontResizer_ownelement', '', '', 'yes');

    function fontResizer_addAdminPage() {
        add_options_page('font-resizer Options', 'font-resizer', 8, 'font-resizer', 'fontResizer_aMenu');
    }

    function fontResizer_aMenu() {
	?>
	<div class="wrap">
	    <h2>font-resizer</h2>
	    <form method="post" action="options.php">
	    <?php wp_nonce_field('update-options'); ?>
	    <table class="form-table">
		<tr valign="top">
		    <th scope="row">Basic Settings</th>
		    <td>
			<label for="fr_div">
			    <input type="radio" name="fontResizer" value="body" <?php if(get_option('fontResizer')=="body") echo "checked"; ?> />
			    Default setting, resize whole content in body tag (&lt;body&gt;All content of your site&lt;/body&gt;)
			</label><br />
			<label for="fr_div">
			    <input type="radio" name="fontResizer" value="innerbody" <?php if(get_option('fontResizer')=="innerbody") echo "checked"; ?> />
			    Use div with id innerbody (&lt;div id="innerbody"&gt;Resizable text&lt;/div&gt;)
			</label><br />
			<label for="fr_div">
			    <input type="radio" name="fontResizer" value="ownid" <?php if(get_option('fontResizer')=="ownid") echo "checked"; ?> /> <input type="text" name="fontResizer_ownid" value="<?php echo get_option('fontResizer_ownid'); ?>" /><br />
			    Use your own div id (&lt;div id="yourid"&gt;Resizable text&lt;/div&gt;)
			</label><br />
			<label for="fr_div">
			    <input type="radio" name="fontResizer" value="ownelement" <?php if(get_option('fontResizer')=="ownelement") echo "checked"; ?> /> <input type="text" name="fontResizer_ownelement" value="<?php echo get_option('fontResizer_ownelement'); ?>" /><br />
			    Use your own element (For example: for a span with class "bla" (&lt;span class="bla"&gt;Resizable text&lt;/span&gt;), enter the css definition, "span.bla" (without quotes))
			</label><br />
		    </td>
		</tr>
	    </table>
	    <input type="hidden" name="action" value="update" />
	    <input type="hidden" name="page_options" value="fontResizer,fontResizer_ownid,fontResizer_ownelement" />
	    <p class="submit">
	    	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	    </p>
	    </form>
	</div>
	<?	
    }

    function fontResizer_sortDependencys(){
    	$font_resizer_path = WP_PLUGIN_URL.'/font-resizer/js/';
        wp_register_script('fontResizer', $font_resizer_path.'jquery.fontsize.js.php');
        wp_register_script('fontResizerCookie', $font_resizer_path.'jquery.cookie.js');
        wp_register_script('fontResizerPlugin', $font_resizer_path.'main.js');
        wp_enqueue_script('jquery');
        wp_enqueue_script('fontResizerCookie');
        wp_enqueue_script('fontResizer');
        wp_enqueue_script('fontResizerPlugin');
    }

    function fontResizer_place($style = 'smooth'){
		$font_resizer_path = WP_PLUGIN_URL.'/font-resizer/img/';
		echo '<li class="fontmanager" style="text-align: center; font-weight: bold;">';
		echo '<a class="fontresizermanager_minus" title="Decrease font size" style="font-size: 0.7em;">A</a> ';
		echo '<a class="fontresizermanager_reset" title="Reset font size">A</a> ';
		echo '<a class="fontresizermanager_add" title="Increase font size" style="font-size: 1.2em;">A</a> ';
		echo '</li>';
    }
	

    function fontresizer_widget($args) {
        extract($args);
        fontResizer_place();
    }

    add_action('init', 'fontResizer_sortDependencys');
	
    register_sidebar_widget('Font Resizer','fontresizer_widget');

    register_uninstall_hook(__FILE__, 'fontResizer_uninstaller');

    function fontResizer_uninstaller() {
    	delete_option('fontResizer');
    	delete_option('fontResizer_ownid');
    	delete_option('fontResizer_ownelement');
    }

?>
