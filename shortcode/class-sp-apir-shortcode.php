<?php

class SP_APIR_SHORTCODE extends SP_APIR_BASE {

  protected $shortcode_name;

  function __construct(){
    add_action( 'wp_enqueue_scripts', array( $this, 'assets') ); // LOAD ASSETS
    add_shortcode( $this->shortcode_name, array( $this, 'main_shortcode' ), 100 );
	}

  function assets(){
    // ENQUEUE STYLES
    wp_enqueue_style('sp-apir-sc-css', SP_APIR_URI.'assets/css/shortcode.css', array(), SP_APIR_VERSION );
  }

  /**
	* GETTER AND SETTER FUNCTIONS
	*/
  function get_default_atts(){
    return array();
  }

  function get_shortcode_atts( $atts ){
    return shortcode_atts( $this->get_default_atts(), $atts, $this->shortcode_name );
  }

  function get_template( $template_name ){
    return SP_APIR_PATH."shortcode/templates/$template_name.php";
  }

  function get_cache_key( $atts ){
    $atts      = $this->get_shortcode_atts( $atts );
    $cache_key = $this->shortcode_name.'_'.substr( md5( json_encode( $atts ) ), 0, 8 );
    return $cache_key;
  }

  function get_cache( $atts ){
    $cache_key = $this->get_cache_key( $atts );
    return get_transient( $cache_key ); // GET VALUE FROM WORDPRESS CACHE
  }

  function set_cache( $data, $atts ){
    $cache_key  = $this->get_cache_key( $atts );
    $cache_time = (int) $atts['cache'] * HOUR_IN_SECONDS;
    set_transient( $cache_key, $data, $cache_time ); // STORE VALUE IN CACHE FOR HOURS
  }

  // TO BE IMPLEMENTED BY CHILD CLASSES - HANDLES SHORTCODE CREATION
  function main_shortcode( $atts ){}

}
