<?php
/**
 * @package  Calcy
 */
namespace Inc\Base;

class Activate
{
	public static function activate() {
		flush_rewrite_rules();
		global $wpdb, $wnm_db_version;
		$sql = array();

	    //SQL table
	    $table_1 = $wpdb->prefix . "clc_project_table";

	    if( $wpdb->get_var("show tables like '". $table_1 . "'") !== $table_1 ) { 

	        $sql[] = "CREATE TABLE ".$table_1." (
					project_Id int(30) NOT NULL AUTO_INCREMENT,
					project_title text(300) NOT NULL,
					project_shortcode varchar(150) NOT NULL,
					project_type varchar(40) NOT NULL,
					min_user int(20) NOT NULL,
					max_user int(20) NOT NULL,
					color_pack varchar(30) NOT NULL,
					currency_Id varchar(25) NOT NULL,
					project_publish_date datetime NOT NULL,
					project_modifiy_date datetime NOT NULL,
					project_status varchar(60) NOT NULL,
					range_slider_text varchar(60) NOT NULL,
					group_count_text varchar(60) NOT NULL,
					submit_button_text varchar(60) NOT NULL,
					submit_button_cls varchar(60) NOT NULL,
					UNIQUE KEY ID (project_Id),
					KEY ID_2 (project_Id)
					)";
	    }

	    $table_2 = $wpdb->prefix . "clc_package_table";
	    if( $wpdb->get_var("show tables like '". $table_2 . "'") !== $table_2 ) { 

	        $sql[] = "CREATE TABLE ".$table_2." (
					 package_id int(30) NOT NULL AUTO_INCREMENT,
					 package_title varchar(350) NOT NULL,
					 project_id varchar(200) NOT NULL,
					 package_price_type varchar(50) NOT NULL,
					 package_discount int(30) NOT NULL,
					 package_price int(20) NOT NULL,
					 package_deactivate tinyint(1) NOT NULL,
					 KEY ID (package_id)
					)";

	    }

	    $table_3 = $wpdb->prefix . "clc_group_table";
	    if( $wpdb->get_var("show tables like '". $table_3 . "'") !== $table_3 ) { 

	        $sql[] = "CREATE TABLE ".$table_3." (
					 group_id int(30) NOT NULL AUTO_INCREMENT,
					 group_name varchar(250) NOT NULL,
					 project_id varchar(30) NOT NULL,
					 group_position int(30) NOT NULL,
					 group_deactivate tinyint(1) NOT NULL,
					 KEY Group_ID (group_id)
					)";

	    }

	    $table_4 = $wpdb->prefix . "clc_function_table";
	    if( $wpdb->get_var("show tables like '". $table_4 . "'") !== $table_4 ) { 

	        $sql[] = "CREATE TABLE ".$table_4." (
					 func_id int(20) NOT NULL AUTO_INCREMENT,
					 func_name text NOT NULL,
					 group_id varchar(30) NOT NULL,
					 project_id varchar(30) NOT NULL,
					 func_position varchar(20) NOT NULL,
					 func_deactivate varchar(50) NOT NULL,
					 func_video text NOT NULL,
					 func_text text NOT NULL,
					 KEY Function_ID (func_id)
					)";

	    }

	    $table_5 = $wpdb->prefix . "clc_value_table";
	    if( $wpdb->get_var("show tables like '". $table_5 . "'") !== $table_1 ) { 

	        $sql[] = "CREATE TABLE ".$table_5." (
					 id int(30) NOT NULL AUTO_INCREMENT,
					 function_id varchar(30) NOT NULL,
					 project_id varchar(60) NOT NULL,
					 group_id varchar(50) NOT NULL,
					 icon_type varchar(15) NOT NULL,
					 icon_price varchar(50) NOT NULL,
					 package_id varchar(60) NOT NULL,
					 PRIMARY KEY (id)
					)";

	    }

	    $table_6 = $wpdb->prefix . "clc_user_step";
	    if( $wpdb->get_var("show tables like '". $table_6 . "'") !== $table_6 ) { 

	        $sql[] = "CREATE TABLE ".$table_6." (
					 id int(30) NOT NULL AUTO_INCREMENT,
					 project_id varchar(30) NOT NULL,
					 package_id varchar(30) NOT NULL,
					 user_step varchar(30) NOT NULL,
					 PRIMARY KEY (id)
					)";
	    }

	    $table_7 = $wpdb->prefix . "clc_user_price";
	    if( $wpdb->get_var("show tables like '". $table_7 . "'") !== $table_7 ) { 

	        $sql[] = "CREATE TABLE ".$table_7." (
					 id int(30) NOT NULL AUTO_INCREMENT,
					 project_id varchar(30) NOT NULL,
					 package_id varchar(30) NOT NULL,
					 user_id varchar(30) NOT NULL,
					 user_price varchar(30) NOT NULL,
					 price_fixed_discount varchar(30) NOT NULL,
					 price_percent_discount varchar(30) NOT NULL,
					 PRIMARY KEY (id)
					)";
	    }
	    $table_8 = $wpdb->prefix . "clc_func_user_price_table";
	    if( $wpdb->get_var("show tables like '". $table_8 . "'") !== $table_8 ) { 

	        $sql[] = "CREATE TABLE ".$table_8."  (
			 id int(11) NOT NULL AUTO_INCREMENT,
			 function_id varchar(30) NOT NULL,
			 package_id varchar(30) NOT NULL,
			 project_id varchar(30) NOT NULL,
			 user_count varchar(30) NOT NULL,
			 user_price varchar(30) NOT NULL,
			 fprice_discount_per varchar(30) NOT NULL,
			 fprice_discount_fix varchar(30) NOT NULL,
			 icon_price_min varchar(30) NOT NULL,
			 icon_price_max varchar(30) NOT NULL,
			 PRIMARY KEY (id)
			)";
	    }

		 if ( !empty($sql) ) {

	        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	        dbDelta($sql);
	        add_option("wnm_db_version", $wnm_db_version);

    	}
	    
	}
}