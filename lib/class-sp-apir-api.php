<?php

class SP_APIR_API extends SP_APIR_BASE {

  private $rest_api_url;

  function __construct(){
    $this->set_api_url("https://youthkiawaaz.com/wp-json/wp/v2/posts/?per_page=6");
  }

  function get_posts(){
    $args = array(
	    'headers' => array(
	      'Content-Type' => 'application/json'
	    ),
	    'method'  => 'GET'
	  );

    $response = wp_remote_get( $this->get_api_url(), $args );

    /**
    * CHECK IF DATA IS VALID AND THE STATUS_CODE = 200
    * @return Array if valid, empty quotes '' otherwise.
    */
		if ( !is_wp_error( $response ) && ( 200 === wp_remote_retrieve_response_code( $response ) ) ){
      $body = wp_remote_retrieve_body( $response );
			$data = json_decode( $body );
      return $data;
    } else {
      return '';
    }

  }

  /**
	* GETTER AND SETTER FUNCTIONS
	*/
  function get_api_url(){ return $this->rest_api_url; }
  function set_api_url( $rest_api_url ){ $this->rest_api_url = $rest_api_url; }

}
