<?php 
/**
 * @package  Calcy
 */

use Inc\Base\BaseController;
?>
<div class="wrap" style="float: left;width: 100%;">
	<h1>Add New Project</h1>

	<div class="all_field_container">
		<form  id="project_data" name="project_data" method="post" action="" enctype="multipart/form-data">
				<input type="text" name="project_title" id="project_title">
				<span>ID:</span><span>1245545</span>
				<div class="clear"></div>
				<div class="left_field_container">
					<div class="range_field_container">
						<div class="range_field"><input type="text" name="range_field_min" value="" placeholder="Min User|"></div>
						<div class="range_field"><input type="text" name="range_field_max" value="" placeholder="max User|"></div>
						
					</div>
					<div class="currency_type">
						<select class="currency_type_field" name="currency_type_field">
						  <option value="">&nbsp; Select Currency &nbsp;</option>
						  <option value="euro">Euro</option>
						  <option value="usd">USD</option>
						  <option value="gbp">GBP</option>
						  <option value="cad">CAD</option>
						</select>
					</div>
					<div class="pack_type">
						<select class="pack_type_field" name="pack_type_field">
						  <option value="">&nbsp; Select package Type &nbsp;</option>
						  <option value="weekly">Weekly</option>
						  <option value="monthly">Monthly</option>
						  <option value="yearly">Yearly</option>
						  <option value="onetime">OneTime</option>
						</select>
					</div>
				</div>
				<div class="right_field_container main_package_field" id="main_package_field">
					<div class="package_field" id="package1">
						<input type="text" name="package_name" value="" placeholder="Package Name |" ><span class="add_rem_icons"><i class="fa fa-plus-circle" id="pack_add_button" onclick="duplicate()"></i><i class="fa fa-minus-circle" id="pack_add_button" onclick="remove()"></i></span>
						<input type="button" name="pack_submit" class="button add_pack_price" value="+ Add Prices" onclick="showPriceClick()">
						<div class="price_container" id="price_container">
							<span class="price_container_text" style="">
								<p>Trage hier Deinen Preis pro user oder Preisstaffelung für Usergruppen ein. Hast du keine Preisstaffelung festgelegt, so rechnet der Slider Automatisch bis Einheit Max.</p>
							</span>
							<div class="user_price_cont" id="user_price_cont1">
								<div class="price_container_left">
									<div class="price_container_left_col">
										<input type="text" name="price_container_price" placeholder="Price " >
									</div>
									<div class="price_container_left_col">
										<input type="text" name="price_container_user" placeholder="User " >
									</div>
									<div class="price_container_left_col" style="display: none;">
										<input type="text" name="price_container_price_percent" placeholder="Discount %" >
									</div>
									<div class="price_container_left_col" style="display: none;">
										<input type="text" name="price_container_price_fixed" placeholder="Discount fix" >
									</div>
								</div>
								<div class="price_container_right">
									<span><i class="fa fa-plus-circle" onclick="userPrice_duplicate()"></i></span>
									<span><i class="fa fa-minus-circle" onclick="userPrice_remove()"></i></span>
								</div>
							</div>
						</div>
						
					</div>

					<span id="save_pack_data" style="display: none;">Submit Package Data</span>
				</div>
				<input type="hidden" name="package_count" value="1" class="package_count">
				<input type="hidden" name="user_price_cont" value="1">
				<input type="hidden" name="iconedit_price_cont" value="1">
				<div class="backgroundOverlay" id="backgroundOverlay">&nbsp;</div>
				<div class="group_fun_container">
					<div class="group_drag_drop" id="group_layer1">
						<div class="group_container" draggable='false' ondragstart='dragStart(event)' ondrop='drop(event)' ondragover='allowDrop(event)'>
							<div class="group_container_left">
								<div class="title_col"><input type="text" name="group_title" class="title" placeholder="Group Name |"><!-- <input type="checkbox" name="group_deactive" value="1" class="group_deactive"> --></div>
								<!-- <div class="group_package_col_count" id="package1">
									<div class="outline">
										<span>1</span>
									</div>
								</div> -->
							</div>
							<div class="group_container_icons">
									<span><i class="fa fa-plus-circle" onclick="group_duplicate()"></i></span>
									<span><i class="fa fa-minus-circle" onclick="group_remove()"></i></span>
								<!-- <span class="group_posi_nav"><i class="fas fa-sort-up" onclick="groupUp()"></i><i class="fas fa-sort-down"></i></span> -->
							</div>
						</div>
						<div class="function_drag_drop">
							<div class="function_container" id="func_layer1" draggable='false' ondragstart='dragStart(event)' ondrop='drop(event)' ondragover='allowDrop(event)'>
								<div class="function_container_left">
									<div class="title_col">
										<span class="icon_info">
											<i class="fas fa-info-circle" onclick="fun_info()"></i>
											<div class="info_opt">
												<ul>
													<li><a href="#info_text" onclick="infoOptFun()">Text</a></li>
													<li><a href="#info_video" onclick="infoOptFun()">Video</a></li>
												</ul>
											</div>
											<div class="info_container">
												<div class="info_container_textarea info_cont" id="info_text">
													<textarea rows="5" placeholder="Enter Text Here"></textarea>
												</div>
												<div class="info_container_input info_cont" id="info_video">
													<strong>Youtube ID</strong><br>
													<input type="text" name="" placeholder="Youtube video ID">
												</div>
											</div>
										</span>
										<input type="text" name="function_title" placeholder="Function Name |" class="function_title">
										<!-- <input type="checkbox" name="function_deactive" value="1" class="function_deactive"> -->
									</div>
									<div class="function_package_col_count" id="package1">
										<div class="outline">
											<span class="func_check">
												<input type="radio" name="function_package_type1" value="1" checked>
												<i class="fa fa-check-square"></i>
											</span>
											<span class="func_cancel">
												<input type="radio" name="function_package_type1" value="2" >
												<i class="fa fa-window-close"></i>
											</span>
											<span class="func_edit">
												<input type="radio" name="function_package_type1" value="3" onclick="editInput()">
												<i class="fas fa-pen-square"></i>
												<div class="iconedit">
													<span class="iconedit_container_text" style="">
														<p>Pries für zusätzliche Funktion auf Basis User</p>
													</span>
													<div class="iconedit_container_middel">
														<div class="iconedit_container" id="iconedit_price_cont1">
															<div class="iconedit_container_left">
																<div class="iconedit_container_left_col">
																	<input type="text" name="iconedit_container_price" placeholder="Price " >
																</div>
																<div class="iconedit_container_left_col">
																	<input type="text" name="iconedit_container_user" placeholder="User " >
																</div>
																<div class="iconedit_container_left_col" style="display: none;">
																	<input type="text" name="iconedit_container_price_percent" placeholder="Discount %" >
																</div>
																<div class="iconedit_container_left_col" style="display: none;">
																	<input type="text" name="iconedit_container_price_fixed" placeholder="Discount fix" >
																</div>
															</div>
															<div class="iconedit_container_right">
																<span><i class="fa fa-plus-circle" onclick="iconeditPrice_duplicate()"></i></span>
																<span><i class="fa fa-minus-circle" onclick="iconeditPrice_remove()"></i></span>
															</div>
														</div>
													</div>
													<div class="iconedit_container_bottom">
														<p>Minimum Pries je Funktion</p>
														<input type="text" name="icon_min_price_function" class="icon_min_price_function">
														<p>Miximun Pries je Funktion</p>
														<input type="text" name="icon_max_price_function" class="icon_max_price_function">
													</div>

												</div>
											</span>
										</div>
									</div>
								</div>
								<div class="function_container_icons">
									<span><i class="fa fa-plus-circle" onclick="fun_duplicate()"></i></span>
									<span><i class="fa fa-minus-circle" onclick="fun_remove()"></i></span>
									<span class="function_posi_nav"><i class="fas fa-sort-up"></i><i class="fas fa-sort-down"></i></span>
								</div>
							</div>				
						</div>
					</div>
					
				</div>
				
				<input type="hidden" name="group_count" value="1">
				<input type="hidden" name="func_count" value="1">
				<input type="hidden" name="package_data" value="">
				<input type="hidden" name="group_func_data" value="">
				<input type="hidden" name="func_icon_count" value="1">
				<div class="project_submit" >
					<input type="submit" name="pro_submit" id="pro_submit" class="button button-primary" value="Save All Data" style="display: none;">
					<span id="save_fu_gr_data" class="save_fu_gr_data">Submit Group Data</span>
				</div>
				
		</form>
	</div>
	<div class="sidebar_calcy">
		<div id="submitdiv" class="postbox">
			<button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Publish</span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span>Publish</span></h2>
			<div class="inside">
				<div class="submitbox" id="submitpost">
					<div id="misc-publishing-actions">
						<div class="misc-pub-section misc-pub-post-status">
							Status: 
							<span id="post-status-display">
								<select name="post_status" form="project_data" id="post_status">
								<option selected="selected" value="publish">Published</option>
								<option value="draft">Draft</option>
								<option value="trash">Trash</option>
								</select>
							</span>
						</div><!-- .misc-pub-section -->
					</div><!-- .misc-pub-section -->
					<div class="misc-pub-section curtime misc-pub-curtime">
						<span id="timestamp">Published on: <b><?php echo date("M j,Y @ G:i"); ?></b></span>
						<!-- <a href="#edit_timestamp" class="edit-timestamp hide-if-no-js" role="button"><span aria-hidden="true">Edit</span> <span class="screen-reader-text">Edit date and time</span></a> -->
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div id="major-publishing-actions">
				<div id="delete-action">
					<!-- <a class="submitdelete deletion" href="http://custom-plugin.local/wp-admin/post.php?post=1&amp;action=trash&amp;_wpnonce=f176e5101c">Move to Trash</a> -->
				</div>
				<div id="project_submit">
						<input type="submit" name="save_fu_gr_data" id="" class="button button-primary" value="Save Data" onclick="calSaveButton()">
				</div>
			</div>
		</div>
		<div class="clcproject_opt">
			<!-- <div class="group_sec_opt">
				<span class="grpopt_title"> Group Section:</span>
				<span class="grpopt_opt">
					<input type="radio" form="project_data" name="grp_section" value="1" checked>
					<label>Yes</label>
				</span>
				<span class="grpopt_opt">
					<input type="radio" form="project_data" name="grp_section" value="2" >
					<label>No</label>
				</span>
			</div> -->
			<!-- <div class="pro_color">
				<span class="title"> Color:</span>
				<input type="text" form="project_data" name="pro_color">
			</div> -->
			<div class="clcproject_package_text">
				<div class="clcproject_package_opt pack_opt1">
					<span class="title"> Slider Text:</span>
					<input type="text" form="project_data" name="pro_slider_text">
				</div>
				<div class="clcproject_package_opt pack_opt2">
					<span class="title"> Count Text:</span>
					<input type="text" form="project_data" name="pro_count_text">
				</div>
				<div class="clcproject_package_opt pack_opt3">
					<span class="title"> Button Text:</span>
					<input type="text" form="project_data" name="pro_button_text">
				</div>
				<div class="clcproject_package_opt pack_opt4">
					<span class="title"> Button Class:</span>
					<select name="pro_button_cls" form="project_data" id="pro_button_cls">
						<option value="clcwhite_bg_button">White Background</option>
						<option value="clcgray_bg_button">Gray Background</option>
					</select>
				</div>
			</div>
		</div>
	</div>

</div>
<?php

global $wpdb;

?>


<?php

$project_table 		= $wpdb->prefix.'clc_project_table';
$package_table 		= $wpdb->prefix.'clc_package_table';
$user_table 		= $wpdb->prefix.'clc_user_step';
$user_price_table 	= $wpdb->prefix.'clc_user_price';
$group_table 		= $wpdb->prefix.'clc_group_table';
$function_table 	= $wpdb->prefix.'clc_function_table';
$value_table		= $wpdb->prefix.'clc_value_table';
$icon_price_table	= $wpdb->prefix.'clc_func_user_price_table';
if( isset($_POST['pro_submit']) ) {
	$project_title 					= $_POST['project_title'];
	$min_user 						= $_POST['range_field_min'];
	$max_user		 				= $_POST['range_field_max'];
	$currency_id 					= $_POST['currency_type_field'];
	$project_type 					= $_POST['pack_type_field'];
	$project_slider_text			= $_POST['pro_slider_text'];
	$project_count_text				= $_POST['pro_count_text'];
	$project_button_text			= $_POST['pro_button_text'];
	$project_button_cls				= $_POST['pro_button_cls'];
	$project_status					= $_POST['post_status'];
	$package_name					= $_POST['package_name'];
	$pack_data_str = $_POST["package_data"];
	$group_func_data = $_POST["group_func_data"];
	$newStr = str_replace('\"', '"', $pack_data_str);
	$group_newStr = str_replace('\"', '"', $group_func_data);
	$pack_data = json_decode($newStr, true);
	$group_data = json_decode($group_newStr, true);
	
	if (!empty($_POST['group_func_data'] && $_POST['package_data'])) {
		$res = $wpdb->insert($project_table, array('project_title'=> $project_title, 'project_type'=>$project_type, 'currency_id'=>$currency_id, 'min_user'=>$min_user, 'max_user'=>$max_user, 'project_status'=>$project_status, 'range_slider_text'=>$project_slider_text, 'group_count_text'=>$project_count_text, 'submit_button_text'=>$project_button_text, 'submit_button_cls'=>$project_button_cls, 'project_publish_date'=> current_time( 'mysql' )));
		$project_id = $wpdb->insert_id;
		foreach ($pack_data as $pack_name => $pack_name_value) {
				$wpdb->insert($package_table, array('package_title'=> $pack_name, 'project_id'=>$project_id ));
				$package_id = $wpdb->insert_id;
			foreach ($pack_name_value as $pack_user => $pack_user_value) {
				$wpdb->insert($user_table, array('project_id'=>$project_id, 'package_id'=>$package_id, 'user_step' => $pack_user));
				$user_tb_id = $wpdb->insert_id;
				foreach ($pack_user_value as $pack_price => $pack_user_value) {
					$wpdb->insert($user_price_table, array('project_id'=>$project_id, 'package_id'=>$package_id, 'user_id' => $user_tb_id, 'user_price'=>$pack_user_value['price_us'], 'price_fixed_discount' => $pack_user_value['price_dis'], 'price_percent_discount'=>$pack_user_value['price_fix']));
				}
			}
			

		}
		foreach ($group_data as $func => $func_value) {
				$wpdb->insert($group_table, array('project_id'=>$project_id, 'group_name' => $func));
				$group_tb_id = $wpdb->insert_id;
				foreach ($func_value as $func_fields ) {
					$function = $func_fields['functionContent'];
					$function_icon = $func_fields['functionPackage'];
					$wpdb->insert($function_table, array('project_id'=>$project_id, 'group_Id' => $group_tb_id, 'func_name'=>$function['functionTile'], 'func_video' => $function['functionVideo'], 'func_text'=>$function['functionText']));
					$function_tb_id = $wpdb->insert_id;
					foreach ($function_icon as $function_icon_key => $function_icon_value) {
						foreach ($function_icon_value as $icon_type_key => $icon_type_value) {
								$wpdb->insert($value_table, array('project_id'=>$project_id, 'package_id' => $function_icon_key, 'group_Id' => $group_tb_id, 'function_id'=>$function_tb_id, 'icon_type' => $icon_type_value['iconValue']));
								$icon_type_content = $icon_type_value['iconTypeContent'];
								$icon_type_mid_content = $icon_type_content['iconTypeMidContent'];
								$icon_type_bot_content = $icon_type_content['iconTypeBotContent'];
								
								foreach ($icon_type_mid_content as $icon_type_mid_content_key => $icon_type_mid_content_value) {
									
									foreach ($icon_type_mid_content_value as $icon_type_price_key => $icon_type_price_value) {
										
										$wpdb->insert($icon_price_table, array( 'function_id' => $function_tb_id, 'package_id' => $function_icon_key, 'project_id' => $project_id, 'user_count' => $icon_type_mid_content_key, 'user_price'=>$icon_type_price_value['price_us'], 'fprice_discount_per'=>$icon_type_price_value['price_dis'], 'fprice_discount_fix' => $icon_type_price_value['price_fix'], 'icon_price_min' => $icon_type_content['iconTypeBotContent']['MinimumPrice'], 'icon_price_max' => $icon_type_content['iconTypeBotContent']['MaximumPrice']));
									}
								}
							}
					}
					
				}
		}
		if( $res ){
		    	echo "Inserted..!";
			}else{
			    echo "Please insert project data";
			    $wpdb->show_errors();
			}

		}else{
		    echo "Please Submit Package and Group Section data";
		    $wpdb->show_errors();
	}
}


