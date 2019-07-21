<div class="wrap">

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1">Allgemein</a></li>
		<li><a href="#tab-2">Erweitert</a></li>
	</ul>
	<div class="tab-content">
		<div id="tab-1" class="tab-pane active">
			<form method="post" action="options.php">
				<?php
				settings_fields( 'calcy_plugin_settings' );
				do_settings_sections( 'calcy_settings' );
				submit_button();
				?>
			
			</form>
		</div>
		<div id="tab-2" class="tab-pane">
			It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
			<?php
			//submit_button();
			?>
		</div>
	</div>
</div>
