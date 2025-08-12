<?php if ( true ) : ?>

	<!-- HEADER TOPBAR WRAPPER : begin -->
	<div class="header-topbar__wrapper">
		<div class="lsvr-container">

			<?php // Add custom code before header topbar
			do_action( 'lsvr_pressville_header_topbar_before' ); ?>

			<!-- HEADER TOPBAR : begin -->
			<?php if ( true ) : ?>
			<div class="header-topbar">
				<div class="header-topbar__inner">
					<?php
if ( function_exists( 'pll_the_languages' ) ) {
    pll_the_languages( array( 'show_flags' => 1, 'show_names' => 1 ) );
}
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