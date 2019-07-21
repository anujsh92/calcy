<?php
/**
 * @package  Calcy
 */
namespace Inc\Base;

use Inc\Base\BaseController;

class ProjectShortcode extends BaseController
{
	public function register() 
	{
		add_shortcode( 'project-shortcode', array( $this, 'pro_shortcode' ) );
	}

	function pro_shortcode($atts) {
		 ob_start();
 
	    // define attributes and their defaults
	    extract( shortcode_atts( array (
	        'id' => '',
	    ), $atts ) );

     	require_once( "$this->plugin_path/inc/templates/project_shortcode.php" );
     	return ob_get_clean();
	}
}