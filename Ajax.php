<?php

class tWi_Ajax {
  
  public function __construct(){
    add_action('wp_ajax_getWidgets', array($this, 'getWidgets'));
    add_action('wp_ajax_nopriv_getWidgets', array($this, 'getWidgets'));
  }

  public function getWidgets(){
    echo json_encode(wp_get_sidebars_widgets());
    exit;
  }
  
}