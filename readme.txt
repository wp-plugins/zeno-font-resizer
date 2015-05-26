=== Zeno Font Resizer ===
Contributors: mpol
Tags: font, text, size, increase, decrease, resizer, bigger, smaller, fonts, resize, change, widget, sidebar, accessibility
Requires at least: 2.7
Tested up to: 4.2
Stable tag: 1.4.2
License: GPLv2

Zeno Font Resizer allows the visitors of your website to change the font size of your text.

== Description ==

This plugin allows you to give the visitors of your site the option to change the font size of your text.

Features:

* Uses JavaScript and jQuery to set the fontsize.
* Settings are saved in a cookie, so the visitor sees the same fontsize on a revisit.
* Admin page to set which content is being resized, the resize steps and other options.
* You can use the standard widget or you can use code to add to your theme.
* Simple and Lightweight.

== Installation ==

1. Upload the directory `zeno-font-resizer` to the `/wp-content/plugins/` directory or install the plugin directly with the 'Install' function in the 'Plugins' menu in WordPress.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Add the sidebar widget through the 'Appearance / Widgets' menu in WordPress.
4. If you don't want to use the widget, you can use the template code somewhere in your template. Please check the FAQ.
5. Define which content should be resized on the 'Zeno Font Resizer' admin page (optional). If you are not familiar with html and css, select the body option (default). This would resize each content of your page.

== Screenshots ==

1. A productive example of the widget.
2. Adding the widget.
3. Settings page.

== Frequently Asked Questions ==

= How can I activate the function of the plugin? =
Go to the admin page of the plugin and select your option. If you are not familiar with html and css, select the body option (default). This would resize each content of your page.

= How can I use the plugin without the widget? =
Use this snippet of PHP code (in your theme or somewhere):

	<php
		if (function_exists('zeno_font_resizer_place')) {
			zeno_font_resizer_place();
		}
	?>

= How can I use the template code and do stuff with it? =
You can use the parameter '$echo = false' and the function will return the html-string:

	<php
		if (function_exists('zeno_font_resizer_place')) {
			$font_resizer = zeno_font_resizer_place( false );
			// do stuff with $font-resizer...
		}
	?>

= How can I change the color of the A's? =
With CSS in your theme.
Use something like:

	p.zeno_font_resizer > a {
		color: blue;
	}

= Are there more FAQ? =
Not yet, no. But feel free to contact me if you have a question.

== Changelog ==

= 1.4.2 =
* 2015-05-26
* Add 'return false' on click event.

= 1.4.1 =
* 2015-05-24
* Add $echo parameter to template code.

= 1.4.0 =
* 2015-05-24
* Redo widget properly.
* Update pot, nl_NL.

= 1.3.0 =
* 2015-05-22
* Forked from font-resizer.
* Capability for settingspage is manage_options.
* Radio buttons have working labels.
* Delete cookieTime option on uninstall.
* Add Copyright notice.
* Add Settings link to main Plugins page.
* Don't use WP_PLUGIN_URL for JavaScript enqueue.
* Add version to JavaScript enqueue.
* Only enqueue on frontend.
* Load JavaScript in footer.
* Update jQuery.cookie to js-cookie 1.5.1.
* Integrate main.js into jquery.fontsize.js to trim down on loaded files.
* Move screenshots from trunk to assets.
* Set list-style to none.
* Add href attribute for accessibility, tabbing works now.
* Add option to define your own letter, default is 'A'.
* Add header to the widget, but not the template function.
* Add maximum and minimum sizes (5 steps from startsize).
* Add possibility for translation.
* Add pot, nl_NL.

= 1.2.3 =
* Widget bug fix

= 1.2.2 =

* Added banner img

= 1.2.1 =

* Nothing relevant

= 1.2.0 =

* Fixed some deprecated functions

= 1.1.9 =

* Updated readme

= 1.1.7 =

* Little jquery bugfix for function ownid

= 1.1.6 =

* Fixed PHP problem

= 1.1.5 =

* Fixed problem with Internet Explorer

= 1.1.4 =

* Added option for cookie save time to admin pane
* Edited install instructions

= 1.1.3.1 =

* Added an answer to FAQ

= 1.1.3 =

* Fixed JavaScript issue with qTranslate
* Refactured jQuery scripts

= 1.1.2 =
* Added an option for changing the font resize steps
* Added comments to source code
* Cleaned up source code
* Changed css classes of the visible resizer element in the sidebar

= 1.1.1 =
* Bugfix for different directory structure (like language structure, yourdomain.tld/en/ for english)

= 1.1.0 =
* Added menu page
* Changed default resizable element from a div with id innerbody to body element
* Added uninstall hooks
* Added some answer to FAQ

= 1.0.0 =
* First stable version
* Publish the plugin


