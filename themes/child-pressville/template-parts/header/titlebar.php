<!-- HEADER TITLEBAR : begin -->
<div <?php lsvr_pressville_the_header_titlebar_class(); ?>>

	<div class="header-titlebar__inner">
		<div class="lsvr-container">

			<?php // Add custom code at the top of header titlebar
			do_action( 'lsvr_pressville_header_titlebar_top' ); ?>

			<?php // Branding
			get_template_part( 'template-parts/header/branding' ); ?>

			<?php // Header title and description
			if ( lsvr_pressville_has_header_site_title() || lsvr_pressville_has_header_description() ) : ?>

				<div class="header-titlebar__text">

					<?php if ( lsvr_pressville_has_header_site_title() && is_front_page() ) : ?>

						<h1 class="header-titlebar__title header-titlebar__title--frontpage">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-titlebar__title-link">
								<?php bloginfo( 'name' ); ?>
							</a>
						</h1>

					<?php elseif ( lsvr_pressville_has_header_site_title() ) : ?>

						<?php if ( is_single() || is_home() || is_404()) : ?>

							<p class="header-titlebar__title header-titlebar__title--subpage is-secondary-font">
							<a href="<?php echo esc_url( home_url( '/index.php/voces/' ) ); ?>" class="header-titlebar__title-link">
								Voces <?php bloginfo( 'name' ); ?>
							</a>
						</p>
						<?php else: ?>
						<p class="header-titlebar__title header-titlebar__title--subpage is-secondary-font">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-titlebar__title-link">
								<?php bloginfo( 'name' ); ?>
							</a>
						</p>
						<?php endif; ?>


					<?php endif; ?>

					<?php if ( lsvr_pressville_has_header_description() ) : ?>

						<p class="header-titlebar__description"><?php bloginfo( 'description' ); ?></p>

					<?php endif; ?>

				</div>

			<?php endif; ?>

			<?php // Add custom code at the bottom of header titlebar
			do_action( 'lsvr_pressville_header_titlebar_bottom' ); ?>

		</div>
	</div>

	<?php // Background
	get_template_part( 'template-parts/header/titlebar-background' ); ?>

</div>
<!-- HEADER TITLEBAR : end -->