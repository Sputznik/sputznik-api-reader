<?php
/*
Plugin Name: Sputznik API Reader
Plugin URI: https://sputznik.com
Description: Sputznik API Reader
Version: 1.0.0
Author: Stephen Anil (Sputznik)
Author URI: https://sputznik.com
*/

if( ! defined( 'ABSPATH' ) ){ exit; }

/*  CONSTANTS */
if( !defined( 'SP_APIR_VERSION' ) ) {
  define( 'SP_APIR_VERSION', time() );
}

if( !defined( 'SP_APIR_PATH' ) ) {
  define( 'SP_APIR_PATH', plugin_dir_path( __FILE__ ) );
}

if( !defined( 'SP_APIR_URI' ) ) {
  define( 'SP_APIR_URI', plugin_dir_url( __DIR__ ).'sputznik-api-reader/' ); // ROOT URL
}

// INCLUDE FILES
$inc_files = array(
  'class-sp-apir-base.php',
  'lib/class-sp-apir-api.php',
  'shortcode/shortcode.php'
);

foreach( $inc_files as $inc_file ){ require_once( $inc_file ); }
