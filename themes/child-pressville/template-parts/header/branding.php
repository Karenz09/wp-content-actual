<?php if ( has_custom_logo() ) : ?>

	<!-- HEADER BRANDING : begin -->
	<div class="header-titlebar__logo">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-titlebar__logo-link"
			aria-label="<?php esc_html_e( 'Site logo', 'pressville' ); ?>">
			<img src="<?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) ); ?>"
				class="header-titlebar__logo-image"
				alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		</a>
	</div>
	<!-- HEADER BRANDING : end -->

<?php endif; ?>