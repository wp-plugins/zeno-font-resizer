<?php
/*
Plugin Name: Zeno Font Resizer
Plugin URI: http://zenoweb.nl
Description: Zeno Font Resizer with jQuery and Cookies
Author: Marcel Pol
Version: 1.4.4
Author URI: http://zenoweb.nl/
Text Domain: ZENO_FR_TEXT
Domain Path: /lang/
*/

/*  Copyright 2010-2013  Cubetech GmbH
	Copyright 2015-2015  Marcel Pol      (email: marcel@zenoweb.nl)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// Plugin Version and Text-Domain.
define('ZENO_FR_VER', '1.4.4');
define('ZENO_FR_TEXT', 'ZENO_FR_TEXT');


/*
 * Add the options to WordPress if they don't exist.
 */
add_option('zeno_font_resizer',             'html', '', 'yes');
add_option('zeno_font_resizer_ownid',       '',     '', 'yes');
add_option('zeno_font_resizer_ownelement',  '',     '', 'yes');
add_option('zeno_font_resizer_resizeSteps', '1.6',  '', 'no' );
add_option('zeno_font_resizer_letter',      'A',    '', 'yes');
add_option('zeno_font_resizer_cookieTime',  '31',   '', 'no' );


/*
 * Register an administration page.
 */
function zeno_font_resizer_add_admin_page() {
	add_options_page( __( 'Zeno Font Resizer', ZENO_FR_TEXT ), __( 'Zeno Font Resizer', ZENO_FR_TEXT ), 'manage_options', 'zeno-font-resizer', 'zeno_font_resizer_admin_page');
}
add_action('admin_menu', 'zeno_font_resizer_add_admin_page');


/*
 * Generates the Settings Page.
 */
function zeno_font_resizer_admin_page() {
	?>
	<div class="wrap">
		<h2><?php _e( 'Zeno Font Resizer', ZENO_FR_TEXT ); ?></h2>
		<form method="post" action="options.php">
			<?php wp_nonce_field('update-options'); ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e( 'Basic Settings', ZENO_FR_TEXT ); ?></th>
					<td>
						<label>
							<input type="radio" name="zeno_font_resizer" value="html" <?php if (get_option('zeno_font_resizer')=="html") echo "checked"; ?> />
							<?php _e( 'Default setting, resize whole content in html tag (&lt;html&gt;All content of your site&lt;/html&gt;).', ZENO_FR_TEXT ); ?>
						</label><br />
						<label>
							<input type="radio" name="zeno_font_resizer" value="innerbody" <?php if (get_option('zeno_font_resizer')=="innerbody") echo "checked"; ?> />
							<?php _e( 'Use div with id innerbody (&lt;div id="innerbody"&gt;Resizable text&lt;/div&gt;).', ZENO_FR_TEXT ); ?>
						</label><br />
						<label>
							<input type="radio" name="zeno_font_resizer" value="ownid" <?php if (get_option('zeno_font_resizer')=="ownid") echo "checked"; ?> />
							<input type="text" name="zeno_font_resizer_ownid" value="<?php echo get_option('zeno_font_resizer_ownid'); ?>" /><br />
							<?php _e( 'Use your own div id (&lt;div id="yourid"&gt;Resizable text&lt;/div&gt;).', ZENO_FR_TEXT ); ?>
						</label><br />
						<label>
							<input type="radio" name="zeno_font_resizer" value="ownelement" <?php if (get_option('zeno_font_resizer')=="ownelement") echo "checked"; ?> />
							<input type="text" name="zeno_font_resizer_ownelement" value="<?php echo get_option('zeno_font_resizer_ownelement'); ?>" /><br />
							<?php _e( 'Use your own element (For example: for a span with class "bla" (&lt;span class="bla"&gt;Resizable text&lt;/span&gt;), enter the css definition, "span.bla" (without quotes)).', ZENO_FR_TEXT ); ?>
						</label><br />
					</td>
				</tr>
				<tr valig="top">
					<th scope="row"><?php _e( 'Resize Steps', ZENO_FR_TEXT ); ?></th>
					<td>
						<label for="zeno_font_resizer_resizeSteps">
							<input type="text" name="zeno_font_resizer_resizeSteps" value="<?php echo get_option('zeno_font_resizer_resizeSteps'); ?>" style="width: 3em"> <b><?php _e( 'px.', ZENO_FR_TEXT ); ?></b><br />
							<?php _e( 'Set the resize steps in pixel (default: 1.6px).', ZENO_FR_TEXT ); ?>
						</label>
					</td>
				</tr>
				<tr valig="top">
					<th scope="row"><?php _e( 'Resize Character', ZENO_FR_TEXT ); ?></th>
					<td>
						<label for="zeno_font_resizer_letter">
							<input type="text" name="zeno_font_resizer_letter" value="<?php echo get_option('zeno_font_resizer_letter'); ?>" maxlength="1" style="width: 3em"><br />
							<?php _e( 'Sets the letter to be displayed in the resizer in the website.', ZENO_FR_TEXT ); ?>
						</label>
					</td>
				</tr>
				<tr valig="top">
					<th scope="row"><?php _e( 'Cookie Settings', ZENO_FR_TEXT ); ?></th>
					<td>
						<label for="zeno_font_resizer_cookieTime">
							<input type="text" name="zeno_font_resizer_cookieTime" value="<?php echo get_option('zeno_font_resizer_cookieTime'); ?>" style="width: 3em"> <b><?php _e( 'days.', ZENO_FR_TEXT ); ?></b><br />
							<?php _e( 'Set the cookie store time (default: 31 days).', ZENO_FR_TEXT ); ?>
						</label>
					</td>
				</tr>
			</table>
			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="page_options" value="zeno_font_resizer,zeno_font_resizer_ownid,zeno_font_resizer_ownelement,zeno_font_resizer_resizeSteps,zeno_font_resizer_letter,zeno_font_resizer_cookieTime" />
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes', ZENO_FR_TEXT) ?>" />
			</p>
		</form>

		<h2><?php _e('About Zeno Font Resizer', ZENO_FR_TEXT); ?></h2>
		<div id="poststuff" class="postbox">
			<div class="widget" style="padding: 10px 20px;">
				<p><?php _e('This plugin is being maintained by Marcel Pol from', ZENO_FR_TEXT); ?>
					<a href="http://zenoweb.nl" target="_blank" title="ZenoWeb">ZenoWeb</a>.
				</p>

				<h3><?php _e('Review this plugin.', ZENO_FR_TEXT); ?></h3>
				<p><?php _e('If this plugin has any value to you, then please leave a review at', ZENO_FR_TEXT); ?>
					<a href="https://wordpress.org/support/view/plugin-reviews/zeno-font-resizer" target="_blank" title="<?php esc_attr_e('The plugin page at wordpress.org.', ZENO_FR_TEXT); ?>">
						<?php _e('the plugin page at wordpress.org', ZENO_FR_TEXT); ?></a>.
				</p>

				<h3><?php _e('Donate to the EFF.', ZENO_FR_TEXT); ?></h3>
				<p><?php _e('The Electronic Frontier Foundation is one of the few organisations that wants to keep the internet a free place.', ZENO_FR_TEXT); ?></p>
				<p><a href="https://supporters.eff.org/donate" target="_blank" title="<?php esc_attr_e('Please donate to the EFF.', ZENO_FR_TEXT); ?>"><?php _e('Please donate to the EFF.', ZENO_FR_TEXT); ?></a></p>

				<h3><?php _e('Donate to the maintainer.', ZENO_FR_TEXT); ?></h3>
				<p><?php _e('If you rather want to donate to the maintainer of the plugin, you can donate through PayPal.', ZENO_FR_TEXT); ?></p>
				<p><?php _e('Donate through', ZENO_FR_TEXT); ?> <a href="https://www.paypal.com" target="_blank" title="<?php esc_attr_e('Donate to the maintainer.', ZENO_FR_TEXT); ?>"><?php _e('PayPal', ZENO_FR_TEXT); ?></a>
					<?php _e('to', ZENO_FR_TEXT); ?> marcel@timelord.nl.
				</p>
			</div>
		</div>

	</div>
	<?php
}


/*
 * Enqueue the dependencies.
 */
function zeno_font_resizer_enqueue(){
	$zeno_font_resizer_path = plugins_url( 'js/', __FILE__ );
	wp_register_script('zeno_font_resizer_cookie',   $zeno_font_resizer_path . 'js.cookie.js', 'jquery', ZENO_FR_VER, true);
	wp_register_script('zeno_font_resizer_fontsize', $zeno_font_resizer_path . 'jquery.fontsize.js', 'jquery', ZENO_FR_VER, true);
	wp_enqueue_script('jquery');
	wp_enqueue_script('zeno_font_resizer_cookie');
	wp_enqueue_script('zeno_font_resizer_fontsize');
}
add_action('wp_enqueue_scripts', 'zeno_font_resizer_enqueue');


/*
 * Generate the font-resizer text on the frontend.
 * Used as template function for developers.
 * Parameter: $echo, boolean:
 *            - true: echo the template code (default).
 *            - false: return the template code.
 */
function zeno_font_resizer_place( $echo = true ) {
	$html = '
	<div class="zeno_font_resizer_container">
		<p class="zeno_font_resizer" style="text-align: center; font-weight: bold;">
			<span>
				<a href="#" class="zeno_font_resizer_minus" title="' . esc_attr__( 'Decrease font size', ZENO_FR_TEXT ) . '" style="font-size: 0.7em;">' . get_option('zeno_font_resizer_letter') . '</a>
				<a href="#" class="zeno_font_resizer_reset" title="' . esc_attr__( 'Reset font size', ZENO_FR_TEXT ) . '">' . get_option('zeno_font_resizer_letter') . '</a>
				<a href="#" class="zeno_font_resizer_add" title="' . esc_attr__( 'Increase font size', ZENO_FR_TEXT ) . '" style="font-size: 1.2em;">' . get_option('zeno_font_resizer_letter') . '</a>
			</span>
			<input type="hidden" id="zeno_font_resizer_value" value="' . get_option('zeno_font_resizer') . '" />
			<input type="hidden" id="zeno_font_resizer_ownid" value="' . get_option('zeno_font_resizer_ownid') . '" />
			<input type="hidden" id="zeno_font_resizer_ownelement" value="' . get_option('zeno_font_resizer_ownelement') . '" />
			<input type="hidden" id="zeno_font_resizer_resizeSteps" value="' . get_option('zeno_font_resizer_resizeSteps') . '" />
			<input type="hidden" id="zeno_font_resizer_cookieTime" value="' . get_option('zeno_font_resizer_cookieTime') . '" />
		</p>
	</div>
	';
	if ( $echo == true ) {
		echo $html;
	} else {
		return $html;
	}
}


/*
 * Add Settings link to the main Plugin page.
 */
function zeno_font_resizer_links( $links, $file ) {
	if ( $file == plugin_basename( dirname(__FILE__).'/zeno-font-resizer.php' ) ) {
		$links[] = '<a href="' . admin_url( 'options-general.php?page=zeno-font-resizer' ) . '">' . __( 'Settings', ZENO_FR_TEXT ) . '</a>';
	}
	return $links;
}
add_filter( 'plugin_action_links', 'zeno_font_resizer_links', 10, 2 );


/*
 * Load language files for frontend and backend.
 */
function zeno_font_resizer_load_lang() {
	load_plugin_textdomain( ZENO_FR_TEXT, false, plugin_basename(dirname(__FILE__)) . '/lang' );
}
add_action('plugins_loaded', 'zeno_font_resizer_load_lang');


/*
 * Delete the options when you uninstall the plugin.
 */
function zeno_font_resizer_uninstaller() {
	delete_option('zeno_font_resizer');
	delete_option('zeno_font_resizer_ownid');
	delete_option('zeno_font_resizer_ownelement');
	delete_option('zeno_font_resizer_resizeSteps');
	delete_option('zeno_font_resizer_letter');
	delete_option('zeno_font_resizer_cookieTime');
}
register_uninstall_hook( __FILE__, 'zeno_font_resizer_uninstaller' );


/* Load the widget */
include('widget.php');


