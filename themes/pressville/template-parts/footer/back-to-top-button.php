<?php if ( 'disable' !== get_theme_mod( 'back_to_top_button_enable', 'disable' ) ) : ?>

	<!-- BACK TO TOP : begin -->
	<div class="<?php echo esc_attr( lsvr_pressville_get_back_to_top_button_class() ); ?>"
		data-threshold="<?php echo esc_attr( get_theme_mod( 'back_to_top_button_threshold', 100 ) ); ?>">

		<a class="back-to-top__link" href="#header">
			<span class="screen-reader-text"><?php esc_html_e( 'Back to top', 'pressville' ); ?></span>
		</a>

	</div>
	<!-- BACK TO TOP : end -->

<?php endif; ?>