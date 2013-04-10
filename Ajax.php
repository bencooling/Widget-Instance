<?php

class tWi_Ajax {
  
  public function __construct(){
    add_action('wp_ajax_getWidgets', array($this, 'getWidgets'));
    add_action('wp_ajax_nopriv_getWidgets', array($this, 'getWidgets'));
  }

  public function getWidgets(){
    // echo json_encode(wp_get_sidebars_widgets());

    global $wp_registered_widgets;
    $sidebarWidgets = wp_get_sidebars_widgets();
    $widgetsWithTitleBySidebar = array();
    foreach($sidebarWidgets as $sidebar => $widgets){
      $widgetsWithTitleBySidebar[$sidebar] = array();
      foreach($widgets as $widget_id){
        $callback = $wp_registered_widgets[$widget_id]['callback'];
        $number = $wp_registered_widgets[$widget_id]['params'][0]['number'];
        $settings = $callback[0]->get_settings();
        $title = $settings[$number]['title'];
        array_push($widgetsWithTitleBySidebar[$sidebar], array('id'=>$widget_id, 'title'=>$title));
      }
    }
    echo json_encode($widgetsWithTitleBySidebar);

    exit;
  }
  
}