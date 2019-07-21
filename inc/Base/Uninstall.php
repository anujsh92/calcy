<?php

/**
 * Trigger this file on Plugin uninstall
 *
 * @package  Calcy
 */
namespace Inc\Base;


class Uninstall
{
	public static function uninstall() {
		if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
			die;
		}

		// Access the database via SQL
		global $wpdb;
		$sql = array();
		$table_1 = $wpdb->prefix . "clc_project_table";
	    $table_2 = $wpdb->prefix . "clc_package_table";
	    $table_3 = $wpdb->prefix . "clc_group_table";
	    $table_4 = $wpdb->prefix . "clc_function_table";
	    $table_5 = $wpdb->prefix . "clc_value_table";
	    $table_6 = $wpdb->prefix . "clc_user_step";
	    $table_7 = $wpdb->prefix . "clc_user_price";
		$sql[] = "DROP TABLE IF EXISTS $table_1;";
		$sql[] = "DROP TABLE IF EXISTS $table_2;";
		$sql[] = "DROP TABLE IF EXISTS $table_3;";
		$sql[] = "DROP TABLE IF EXISTS $table_4;";
		$sql[] = "DROP TABLE IF EXISTS $table_5;";
		$sql[] = "DROP TABLE IF EXISTS $table_6;";
		$sql[] = "DROP TABLE IF EXISTS $table_7;";
		foreach ($sql as $key => $value) {
    		$wpdb->query($value);
    	}

		delete_option( 'calcy' );

		delete_site_option('calcy');
		
	}
}
