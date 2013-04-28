<?php
/*
Plugin Name: Widget Instance
Plugin URI: http://bcooling.com.au
Description: Display/output a specific widget instance using either a shortcode, function, action or wysiwyg button
Version: 0.9.2
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

$tWi_Plugin = new $className;

// template tags need to be in global space, otherwise this would belong in Public class. 
if ($file==='Public'){
  function get_the_widget_instance($widget_id, $format=false){
    ob_start();
    global $tWi_Plugin;
    $tWi_Plugin->widget_instance($widget_id, $format);
    $o = ob_get_contents();
    ob_end_clean();
    return $o;
  }
  function the_widget_instance($widget_id, $format=false){
    global $tWi_Plugin;
    $tWi_Plugin->widget_instance($widget_id, $format);
  }
}
