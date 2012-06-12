<?php
/*
Plugin Name: Widget Instance
Plugin URI: http://bcooling.com.au
Description: Display/output a specific widget instance using either a: short code, function, action or wysiwyg button
Version: 0.5
Author: Ben Cooling
Author URI: http://bcooling.com.au
License: Copyright Ben Cooling
*/

/**
 * 
 * Bootstrap file for plugin
 * 
 */

// Plugin Constants
define('WIDGETINSTANCE_PREFIX', 'tWi_');
define('WIDGETINSTANCE_FILE', __FILE__);
define('WIDGETINSTANCE_DIR_PATH', plugin_dir_path(__FILE__));
define('WIDGETINSTANCE_AJAX_CLASS', 'Ajax');
define('WIDGETINSTANCE_ADMIN_CLASS', 'Admin');
define('WIDGETINSTANCE_PUBLIC_CLASS', 'Public');

// Determine context for plugin
if ( is_admin() ) {
  if ( defined('DOING_AJAX') && DOING_AJAX ){
    $file = WIDGETINSTANCE_AJAX_CLASS;
  }
  else {
    $file = WIDGETINSTANCE_ADMIN_CLASS;
  }
}
else {
  $file = WIDGETINSTANCE_PUBLIC_CLASS;
}

// Instantiate required plugin controller
$className = WIDGETINSTANCE_PREFIX . $file;
if (! class_exists($className) ){
  require( WIDGETINSTANCE_DIR_PATH . $file . '.php');
}

$tWi_Plugin = new $className;

if ($file===WIDGETINSTANCE_PUBLIC_CLASS){
  function get_the_widget_instance($widget_id){
    ob_start();
    global $tWi_Plugin;
    $tWi_Plugin->widget_instance($widget_id);
    $o = ob_get_contents();
    ob_end_clean();
    return $o;
  }
  function the_widget_instance($widget_id){
    global $tWi_Plugin;
    $tWi_Plugin->widget_instance($widget_id);
  }
}
