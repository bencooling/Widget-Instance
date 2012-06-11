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

// Determine context for plugin
if ( is_admin() ) {
  if ( defined('DOING_AJAX') && DOING_AJAX ){
    $file = 'Ajax';
  }
  else {
    $file = 'Admin';
  }
}
else {
  $file = 'Public';
}

// Instantiate required plugin controller
$className = WIDGETINSTANCE_PREFIX . $file;
if (! class_exists($className) ){
  require( WIDGETINSTANCE_DIR_PATH . $file . '.php');
}

$tWi_Plugin = new $className();

// Utility global functions
if ($file==='Public'){
  function get_the_widget_instance($widget_id){
    ob_start();
    $tWi_Plugin->my_widget_instance($widget_id);
    $o = ob_get_contents();
    ob_end_clean();
    return $o;
  }
  function the_widget_instance($widget_id){
    $tWi_Plugin->my_widget_instance($widget_id);
  }
}