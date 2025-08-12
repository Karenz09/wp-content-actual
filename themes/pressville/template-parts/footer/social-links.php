<?php if ( lsvr_pressville_has_footer_social_links() ) : ?>

	<!-- FOOTER SOCIAL LINKS : begin -->
	<div class="footer-social">
		<ul class="footer-social__list" title="<?php echo esc_attr( esc_html__( 'Social Media Links' ,'pressville' ) ); ?>">

			<?php // Add custom code at the top of the footer social links list
			do_action( 'lsvr_pressville_footer_social_links_list_top' ); ?>

			<?php foreach ( lsvr_pressville_get_social_links() as $social_link ) : ?>

				<?php if ( ! empty( $social_link['url'] ) && ! empty( $social_link['icon'] ) && ! empty( $social_link['name'] ) ) : ?>

					<li class="footer-social__item footer-social__item--<?php echo esc_attr( $social_link['name'] ); ?>">

						<a class="footer-social__link footer-social__link--<?php echo esc_attr( $social_link['name'] ); ?>" target="_blank"

							<?php if ( filter_var( $social_link['url'], FILTER_VALIDATE_EMAIL ) ) : ?>

								href="mailto:<?php echo esc_attr( $social_link['url'] ); ?>"

							<?php else : ?>

								href="<?php echo esc_url( $social_link['url'] ); ?>"

							<?php endif; ?>

							<?php if ( ! empty( $social_link['label'] ) ) { echo ' title="' . esc_attr( $social_link['label'] ) . '"'; } ?>>

							<span class="footer-social__icon <?php echo esc_attr( $social_link['icon'] ); ?>" aria-hidden="true">

								<?php if ( ! empty( $social_link['label'] ) ) : ?>

									<span class="screen-reader-text"><?php echo esc_html( $social_link['label'] ); ?></span>

								<?php endif; ?>

							</span>

						</a>

					</li>

				<?php endif; ?>

			<?php endforeach; ?>

			<?php // Add custom code at the bottom of the footer social links list
			do_action( 'lsvr_pressville_footer_social_links_list_bottom' ); ?>

		</ul>
	</div>
	<!-- FOOTER SOCIAL LINKS : end -->

<?php endif; ?>