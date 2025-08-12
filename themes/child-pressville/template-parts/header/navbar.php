<?php if ( has_nav_menu( 'lsvr-pressville-header-menu-primary' ) || true === get_theme_mod( 'header_search_enable', true ) ) : ?>

	<?php // Add custom code before header navbar
	do_action( 'lsvr_pressville_header_navbar_before' ); ?>

	<!-- HEADER NAVBAR : begin -->
	<div <?php lsvr_pressville_the_header_navbar_class(); ?>>
		<div class="header-navbar__inner">
			<div class="lsvr-container">
				<div class="header-navbar__content">

					<?php // Add custom code at the top of header navbar
					do_action( 'lsvr_pressville_header_navbar_top' ); ?>

					<?php // Header menu
					get_template_part( 'template-parts/header/menu-primary' ); ?>

					<?php // Add custom code before header navbar search
					do_action( 'lsvr_pressville_header_navbar_search_before' ); ?>

					<?php // Header search
					get_template_part( 'template-parts/header/search' ); ?>

					<?php // Add custom code at the bottom of header navbar
					do_action( 'lsvr_pressville_header_navbar_bottom' ); ?>

				</div>
			</div>
		</div>
	</div>
	<!-- HEADER NAVBAR : end -->

	<?php // Add custom code after header navbar
	do_action( 'lsvr_pressville_header_navbar_after' ); ?>

<?php endif; ?>