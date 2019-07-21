<?php 
/* Default Global variable of wordpress*/
global $wpdb;

	/* Calcy plugin table pass into variable*/
	$project_table 	= $wpdb->prefix.'clc_project_table';
	$package_table 		= $wpdb->prefix.'clc_package_table';
	$user_table 		= $wpdb->prefix.'clc_user_step';
	$user_price_table 	= $wpdb->prefix.'clc_user_price';
	$group_table 		= $wpdb->prefix.'clc_group_table';
	$function_table 	= $wpdb->prefix.'clc_function_table';
	$value_table		= $wpdb->prefix.'clc_value_table';
	$icon_price_table	= $wpdb->prefix.'clc_func_user_price_table';

	/*** Project table query to get the data ***/
	$query 				= $wpdb->get_results("SELECT * FROM $project_table  WHERE project_Id=$id ORDER BY project_publish_date ASC");

	/*** Package table query to get the data ***/
	$query_pkt 			= $wpdb->get_results("SELECT * FROM $package_table AS PKT  WHERE PKT.project_id=$id ORDER BY PKT.package_id ASC");

	/*** User table query to get the data ***/
	$query_user 		= $wpdb->get_results("SELECT * FROM $user_table AS UST  WHERE UST.project_id=$id ORDER BY UST.package_id ASC");

	/*** Package price table query to get the data ***/
	$query_user_pri 	= $wpdb->get_results("SELECT * FROM $user_price_table AS USPT  WHERE USPT.project_id=$id ORDER BY USPT.package_id ASC");

	/*** Group table query to get the data ***/
	$query_group 		= $wpdb->get_results("SELECT * FROM $group_table AS GT  WHERE GT.project_id=$id ORDER BY GT.group_id ASC");

	/*** Function table query to get the data ***/
	$query_func 		= $wpdb->get_results("SELECT * FROM $function_table AS FT  WHERE FT.project_id=$id ORDER BY FT.func_id ASC");

	/*** Function icon table query to get the data ***/
	$query_icon_val 	= $wpdb->get_results("SELECT * FROM $value_table AS VT  WHERE VT.project_id=$id ORDER BY VT.id ASC");

	/*** Function addon icon table query to get the data ***/
	$query_icon_price 	= $wpdb->get_results("SELECT * FROM $icon_price_table AS ICT  WHERE ICT.project_id=$id ORDER BY ICT.id ASC");

//print_r($query_user_pri);


		/*** Break the Project table query array and get the field value ***/
		foreach ($query as $key => $value) {

			/* Get the Currency sign */
			if ($value->currency_Id == 'euro'){
				$currIcon = '&euro;';
			}elseif($value->currency_Id == 'USD'){
				$currIcon = '&dollar;';
			}elseif($value->currency_Id == 'gbp') {
				$currIcon = '&pound;';
			}elseif($value->currency_Id == 'cad') {
				$currIcon = 'CAD';
			}

?>
<div class="calc_project">
	<div class="project_container">
		<!-- <h2 class="project_title"><?php //echo $value->project_title; ?></h2> -->
		<div class="proj_user_slider_cnt">
			<div class="r_slidecontainer">


				
				<h3><?php echo $value->range_slider_text; ?>: <output for="userRange" id="valor"></output></h3>
				<input type="range" min="<?php echo $value->min_user; ?>" max="<?php echo $value->max_user; ?>" value="1" class="r_slider" id="userRange" name="userRange" data-show-value="true" onchange="userOnChange()">
				
			</div>
		</div>
		<div class="proj_pack_cnt">
			<?php
				/*** Break the Pacakge table query array and get the field value ***/
				$pkt_cnt=1;
			 	foreach ($query_pkt as $query_pkt_key => $query_pkt_value) {
			?>
				<div class="proj_pack calc_package<?php echo $pkt_cnt; ?>" id="package<?php echo $pkt_cnt; ?>">
					<h3 class="proj_pack_title"><?php echo $query_pkt_value->package_title;?></h3>
					<span class="project_price">
					<?php 
								/*** Break the User table query array and get the field value ***/	
								$us_cnt = 1;
								foreach ($query_user as $query_user_key => $query_user_value){ 
								if( $query_pkt_value->package_id == $query_user_value->package_id){
									echo "<input type='hidden' value='".$query_user_value->user_step."' name='step".$us_cnt."' class='step'>";
									$min_price = 0;

									/*** Break the Package Price table query array and get the field value ***/	
									foreach ($query_user_pri as $query_user_pri_key => $query_user_pri_value){
										if ($query_pkt_value->package_id == $query_user_pri_value->package_id && $query_user_pri_value->user_id == $query_user_value->id) {
											if ($min_price < $query_user_pri_value->user_price) {
											        $min_price = $query_user_pri_value->user_price;
											        echo '<input type="hidden" class="usr_cnt'.$query_user_value->user_step.'" value="'.$min_price.'" >';
													
											         
											    }
											    echo '<input type="hidden" value="'.$query_user_pri_value->price_percent_discount.'" class="usr_price_per'.$query_user_value->user_step.'">';
												echo '<input type="hidden" value="'.$query_user_pri_value->price_fixed_discount.'" class="usr_price_fix'.$query_user_value->user_step.'">';
											    
											}

										}
										

										
									}
									$us_cnt++; 
								}
								echo '<input type="hidden" name="package_user_price" value="" class="package_user_price">';
								echo '<input type="hidden" name="package_addon_price" value="0" class="package_addon_price">';
								//echo '<input type="hidden" name="package_addon_rangeslider_price" value="0" class="package_addon_rangeslider_price">';
								echo '<div class="base_price_cont"><span class="base_price"></span>&nbsp;'.$currIcon.'&nbsp;'.$value->range_slider_text.'</div>';
								echo '<div class="total_price_cont"><span class="crt_valu"></span>&nbsp;'.$currIcon.'&nbsp;Total</div>';
							?>
							</span>
							
				</div>
			<?php 
				$pkt_cnt++;
				}
			?>
		</div>
	</div>
	<div class="backgroundOverlay" id="backgroundOverlay">&nbsp;</div>
	<div class="accordionWrapper calc_group">
		<?php

			/*** Break the Group table query array and get the field value ***/	
			$grp_cnt = 1;
			foreach ($query_group as $query_group_key => $query_group_value) {
				if ( $query_group_value->project_id == $value->project_Id) {
					if($grp_cnt == 1){
						echo '<div class="accordionItem open ">';
					}
					else {
						echo '<div class="accordionItem close">';
					}
		?>
			<div class="accordionItemHeading">
				<div class="group_left">
		      		<h3><?php echo $query_group_value->group_name;?></h3>
		      	</div>
		      	<div class="group_right">
		      		<?php 
		      		for ($i=1; $i < $pkt_cnt; $i++) { 
		      			echo '<span class="group_count gcount_package'.$i.'"><input type="hidden" name="group_input_package'.$i.'" value="0" class="group_input_package'.$i.'"><span>0</span><font>&nbsp;'.$value->group_count_text.'</font></span>';
		      		}
		      		?>
		      	</div>
			</div>
			
	      	<div class="accordionItemContent">
	      		<?php 

	      			/*** Break the function table query array and get the field value ***/	
					$func_cnt = 1;
					foreach ($query_func as $query_func_key => $query_func_value) {
						if ( $query_func_value->project_id == $value->project_Id && $query_func_value->group_id == $query_group_value->group_id) {
				?>
		        	<div class="calc_function_cnt">
		        		<div class="calc_function_title">
		        			<?php if ($query_func_value->func_text != null || $query_func_value->func_video != null) { ?>
		        			<span class="icon_info">
								<i class="fa fa-info-circle" onclick="showInfo()"></i>
								<div class="info_container">
									<div class="info_container_text" id="info_text">
										<?php 
										if($query_func_value->func_text != null){
											echo $query_func_value->func_text;
										} else{
											echo $query_func_value->func_video;
										}
										?>
									</div>
									
								</div>
							</span>
							<?php } ?>
		        			<h3><?php echo $query_func_value->func_name;?></h3>
		        		</div>
		        		<div class="funcPackIconCnt">
		        			<?php
		        				/*** Break the function icons table query array and get the field value ***/	
								$cnt = 1;
								foreach ($query_icon_val as $query_icon_val_key => $query_icon_val_value) {
									if ($query_func_value->group_id == $query_group_value->group_id && $query_icon_val_value->function_id == $query_func_value->func_id) {	
							 			if ($query_icon_val_value->icon_type == '1') {
							 ?>
		        			<div class="funcPack">
		        				<i class="fa fa-check-circle"></i>
		        			</div>
		        			<?php
		        						} 
							 			if ($query_icon_val_value->icon_type == '2') {

		        			?>
		        			<div class="funcPack">
		        				<i class="fa fa-times"></i>
		        			</div>
		        			<?php
		        						} 
							 			if ($query_icon_val_value->icon_type == '3') {

		        			?>
		        			<div class="funcPack">
		        				<i class="fas fa-plus" onclick="funcIconPrice()"></i>
		        				<div class="iconedit">		
									<div class="iconedit_container_middel">
										<?php 

											/*** Break the function addon icon table query array and get the icon fields value ***/	
											$ic_cnt = 1;
											
											foreach ($query_icon_price as $query_icon_price_key => $query_icon_price_value) {
												if ($query_icon_price_value->function_id == $query_func_value->func_id && $query_icon_price_value->package_id == $query_icon_val_value->package_id) {
												
										 ?>
										<div class="iconedit_container" id="iconedit_price_cont<?php echo $ic_cnt;?>">
											<input type="text" name="iconedit_container_price" value="<?php echo $query_icon_price_value->user_price;?>" >
											<input type="text" name="iconedit_container_user" value="<?php echo $query_icon_price_value->user_count;?>" >
											<input type="text" name="iconedit_container_price_percent" value="<?php echo $query_icon_price_value->fprice_discount_per;?>">
											<input type="text" name="iconedit_container_price_fixed" value="<?php echo $query_icon_price_value->fprice_discount_fix;?>" >
											<input type="text" name="iconedit_container_package" value="<?php echo $query_icon_price_value->package_id;?>" >
										</div>
										<?php
												} 
												$ic_cnt++;
											}  
										 ?>
									</div>
									<?php
										/*** Break the function addon icon table query array and get the fields value ***/	
										foreach ($query_icon_price as $query_icon_price_key => $query_icon_price_value) {
											if ($query_icon_price_value->function_id == $query_func_value->func_id && $query_icon_price_value->package_id == $query_icon_val_value->package_id) {
																												
									?>
									<div class="iconedit_container_bottom">
										<p>Minimum Pries je Funktion</p>
										<input type="text" name="icon_min_price_function" value="<?php echo $query_icon_price_value->icon_price_min;?>" class="icon_min_price_function">
										<p>Miximun Pries je Funktion</p>
										<input type="text" name="icon_max_price_function" value="<?php echo $query_icon_price_value->icon_price_max;?>" class="icon_max_price_function">
									</div>
									<?php		
											}
										}  
									?>

								</div>
		        			</div>
		        			<?php
		        						}
									}
									$cnt++;
								}
							?>	
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
	</div>
	<input type="hidden" value="" name="before_package_class" id="before_package_class" class="">
	<div class="pack_bottom_container">
		<div class="pack_bottom_left">
			&nbsp;
		</div>
		<div class="pack_bottom_right">
			<?php 
				/*** Break the package query array to get the package Id for send request button  ***/	
				$pkt_cnt=1;
			 	foreach ($query_pkt as $query_pkt_key => $query_pkt_value) {
			?>
			<div class="pack_bottom">
				<span class="<?php echo $value->submit_button_cls;?>"><?php echo $value->submit_button_text; ?></span>
			</div>
			<?php 
				}
			?>
		</div>
	</div>
</div>

<?php 			
		}

?>
