<?php 
/**
 * @package  Calcy
 */


use Inc\Base;
use Inc\Base\BaseController;

/* Default Global variable of wordpress*/
global $wpdb;
$url = $_SERVER["REQUEST_URI"];
$pro_ID = explode("id=",$url);

/* Calcy plugin table pass into variable*/
$project_table 		= $wpdb->prefix.'clc_project_table';
$package_table 		= $wpdb->prefix.'clc_package_table';
$user_table 		= $wpdb->prefix.'clc_user_step';
$user_price_table 	= $wpdb->prefix.'clc_user_price';
$group_table 		= $wpdb->prefix.'clc_group_table';
$function_table 	= $wpdb->prefix.'clc_function_table';
$value_table		= $wpdb->prefix.'clc_value_table';
$icon_price_table	= $wpdb->prefix.'clc_func_user_price_table';

/*** Project table query to get the data ***/
$query = $wpdb->get_results("SELECT * FROM $project_table AS PT  WHERE PT.project_Id=$pro_ID[1] ORDER BY PT.project_modifiy_date ASC");

/*** Package table query to get the data ***/
$query_pkt 			= $wpdb->get_results("SELECT * FROM $package_table AS PKT  WHERE PKT.project_id=$pro_ID[1] ORDER BY PKT.package_id ASC");

/*** User table query to get the data ***/
$query_user 		= $wpdb->get_results("SELECT * FROM $user_table AS UST  WHERE UST.project_id=$pro_ID[1] ORDER BY UST.package_id ASC");

/*** Package price table query to get the data ***/
$query_user_pri 	= $wpdb->get_results("SELECT * FROM $user_price_table AS USPT  WHERE USPT.project_id=$pro_ID[1] ORDER BY USPT.package_id ASC");

/*** Group table query to get the data ***/
$query_group 		= $wpdb->get_results("SELECT * FROM $group_table AS GT  WHERE GT.project_id=$pro_ID[1] ORDER BY GT.group_id ASC");

/*** Function table query to get the data ***/
$query_func 		= $wpdb->get_results("SELECT * FROM $function_table AS FT  WHERE FT.project_id=$pro_ID[1] ORDER BY FT.func_id ASC");

/*** Function icon table query to get the data ***/
$query_icon_val 	= $wpdb->get_results("SELECT * FROM $value_table AS VT  WHERE VT.project_id=$pro_ID[1] ORDER BY VT.id ASC");

/*** Function addon icon table query to get the data ***/
$query_icon_price 	= $wpdb->get_results("SELECT * FROM $icon_price_table AS ICT  WHERE ICT.project_id=$pro_ID[1] ORDER BY ICT.id ASC");
//print_r($query);
//print_r($query_icon_price);

/*** Break the Project table query array and get the field value ***/
foreach ($query as $key => $value) {
?>

<div class="wrap" style="float: left;width: 100%;">

	<div class="all_field_container">
		<form id="project_data" method="post" action="" enctype="multipart/form-data">
				<input type="text" name="project_title" id="project_title" value="<?php echo $value->project_title;?>">
				<span>ID:</span><span><?php echo $value->project_Id; ?></span>
				<div class="clear"></div>
				<div class="left_field_container">
					<div class="range_field_container">
						<div class="range_field"><label>Min User</label><input type="text" name="range_field_min" value="<?php echo $value->min_user;?>" placeholder="Min User|" onkeyup="inpNumValue()"></div>
						<div class="range_field"><label>Max User</label><input type="text" name="range_field_max" value="<?php echo $value->max_user;?>" placeholder="max User|" onkeyup="inpNumValue()"></div>
						
					</div>
					<div class="currency_type">
						<select class="currency_type_field" name="currency_type_field">
						  <option value="">&nbsp; Select Currency &nbsp;</option>
						  <option value="euro" <?php if ($value->currency_Id == 'euro' ) echo 'selected' ; ?> >Euro</option>
						  <option value="usd" <?php if ($value->currency_Id == 'usd' ) echo 'selected' ; ?> >USD</option>
						  <option value="gbp" <?php if ($value->currency_Id == 'gbp' ) echo 'selected' ; ?> >GBP</option>
						  <option value="cad" <?php if ($value->currency_Id == 'cad' ) echo 'selected' ; ?> >CAD</option>
						</select>
					</div>
					<div class="pack_type">
						<select class="pack_type_field" name="pack_type_field">
						  <option value="">&nbsp; Select package Type &nbsp;</option>
						  <option value="weekly" <?php if ($value->project_type == 'weekly' ) echo 'selected' ; ?> >Weekly</option>
						  <option value="monthly" <?php if ($value->project_type == 'monthly' ) echo 'selected' ; ?> >Monthly</option>
						  <option value="yearly" <?php if ($value->project_type == 'yearly' ) echo 'selected' ; ?> >Yearly</option>
						  <option value="onetime" <?php if ($value->project_type == 'onetime' ) echo 'selected' ; ?> >OneTime</option>
						</select>
					</div>
				</div>

				<div class="right_field_container main_package_field" id="main_package_field">

					<?php
						/*** Break the Pacakge table query array and get the field value ***/
						$pkt_cnt=1;
					 	foreach ($query_pkt as $query_pkt_key => $query_pkt_value) {
					?>
					<div class="package_field" id="package<?php echo $pkt_cnt;?>">
						<label>Package<?php echo $pkt_cnt;?> Name</label>
						<input type="text" name="package_name" value="<?php echo $query_pkt_value->package_title;?>" placeholder="Package Name |" ><span class="add_rem_icons"><i class="fa fa-plus-circle" id="pack_add_button" onclick="duplicate()"></i><i class="fa fa-minus-circle" id="pack_add_button" onclick="remove()"></i></span><br>
						<input type="button" name="pro_submit" class="button button-primary add_pack_price" value="+ Add Prices" onclick="showPriceClick()">
						<div class="price_container" id="price_container">
							<span class="price_container_text" style="">
								<p>Trage hier Deinen Preis pro user oder Preisstaffelung für Usergruppen ein. Hast du keine Preisstaffelung festgelegt, so rechnet der Slider Automatisch bis Einheit Max.</p>
							</span>
							<?php
								/*** Break the User table query array and get the field value ***/	 
								$us_cnt = 1;
								foreach ($query_user as $query_user_key => $query_user_value){ 
								if( $query_pkt_value->package_id == $query_user_value->package_id){

									/*** Break the Package Price table query array and get the field value ***/	
									foreach ($query_user_pri as $query_user_pri_key => $query_user_pri_value){
										if ($query_pkt_value->package_id == $query_user_pri_value->package_id && $query_user_pri_value->user_id == $query_user_value->id) {
											
										
							?>
							<div class="user_price_cont" id="user_price_cont<?php echo $us_cnt;?>">
								<div class="price_container_left">
									<div class="price_container_left_col">
										<label>Price</label>
										<input type="text" name="price_container_price" value="<?php echo $query_user_pri_value->user_price;?>" placeholder="Price " onchange="inpNumValue()">
									</div>
									<div class="price_container_left_col">
										<label>User</label>
										<input type="text" name="price_container_user" value="<?php echo $query_user_value->user_step;?>" placeholder="User" onchange="inpNumValue()">
									</div>
									<div class="price_container_left_col" style="display: none;">
										<label>Discount Percent</label>
										<input type="text" name="price_container_price_percent" value="<?php echo ($query_user_pri_value->price_percent_discount != 0) ? $query_user_pri_value->price_percent_discount : '0';?>" placeholder="Discount Percent" >
									</div>
									
									<div class="price_container_left_col" style="display: none;">
										<label>Discount Fix</label>
										<input type="text" name="price_container_price_fixed" value="<?php echo ($query_user_pri_value->price_fixed_discount != 0) ? $query_user_pri_value->price_fixed_discount : '0';?>" placeholder="Discount Fix" >
									</div>
								</div>
								<div class="price_container_right">
									<span><i class="fa fa-plus-circle" onclick="userPrice_duplicate()"></i></span>
									<span><i class="fa fa-minus-circle" onclick="userPrice_remove()"></i></span>
								</div>
							</div>
							<?php 	
											}
										}
									}
									$us_cnt++; 
								} 
							?>
						</div>
						
					</div>
				<?php 
					$pkt_cnt++;
					}
				?>
					<span id="save_pack_data" style="display: none;">Submit Package Data</span>
				</div>
				<input type="hidden" name="package_count" value="<?php echo $pkt_cnt;?>" class="package_count">
				<input type="hidden" name="user_price_cont" value="<?php echo $us_cnt;?>">
				<input type="hidden" name="iconedit_price_cont" value="<?php echo $ic_cnt;?>">
				<div class="backgroundOverlay" id="backgroundOverlay">&nbsp;</div>
				<div class="group_fun_container">
					<?php
						/*** Break the Group table query array and get the field value ***/
						$grp_cnt = 1;
						foreach ($query_group as $query_group_key => $query_group_value) {
							if ( $query_group_value->project_id == $value->project_Id){
					?>
					<div class="group_drag_drop" id="group_layer<?php echo $grp_cnt;?>">
						<div class="group_container" draggable='false' ondragstart='dragStart(event)' ondrop='drop(event)' ondragover='allowDrop(event)'>
							<div class="group_container_left">
								<div class="title_col"><input type="text" name="group_title" class="title" value="<?php echo $query_group_value->group_name;?>" placeholder="Group Name |"><!-- <input type="checkbox" name="group_deactive" value="1" class="group_deactive"> --></div>
								<?php 
									$cn = count($query_pkt);
									for ($i=1; $i <=$cn; $i++) { 
									
								?>
								<!--  <div class="group_package_col_count" id="package<?php //echo $i;?>">
									<div class="outline">
										<span>1</span>
									</div>
								</div>  -->
								<?php
									}
								 ?>
							</div>
							<div class="group_container_icons">
									<span><i class="fa fa-plus-circle" onclick="group_duplicate()"></i></span>
									<span><i class="fa fa-minus-circle" onclick="group_remove()"></i></span>
								<!-- <span class="group_posi_nav"><i class="fas fa-sort-up" onclick="groupUp()"></i><i class="fas fa-sort-down"></i></span> -->
							</div>
						</div>
						<div class="function_drag_drop">
							<?php
								/*** Break the function table query array and get the field value ***/	 
								$func_cnt = 1;
								foreach ($query_func as $query_func_key => $query_func_value) {
									if ( $query_func_value->project_id == $value->project_Id && $query_func_value->group_id == $query_group_value->group_id) {
								?>
							<div class="function_container" id="func_layer<?php echo $func_cnt;?>" draggable='false' ondragstart='dragStart(event)' ondrop='drop(event)' ondragover='allowDrop(event)'>
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
												<div class="info_container_textarea info_cont info_text" id="info_text">
													<textarea rows="5" placeholder="Enter Text Here"><?php echo $query_func_value->func_text;?></textarea>
												</div>
												<div class="info_container_input info_cont info_video" id="info_video">
													<strong>Youtube ID</strong><br>
													<input type="text" name="info_container" value="<?php echo $query_func_value->func_video;?>" placeholder="Youtube video ID">
												</div>
											</div>
										</span>
										<input type="text" name="function_title" value="<?php echo $query_func_value->func_name;?>" placeholder="Function Name |" class="function_title">
										<!-- <input type="checkbox" name="function_deactive" value="1" class="function_deactive"> -->
									</div>
									<?php
										/*** Break the function icons table query array and get the field value ***/
										$cnt = 1;
										foreach ($query_icon_val as $query_icon_val_key => $query_icon_val_value) {
											if ($query_func_value->group_id == $query_group_value->group_id && $query_icon_val_value->function_id == $query_func_value->func_id) {	
											;
									?>		
									<div class="function_package_col_count" id="package">
										<div class="outline">
											<span class="func_check">
												<input type="radio" name="function_package_type<?php echo $cnt;?>" value="1" <?php echo ($query_icon_val_value->icon_type == '1') ? 'checked' : ''; ?>>
												<i class="fa fa-check-square"></i>
											</span>
											<span class="func_cancel">
												<input type="radio" name="function_package_type<?php echo $cnt;?>" value="2" <?php echo ($query_icon_val_value->icon_type == '2') ? 'checked' : ''; ?>>
												<i class="fa fa-window-close"></i>
											</span>
											<span class="func_edit">
												<input type="radio" name="function_package_type<?php echo $cnt;?>" value="3" onclick="editInput()" <?php echo ($query_icon_val_value->icon_type == '3') ? 'checked' : ''; ?>>
												<i class="fas fa-pen-square"></i>
												<div class="iconedit">
													<span class="iconedit_container_text" style="">
														<p>Pries für zusätzliche Funktion auf Basis User</p>
													</span>
													<div class="iconedit_container_middel">


														<?php 

															/*** Break the function addon icon table query array and get the field value ***/
															$ic_cnt = 1;
															foreach ($query_icon_price as $query_icon_price_key => $query_icon_price_value) {
																if ($query_icon_price_value->function_id == $query_func_value->func_id && $query_icon_price_value->package_id == $query_icon_val_value->package_id) {
																
														 ?>
														<div class="iconedit_container" id="iconedit_price_cont<?php echo $ic_cnt;?>">
															<div class="iconedit_container_left">
																<div class="iconedit_container_left_col">
																	<input type="text" name="iconedit_container_price" value="<?php echo $query_icon_price_value->user_price;?>" placeholder="Price " onchange="inpNumValue()">
																</div>
																<div class="iconedit_container_left_col">
																	<input type="text" name="iconedit_container_user" value="<?php echo $query_icon_price_value->user_count;?>" placeholder="User " onchange="inpNumValue()">
																</div>
																<div class="iconedit_container_left_col" style="display: none;">
																	<input type="text" name="iconedit_container_price_percent" value="<?php echo $query_icon_price_value->fprice_discount_per;?>" placeholder="Discount %" >
																</div>
																<div class="iconedit_container_left_col" style="display: none;">
																	<input type="text" name="iconedit_container_price_fixed" value="<?php echo $query_icon_price_value->fprice_discount_fix;?>" placeholder="Discount fix" >
																</div>
															</div>
															<div class="iconedit_container_right">
																<span><i class="fa fa-plus-circle" onclick="iconeditPrice_duplicate()"></i></span>
																<span><i class="fa fa-minus-circle" onclick="iconeditPrice_remove()"></i></span>
															</div>
														</div>
														<?php
																} 
																$ic_cnt++;
															}  
														 ?>
													</div>
													<?php

														/*** Break the function addon icon table query array and get the field value ***/
														foreach ($query_icon_price as $query_icon_price_key => $query_icon_price_value) {
															if ($query_icon_price_value->function_id == $query_func_value->func_id && $query_icon_price_value->package_id == $query_icon_val_value->package_id) {
																																
													?>
													<div class="iconedit_container_bottom">
														<p>Minimum Pries je Funktion</p>
														<input type="text" name="icon_min_price_function" value="<?php echo $query_icon_price_value->icon_price_min;?>" class="icon_min_price_function">
														<p>Maximun Pries je Funktion</p>
														<input type="text" name="icon_max_price_function" value="<?php echo $query_icon_price_value->icon_price_max;?>" class="icon_max_price_function">
													</div>
													<?php
																
															}
														}  
													?>

												</div>
											</span>
										</div>
									</div>
									<?php
											}
											$cnt++;
										}
									?>	
								</div>
								<div class="function_container_icons">
									<span><i class="fa fa-plus-circle" onclick="fun_duplicate()"></i></span>
									<span><i class="fa fa-minus-circle" onclick="fun_remove()"></i></span>
									<!-- <span class="function_posi_nav"><i class="fas fa-sort-up"></i><i class="fas fa-sort-down"></i></span> -->
								</div>
							</div>
							<?php 
									}
									$func_cnt++;
								}
						?>				
						</div>
					</div>

					<?php 
							}
							$grp_cnt++;
						} 
					?>
				<input type="hidden" name="group_count" value="<?php echo $grp_cnt;?>">
				<input type="hidden" name="func_count" value="<?php echo $func_cnt;?>">
				<input type="hidden" name="package_data" value="">
				<input type="hidden" name="group_func_data" value="">
				<input type="hidden" name="func_icon_count" value="<?php echo $cnt;?>">
				</div>
				
				
				<div class="project_submit">
					<input type="submit" name="pro_submit" id="pro_submit" class="button button-primary" value="Save All Data" style="display: none;">
					<span id="save_fu_gr_data" class="save_fu_gr_data">Submit Project Data</span>
				</div>
				
		</form>
	</div>
	<?php

		/*** Break the Project table query array and get the field value ***/
		foreach ($query as $key => $value) {
			?>
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
								<option value="publish" <?php if ($value->project_status == 'publish' ) echo 'selected' ; ?> >Published</option>
								<option value="draft" <?php if ($value->project_status == 'draft' ) echo 'selected' ; ?> >Draft</option>
								<option value="trash" <?php if ($value->project_status == 'trash' ) echo 'selected' ; ?> >Trash</option>
								</select>
							</span>
						</div><!-- .misc-pub-section -->
					</div><!-- .misc-pub-section -->
					<?php
					$pro_date = $value->project_publish_date;
					$date = new DateTime($pro_date);
					?>
					<div class="misc-pub-section curtime misc-pub-curtime">
						<span id="timestamp">Published on: <b><?php echo $date->format("M j,Y @ G:i"); ?></b></span>
						<!-- <a href="#edit_timestamp" class="edit-timestamp hide-if-no-js" role="button"><span aria-hidden="true">Edit</span> <span class="screen-reader-text">Edit date and time</span></a> -->
					</div>
					
				</div>
				<div class="clear"></div>
			</div>
			<div id="major-publishing-actions" >
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
			</div> 
			<div class="pro_color">
				<span class="title"> Color:</span>
				<input type="text" form="project_data" name="pro_color" value="<?php echo $value->color_pack; ?>">
			</div>-->
			<div class="clcproject_package_text">
				<div class="clcproject_package_opt pack_opt1">
					<span class="title"> Slider Text:</span>
					<input type="text" form="project_data" name="pro_slider_text" value="<?php echo $value->range_slider_text; ?>">
				</div>
				<div class="clcproject_package_opt pack_opt2">
					<span class="title"> Count Text:</span>
					<input type="text" form="project_data" name="pro_count_text" value="<?php echo $value->group_count_text; ?>">
				</div>
				<div class="clcproject_package_opt pack_opt3">
					<span class="title"> Button Text:</span>
					<input type="text" form="project_data" name="pro_button_text" value="<?php echo $value->submit_button_text; ?>">
				</div>
				<div class="clcproject_package_opt pack_opt4">
					<span class="title"> Button Class:</span>
					<select name="pro_button_cls" form="project_data" id="pro_button_cls">
						<option value="clcwhite_bg_button" <?php if ($value->submit_button_cls == 'clcwhite_bg_button' ) echo 'selected' ; ?> >White Background</option>
						<option value="clcgray_bg_button" <?php if ($value->submit_button_cls == 'clcgray_bg_button' ) echo 'selected' ; ?> >Gray Background</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<?php
		}
	?>
	

</div>
<script type="text/javascript">
	window.addEventListener("load", function(){

		/******* add icon Price html to Edit icon div container ***/
		var addFunIcodHTML = document.querySelectorAll('.iconedit_container_middel');
		for (var hi = 0; hi < addFunIcodHTML.length; hi++) {
			if (addFunIcodHTML[hi].innerHTML.trim().length == 0) {
				var newChild = '<span class="iconedit_container_text" style=""><p>Pries für zusätzliche Funktion auf Basis User</p></span><div class="iconedit_container_middel"><div class="iconedit_container" id="iconedit_price_cont1"><div class="iconedit_container_left"><div class="iconedit_container_left_col"><input type="text" name="iconedit_container_price" placeholder="Price "></div><div class="iconedit_container_left_col"><input type="text" name="iconedit_container_user" placeholder="User "></div><div class="iconedit_container_left_col" style="display: none;"><input type="text" name="iconedit_container_price_percent" placeholder="Discount %"></div><div class="iconedit_container_left_col" style="display: none;"><input type="text" name="iconedit_container_price_fixed" placeholder="Discount fix"></div></div><div class="iconedit_container_right"><span><i class="fa fa-plus-circle" onclick="iconeditPrice_duplicate()"></i></span><span><i class="fa fa-minus-circle" onclick="iconeditPrice_remove()"></i></span></div></div></div><div class="iconedit_container_bottom"><p>Minimum Pries je Funktion</p><input type="text" name="icon_min_price_function" class="icon_min_price_function"><p>Miximun Pries je Funktion</p><input type="text" name="icon_max_price_function" class="icon_max_price_function"></div>';
				addFunIcodHTML[hi].parentNode.innerHTML = newChild;
			}
			
			
		}

		/******* Change function_package_col_count Id from function section ***/
		var func_icon = document.querySelectorAll(".function_container_left");
		for (var fi = 0; fi < func_icon.length; fi++) {
			 var pac_col = func_icon[fi].querySelectorAll(".function_package_col_count");
			 var cnt = 1
			 for (var pi = 0; pi < pac_col.length; pi++) {
			 	var pid = 'package'+ cnt++;
			 	pac_col[pi].id = pid;
			 	document.getElementsByName("iconedit_price_cont")[0].value = cnt;
			 }
		}

		/******* remove one extra div from icon bottom container***/
		var icon_edit = document.querySelectorAll(".iconedit");
		for (var ei = 0; ei < icon_edit.length; ei++) {
			var icon_edit_bot = icon_edit[ei].querySelectorAll(".iconedit_container_bottom");
			for (var ii = 1; ii < icon_edit_bot.length; ii++) {
				//console.log(icon_edit_bot);
				icon_edit_bot[ii].remove();
				/*if (icon_edit_bot[ii].nextElementSibling.className == 'iconedit_container_bottom' && icon_edit_bot[ii].nextElementSibling.className != null) {
					icon_edit_bot[ii].nextElementSibling.remove();
				}*/
			}
		}
		var countClassId = document.querySelectorAll('.group_drag_drop');
		for (var b = 0; b < countClassId.length; b++) {
			var countClasses = countClassId[b].querySelectorAll(".function_container");
			var countLength = countClasses.length;
			var allCountClass = countClassId[b].querySelectorAll(".group_package_col_count");
			for (var c = 0; c < allCountClass.length; c++) {
				allCountClass[c].childNodes[1].innerHTML = '<span>' +countLength+'</span>';
			}
			

		}
		
	});
</script>
<?php
}
if( isset($_POST['pro_submit']) ) {

	/* Get Project and user data from form field*/
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

	/* Get package name. currency, package type and price data from form field*/
	$pack_data_str = $_POST["package_data"];

	/* Get Package Group and function section data form field*/
	$group_func_data = $_POST["group_func_data"];
	$newStr = str_replace('\"', '"', $pack_data_str);
	$group_newStr = str_replace('\"', '"', $group_func_data);

	/**** Convert Package Data json to php array **/ 
	$pack_data = json_decode($newStr, true);

	/**** Convert Group and Function Data json to php array **/
	$group_data = json_decode($group_newStr, true);


	if (!empty($_POST['group_func_data'] && $_POST['package_data'])) {
		$wpdb->delete( $package_table, array( 'project_id' => $pro_ID[1] ) );
		$wpdb->delete( $user_table, array( 'project_id' => $pro_ID[1] ) );
		$wpdb->delete( $user_price_table, array( 'project_id' => $pro_ID[1] ) );
		$wpdb->delete( $group_table, array( 'project_id' => $pro_ID[1] ) );
		$wpdb->delete( $function_table, array( 'project_id' => $pro_ID[1] ) );
		$wpdb->delete( $value_table, array( 'project_id' => $pro_ID[1] ) );
		$wpdb->delete( $icon_price_table, array( 'project_id' => $pro_ID[1] ) );
		$res = $wpdb->update($project_table, array('project_title'=> $project_title, 'project_type'=>$project_type, 'currency_id'=>$currency_id, 'min_user'=>$min_user, 'max_user'=>$max_user, 'project_status'=>$project_status, 'range_slider_text'=>$project_slider_text, 'group_count_text'=>$project_count_text, 'submit_button_text'=>$project_button_text, 'submit_button_cls'=>$project_button_cls, 'project_modifiy_date'=> current_time( 'mysql' )), array( 'project_Id' => $pro_ID[1] ));
		$project_id = $pro_ID[1];
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
	    	echo '<meta http-equiv="refresh" content="1" />';
		}else{
		     echo "Please insert project data";
		    $wpdb->show_errors();
		}

	}else{
	    echo "Please Submit Package and Group Section data";
	    $wpdb->show_errors();
	}


}


