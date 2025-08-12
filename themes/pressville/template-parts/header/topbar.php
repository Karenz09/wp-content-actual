<?php if ( has_nav_menu( 'lsvr-pressville-header-menu-secondary' ) || lsvr_pressville_has_languages() ) : ?>

	<!-- HEADER TOPBAR WRAPPER : begin -->
	<div class="header-topbar__wrapper">
		<div class="lsvr-container">

			<?php // Add custom code before header topbar
			do_action( 'lsvr_pressville_header_topbar_before' ); ?>

			<!-- HEADER TOPBAR : begin -->
			<?php if ( !is_single() || !is_home()) : ?>
			<div class="header-topbar">
				<div class="header-topbar__inner">
					<?php // Add custom code at the top of header topbar
						if ( !is_single() || !is_home()) :
							do_action( 'lsvr_pressville_header_topbar_top' ); 
						endif;
					?>

					<?php // Header secondary menu
					get_template_part( 'template-parts/header/menu-secondary' ); ?>

					<?php // Add custom code before header languages
					do_action( 'lsvr_pressville_header_topbar_languages_before' ); ?>

					<?php // Header languages
					get_template_part( 'template-parts/header/languages' ); ?>

					<?php // Add custom code at the bottom of header topbar
					//do_action( 'lsvr_pressville_header_topbar_bottom' ); ?>

				</div>
			</div>
			<?php endif; ?>

			<!-- HEADER TOPBAR : end -->

			<?php // Add custom code after header topbar
			do_action( 'lsvr_pressville_header_topbar_after' ); ?>

		</div>
	</div>
	<!-- HEADER TOPBAR WRAPPER : end -->

<?php endif; ?>