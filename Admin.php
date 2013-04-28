<?php

class tWi_Admin {
  
  public function __construct(){
    add_action('admin_init', array($this, 'admin_init'));
  }
    
  public function admin_init() {
    if ( current_user_can('edit_posts') && current_user_can('edit_pages') ){
      // Add only in Rich Editor mode
      if ( get_user_option('rich_editing') == 'true') {
        add_filter('tiny_mce_version', array(&$this, 'mce_version') ); // prevent caching
        add_filter('mce_external_plugins', array($this, 'mce_external_plugins'));
        add_filter('mce_buttons', array($this, 'mce_buttons'));
      }
      add_action('admin_enqueue_scripts',  array($this, 'admin_enqueue_scripts'));
    }
  }
  
  public function admin_enqueue_scripts(){
    wp_enqueue_script('jquery');
    wp_localize_script( 'jquery', 'widgetinstance', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'BasePath' => includes_url() ) );
  }
  
  public function mce_external_plugins($plugins){
   $plugins['widgetinstance'] =  plugins_url('tinymce.js', WIDGETINSTANCE_FILE); 
   return $plugins;
  }
  public function mce_buttons($buttons){
    array_push($buttons, "separator", "widgetinstance");
    return $buttons;
  }
  public function mce_version($version) {
    return ++$version;
  }
   
}