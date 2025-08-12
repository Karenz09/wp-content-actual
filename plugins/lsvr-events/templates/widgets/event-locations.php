<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content">

	<ul class="root">

    	<?php wp_list_categories(array(
			'title_li' => '',
			'taxonomy' => 'lsvr_event_location',
			'show_count' => false,
		)); ?>

	</ul>

</div>

<?php // TEMPLATE : END
endif; ?>