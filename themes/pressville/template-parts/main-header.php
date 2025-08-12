<?php if ( true === apply_filters( 'lsvr_pressville_main_header_enable', true ) ) : ?>

	<?php // Add custom code before page header
	do_action( 'lsvr_pressville_main_header_before' ); ?>

	<!-- MAIN HEADER : begin -->
	<header class="main__header">

		<?php // Add custom code at the top of the page header
		do_action( 'lsvr_pressville_main_header_top' ); ?>

		<h1 class="main__title">

			<?php echo wp_kses( apply_filters( 'lsvr_pressville_main_header_title', get_the_title() ), array(
				'a' => array(
					'href' => array(),
				),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
				'span' => array(
					'class' => array(),
					'style' => array(),
				),
			)); ?>

		</h1>

		<?php // Add custom code at the bottom of the page header
		do_action( 'lsvr_pressville_main_header_bottom' ); ?>

	</header>
	<!-- MAIN HEADER : end -->

	<?php // Add custom code after page header
	do_action( 'lsvr_pressville_main_header_after' ); ?>

<?php endif; ?>