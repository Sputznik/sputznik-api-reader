<?php

class SP_APIR_QUERY extends SP_APIR_SHORTCODE {

  function __construct(){

    $this->shortcode_name = 'sp_apir_query';

    parent::__construct();

  }

  function get_default_atts(){
    return array(
      'cache' =>  4
    );
  }

  function main_shortcode( $atts ){
    $posts = false;
		$atts = $this->get_shortcode_atts( $atts ); // GET ATTRIBUTES FROM SHORTCODE

    /* CHECK IF DATA EXISTS IN CACHE */
		if( isset( $atts['cache'] ) && $atts['cache'] && is_numeric( $atts['cache'] ) ){
			$posts = $this->get_cache( $atts );
		}

    // FETCH POSTS IF CACHE IS EMPTY
		if ( $posts === false ){
      $remote = SP_APIR_API::getInstance();
      $posts = $remote->get_posts();

      // SAVE API RESPONSE TO CACHE IF CACHE VALUE AND POST COUNT IS GREATER THAN ZERO
			if( isset( $atts['cache'] ) && !empty( $atts['cache'] ) && !empty( $posts ) && count( $posts ) ){
				$this->set_cache( $posts, $atts );
      }

		}

    // SHORTCODE OUTPUT
    ob_start();

    // CHECK IF DATA IS AN ARRAY WITH ATLEAST 1 OBJECT
    if( !empty( $posts ) && count( $posts ) ){
      $template = $this->get_template("sp-apir-query");

      if( file_exists( $template ) ){
        include( $template );
      } else {
        echo "Please select a template";
      }

    }

    return ob_get_clean();
  }

}

SP_APIR_QUERY::getInstance();
