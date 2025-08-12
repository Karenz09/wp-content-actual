<?php if ( is_active_sidebar( 'lsvr-pressville-footer-widgets' ) ) : ?>

	<!-- FOOTER WIDGETS : begin -->
	<div<?php lsvr_pressville_the_footer_widgets_class(); ?>>
		<div class="footer-widgets__inner">
			<div<?php lsvr_pressville_the_footer_widgets_grid_class(); ?>>

				<?php dynamic_sidebar( 'lsvr-pressville-footer-widgets' ); ?>

			</div>
		</div>
	</div>
	<!-- FOOTER WIDGETS : end -->

<?php endif; ?>