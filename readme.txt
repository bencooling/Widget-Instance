=== Plugin Name ===
Contributors: global_1981
Donate link: http://bcooling.com.au
Tags: widget, widgets, display widget, widget instance
Requires at least: 2.9.1
Tested up to: 3.5.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display/output a specific widget instance using either a shortcode, function, action or wysiwyg button.

== Description ==

Widgets are normally displayed as part of a sidebar using the dynamic_sidebar()
function. There is the_widget function for static widgets, but there is no
equivalent for specific widgets configured in the Appearance > Widgets area. 

The Widget Instance plugin empowers Wordpress users of all abilities to display
these widgets outside of the sidebars they have been assigned to.

Features
--------
1. A wysiwyg editor button for selecting available widgets,
2. A shortcode [widget_instance id="[widget_id]"],
3. A theme action do_action('widget_instance', [widget_id]) and finally
4. Utility functions for developers get_widget_instance and widget_instance

Usage
-----
* [widget_instance id="[widget_id]"]
* do_action('widget_instance', '[widget_id]');
* the_widget_instance('[widget_id]');
* get_the_widget_instance('[widget_id]');


== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `widget-instance` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Within the editor, you can use the Widget Instance editor button to select 
from available widgets or enter a shortcode following the syntax: [widget_instance id="[widget_id]"]
1. Optional step: If you would like to retain the sidebar format of the widget, check the Include Sidebar format checkbox 
1. Within template files you can use the following php snippets:

* Action: do_action('widget_instance', '[widget_id]');
* Function: the_widget_instance('[widget_id]');
* Function: get_the_widget_instance('[widget_id]');


== Frequently Asked Questions ==

= How do I get the widget id? =

Of course the editor button automagically retrieves all the available widgets 
(and their ids) for you, but if you are using one of the PHP functions, you can
get the available widget ids by looping over the array returned by the function 
wp_get_sidebars_widgets()


== Screenshots ==

1. The Widget Instance editor button
2. The editor dialog for inserting a specific widget instance


== Changelog ==

= 0.9.2 =
* Added javascript loader, fix for wordpress installs where wp-includes url is not in the root.

= 0.9.1 =
* Can now select a widget by it's title as well as its id. The title is in parenthesis after the id.

= 0.9 =
* Tested on 3.5.1
* Fixed php warnign typo

= 0.8 =
* Tested on 3.4.1
* Added option for including sidebar formatting
* The widget's title will now include the sidebar title markup (More useful than having a plain text title)

= 0.5 =
* Initial release
