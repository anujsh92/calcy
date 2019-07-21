<?php 
/**
 * @package  Calcy
 */

use Inc\Base;
global $wpdb;
$project_table 		= $wpdb->prefix.'clc_project_table';
$pro_query = $wpdb->get_results("SELECT * FROM $project_table AS PT  WHERE PT.project_Id ORDER BY PT.project_modifiy_date ASC");
//print_r($pro_query);
?>
<div class="wrap">
<h1 class="wp-heading-inline">Projects</h1>

 <a href="<?php echo admin_url(); ?>admin.php?page=calcy_add_new" class="page-title-action">Add New</a>
<hr class="wp-header-end">


<h2 class="screen-reader-text">Filter pages list</h2><ul class="subsubsub">
	<li class="all"><a href="<?php echo admin_url(); ?>admin.php?page=calcy_plugin" class="current" aria-current="page">All <span class="count">(0)</span></a> |</li>
	<li class="publish"><a href="edit.php?post_status=publish&amp;post_type=page">Published <span class="count">(0)</span></a></li>
	<li class="publish"><a href="edit.php?post_status=publish&amp;post_type=page">Trash <span class="count">(0)</span></a></li>
</ul>
<form id="posts-filter" method="get">

<table class="wp-list-table widefat fixed striped pages">
	<thead>
	<tr>
		<td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox"></td><th scope="col" id="title" class="manage-column column-title column-primary sortable desc"><a href="http://custom-plugin.local/wp-admin/edit.php?post_type=page&amp;orderby=title&amp;order=asc"><span>Title</span><span class="sorting-indicator"></span></a></th><th class="project_Id"><a href="#">Project Shortcode</a></th><th scope="col" id="date" class="manage-column column-date sortable asc"><a href="http://custom-plugin.local/wp-admin/edit.php?post_type=page&amp;orderby=date&amp;order=desc"><span>Date</span><span class="sorting-indicator"></span></a></th>	</tr>
	</thead>
	<?php
		foreach ($pro_query as $pro_query_key => $pro_query_value) {
	?>
		<tbody id="the-list">
			<tr id="post-2" class="iedit author-self level-0 post-2 type-page status-publish hentry">
				<th scope="row" class="check-column">
					<label class="screen-reader-text" for="cb-select-2">Select Sample Page</label>
					<input id="cb-select-2" type="checkbox" name="post[]" value="2">
					<div class="locked-indicator">
						<span class="locked-indicator-icon" aria-hidden="true"></span>
						<span class="screen-reader-text">“Sample Page” is locked</span>
					</div>
				</th>
				<td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
					<div class="locked-info">
						<span class="locked-avatar"></span>
						<span class="locked-text"></span>
					</div>
					<strong>
						<a class="row-title" href="<?php echo admin_url(); ?>admin.php?page=calcy_update_project.php&amp;id=<?php echo $pro_query_value->project_Id; ?>" aria-label="“Sample Page” (Edit)" ><?php echo $pro_query_value->project_title; ?></a>
					</strong>
					<div class="row-actions">
						<span class="edit">	<a href="<?php echo admin_url(); ?>admin.php?page=calcy_update_project.php&amp;id=<?php echo $pro_query_value->project_Id; ?>" aria-label="Edit “Sample Page”">Edit</a> | </span>
						<span class="trash"><a href="#" class="submitdelete" aria-label="Move “Sample Page” to the Trash">Trash</a> | </span>
					</div>
					<button type="button" class="toggle-row">
						<span class="screen-reader-text">Show more details</span>
					</button>
				</td>
				<td class="project_Id">
					<a href="#">[project-shortcode id="<?php echo $pro_query_value->project_Id; ?>"]</a>
				</td>
				<?php 
					$pro_date = $pro_query_value->project_publish_date;
					$date = new DateTime($pro_date);
					
				 ?>
				<td class="date column-date" data-colname="Date">Published<br><abbr title="2018/08/03 11:53:57 am"><?php echo $date->format('d/m/Y');  ?></abbr></td>		
			</tr>
		</tbody>
	<?php
		}
	?>
	<tfoot>
	<tr>
		<td class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-2">Select All</label><input id="cb-select-all-2" type="checkbox"></td><th scope="col" class="manage-column column-title column-primary sortable desc"><a href="http://custom-plugin.local/wp-admin/edit.php?post_type=page&amp;orderby=title&amp;order=asc"><span>Title</span><span class="sorting-indicator"></span></a></th><th class="project_Id"><a href="#">Project Shortcode</a></th><th scope="col" class="manage-column column-date sortable asc"><a href="http://custom-plugin.local/wp-admin/edit.php?post_type=page&amp;orderby=date&amp;order=desc"><span>Date</span><span class="sorting-indicator"></span></a></th>	</tr>
	</tfoot>

</table>
	<div class="tablenav bottom">

				<div class="alignleft actions bulkactions">
			<label for="bulk-action-selector-bottom" class="screen-reader-text">Select bulk action</label><select name="action2" id="bulk-action-selector-bottom">
<option value="-1">Bulk Actions</option>
	<option value="edit" class="hide-if-no-js">Edit</option>
	<option value="trash">Move to Trash</option>
</select>
<input type="submit" id="doaction2" class="button action" value="Apply">
		</div>
				<div class="alignleft actions">
		</div>
<div class="tablenav-pages one-page"><span class="displaying-num">1 item</span>
<span class="pagination-links"><span class="tablenav-pages-navspan" aria-hidden="true">«</span>
<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
<span class="screen-reader-text">Current Page</span><span id="table-paging" class="paging-input"><span class="tablenav-paging-text">1 of <span class="total-pages">1</span></span></span>
<span class="tablenav-pages-navspan" aria-hidden="true">›</span>
<span class="tablenav-pages-navspan" aria-hidden="true">»</span></span></div>
		<br class="clear">
	</div>

</form>


	
<div id="ajax-response"></div>
<br class="clear">
</div>



<script type="text/javascript">
	function updateProject(intProjectId){
            var postForm = {
                'action': 'update_project',
                'intProjectId': '2455'
            };
            $.ajax({
                type: 'POST', //Method type
                url: '<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php', //Your form processing file URL
                data: postForm, //Forms name
                dataType: 'json',
                success: function (data) {
                	console.log(data);
                	window.location.href = "<?php echo admin_url(); ?>admin.php?page=calcy_update_project";
                },
                error: function(e) {
                alert('Error' + e);
            	}
            });

    }
</script>