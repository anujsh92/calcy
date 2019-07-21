<?php 
/**
 * @package  AlecadddPlugin
 */
namespace Inc\Admins;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
* 
*/
class Admin extends BaseController
{
	public $settings;

	public $callbacks;

	public $pages = array();

	public $subpages = array();

	public function register() 
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setPages();

		$this->setSubpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Manage' )->addSubPages( $this->subpages )->register();
		
	}

	public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'Calcy Plugin', 
				'menu_title' => 'Calcy', 
				'capability' => 'manage_options', 
				'menu_slug' => 'calcy_plugin', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-store', 
				'position' => 110
			)
		);
	}

	public function setSubpages()
	{
		$pro_id = [];
		$this->subpages = array(
			array(
				'parent_slug' => 'calcy_plugin', 
				'page_title' => 'Create New Project', 
				'menu_title' => 'Add New', 
				'capability' => 'manage_options', 
				'menu_slug' => 'calcy_add_new', 
				'callback' => array( $this->callbacks, 'calcyCreate' )
			),
			array(
				'parent_slug' => 'calcy_plugin', 
				'page_title' => 'Calcy Settings', 
				'menu_title' => 'Settings', 
				'capability' => 'manage_options', 
				'menu_slug' => 'calcy_settings', 
				'callback' => array( $this->callbacks, 'calcySettings' )
			),
			array(
				'parent_slug' => 'calcy_add_new', 
				'page_title' => 'Update Project',
				'menu_title' => 'edit', 
				'capability' => 'manage_options', 
				'menu_slug' => "calcy_update_project.php",
				'callback' => array( $this->callbacks, 'calcyUpdate' )
			)
		);
	}

	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'calcy_plugin_settings',
				'option_name' => 'css_checkbox',
				'callback' => array( $this->callbacks, 'checkboxSanitize' )
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'calcy_css_setting',
				'title' => 'Settings Manager',
				'callback' => array( $this->callbacks, 'adminSectionManager' ),
				'page' => 'calcy_settings'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array(
			array(
				'id' => 'cpt_manager',
				'title' => 'CSS:',
				'callback' => array( $this->callbacks, 'checkboxField' ),
				'page' => 'calcy_settings',
				'section' => 'calcy_css_setting',
				'args' => array(
					'label_for' => 'css_checkbox',
					'class' => 'ui-toggle'
				)
			)
		);

		$this->settings->setFields( $args );
	}
}