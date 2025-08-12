<?php if ( true === get_theme_mod( 'improved_accessibility_enable', true ) ) : ?>

	<a href="#main" class="accessibility-link accessibility-link--skip-to-content screen-reader-text"><?php esc_html_e( 'Skip to content', 'pressville' ); ?></a>

	<?php if ( has_nav_menu( 'lsvr-pressville-header-menu-primary' ) ) : ?>
		<a href="#header-menu-primary" class="accessibility-link accessibility-link--skip-to-nav screen-reader-text"><?php esc_html_e( 'Skip to main navigation', 'pressville' ); ?></a>
	<?php endif; ?>

	<a href="#footer" class="accessibility-link accessibility-link--skip-to-footer screen-reader-text"><?php esc_html_e( 'Skip to footer', 'pressville' ); ?></a>

<?php endif; ?>