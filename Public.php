<?php

class tWi_Public {
  
 /**
  *
  * Add action 
  * 
  */
  public function __construct(){
    add_action('init', array($this, 'init'));
    add_action( 'widget_instance', array($this, 'widget_instance'), 10, 2 ); 
  }

 /**
  *
  * Add shortcode
  * 
  */
  public function init(){
    add_shortcode( 'widget_instance', array($this, 'widget_instance_shortcode'));
  }
  public function widget_instance_shortcode($atts){
    extract(shortcode_atts(array('id' => '', 'format'=>''), $atts));
    ob_start();
    $this->widget_instance($id, $format);
    $o = ob_get_contents();
    ob_end_clean();
    return $o;
  }

 /**
  *
  * Widget Instance Logic
  * Shortcodes, actions, template tags all invoke this method.
  * 
  */
  public function widget_instance($widget_id, $format=false) {
    global $wp_registered_widgets, $wp_registered_sidebars, $sidebars_widgets;
    
    // validation
    if (!array_key_exists($widget_id, $wp_registered_widgets)) {
      echo 'No widget found with that id'; return;
    }
    
    // find sidebar 
    foreach($sidebars_widgets as $sidebar => $sidebar_widget){
      foreach($sidebar_widget as $widget){
        if ($widget==$widget_id) $current_sidebar = $sidebar;
      }
    }

    $presentation = (isset($current_sidebar)) ? $wp_registered_sidebars[$current_sidebar] : 
      array('name' => '', 
            'id' => '',
            'description' => '',
            'class' => '',
            'before_widget'=> '',
            'after_widget'=> '',
            'before_title'=> '',
            'after_title' => '');

    // Clear formatting unless required
    if (!$format) { 
      $presentation['before_widget'] = '';
      $presentation['after_widget'] = '';
    }

    $params = array_merge(
      array( array_merge( $presentation, array('widget_id' => $widget_id, 'widget_name' => $wp_registered_widgets[$widget_id]['name']) ) ),
      (array) $wp_registered_widgets[$widget_id]['params']
    );

    // Substitute HTML id and class attributes into before_widget
    $classname_ = '';
    foreach ( (array) $wp_registered_widgets[$widget_id]['classname'] as $cn ) {
      if ( is_string($cn) )
        $classname_ .= '_' . $cn;
      elseif ( is_object($cn) )
        $classname_ .= '_' . get_class($cn);
    }
    $classname_ = ltrim($classname_, '_');
    $params[0]['before_widget'] = sprintf($params[0]['before_widget'], $widget_id, $classname_);

    $params = apply_filters( 'dynamic_sidebar_params', $params ); // doesnt't add/minus from data
    
    $callback = $wp_registered_widgets[$widget_id]['callback'];

    if ( is_callable($callback) ) {
      call_user_func_array($callback, $params);
    }

  }
  
}
