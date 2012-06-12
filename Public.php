<?php

class tWi_Public {
  
  public function __construct(){
    add_action('init',                array($this, 'init'));
  }
      
  public function widget_instance($widget_id) {
    global $wp_registered_widgets;
    
    // validation
    if (!array_key_exists($widget_id, $wp_registered_widgets)) {
      echo 'No widget found with that id'; return;
    }
    
    // default params
    $presentation = array("before_widget"=> "", "after_widget"=> "");
    $params = array_merge(
      array( array_merge( $presentation, array('widget_id' => $widget_id, 'widget_name' => $wp_registered_widgets[$widget_id]['name']) ) ),
      (array) $wp_registered_widgets[$widget_id]['params']
    );
    
    $params = apply_filters( 'dynamic_sidebar_params', $params ); // doesnt't add/minus from data

    $callback = $wp_registered_widgets[$widget_id]['callback'];

    if ( is_callable($callback) ) {
      call_user_func_array($callback, $params);
    }

  }
  
  /**
  *
  * Add shortcode
  * [widget_instance id='adrotater-5']
  * 
  */
  public function init(){
    add_shortcode( 'widget_instance', array($this, 'widget_instance_shortcode'));
  }
  
  public function widget_instance_shortcode($atts){
    extract(shortcode_atts(array('id' => ''), $atts));
    ob_start();
    $this->widget_instance($id);
    $o = ob_get_contents();
    ob_end_clean();
    return $o;
  }

}
