<?php 
/**
 * @package  Calcy
 */
namespace Inc\Base;

use Inc\Base\BaseController;

/**
* 
*/
class Enqueue extends BaseController
{
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action('wp_ajax_update_project', 'update_project');
		add_action('wp_ajax_nopriv_update_project', 'update_project');
		add_action('wp_enqueue_scripts',  array( $this, 'my_scripts' ));
	}
	
	function enqueue() {
		// enqueue all our scripts
		wp_enqueue_style( 'mypluginstyle', $this->plugin_url . 'inc/assets/style.css' );
		wp_enqueue_style( 'custom-fa', 'https://use.fontawesome.com/releases/v5.2.0/css/all.css' );
		wp_enqueue_script( 'calcyjquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js' );
		wp_enqueue_script( 'mypluginscript', $this->plugin_url . 'inc/assets/calcy.js' );
	}

	function my_scripts() {
      // enqueue all our scripts
		wp_enqueue_style( 'mypluginstyle', $this->plugin_url . 'assets/style.css' );
		wp_enqueue_style( 'custom-fa', 'https://use.fontawesome.com/releases/v5.2.0/css/all.css' );
		wp_enqueue_script( 'mypluginscript', $this->plugin_url . 'assets/script.js' );
 	}

	
}