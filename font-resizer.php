<?php
    /* 
    Plugin Name: Font Resizer
    Plugin URI: http://www.cubetech.ch/products/font-resizer
    Description: Font Resizer with jQuery and Cookies
    Author: cubetech.ch
    Version: 1.0.0
    Author URI: http://www.cubetech.ch/
    */

    function fontResizer_sortDependencys(){
    	$font_resizer_path = WP_PLUGIN_URL.'/font-resizer/js/';
        wp_register_script('fontResizer', $font_resizer_path.'jquery.fontsize.js');
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

    add_action('admin_init', 'fontresizer_admin_init');

    function fontresizer_admin_init(){
        register_setting( 'fontresizer_ops', 'fontresizer_footer' );
        register_setting( 'fontresizer_ops', 'fontresizer_sidebar' );
        register_setting( 'fontresizer_ops', 'fontresizer_style' );
    }

?>
