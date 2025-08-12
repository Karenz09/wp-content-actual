<?php // Footer text
if ( ! empty( get_theme_mod( 'footer_text', '&copy; CURRENT_YEAR ' . get_bloginfo( 'name' ) ) ) ) : ?>

	<!-- FOOTER TEXT : begin -->
	<div class="footer-text">

		<?php echo wpautop(
			wp_kses(
				str_replace( 'CURRENT_YEAR', date( 'Y' ), get_theme_mod( 'footer_text', '&copy; CURRENT_YEAR ' . get_bloginfo( 'name' ) ) ),
				array(
					'a' => array(
						'href' => array(),
						'title' => array(),
						'target' => array(),
					),
					'em' => array(),
					'br' => array(),
					'strong' => array(),
					'span' => array(
						'class' => array(),
						'style' => array(),
					),
					'p' => array(),
				)
			)
		); ?>

	</div>
	<!-- FOOTER TEXT : end -->

<?php endif; ?>