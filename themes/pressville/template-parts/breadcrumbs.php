<?php if ( true === apply_filters( 'lsvr_pressville_breadcrumbs_enable', true ) &&
	! empty( apply_filters( 'lsvr_pressville_breadcrumbs', '' ) ) &&
	count( apply_filters( 'lsvr_pressville_breadcrumbs', '' ) ) >= apply_filters( 'lsvr_pressville_breadcrumbs_min_length', 2 ) ) : ?>

	<?php do_action( 'lsvr_pressville_breadcrumbs_before' ); ?>

	<!-- BREADCRUMBS : begin -->
	<div id="breadcrumbs">
		<div class="breadcrumbs__inner ">
			<div class="lsvr-container">

				<?php do_action( 'lsvr_pressville_breadcrumbs_top' ); ?>

				<?php if ( true === apply_filters( 'lsvr_pressville_narrow_content_enable', false ) ) : ?>

					<div class="lsvr-grid">
						<div class="menu-eventos-grid__col lsvr-grid__col--xlg-span-8 lsvr-grid__col--xlg-push-2">
							
				<?php endif; ?>

				<nav class="breadcrumbs__nav" aria-label="<?php echo esc_attr( esc_html__( 'Breadcrumbs', 'pressville' ) ); ?>">
					<ul class="breadcrumbs__list">

						<?php foreach ( apply_filters( 'lsvr_pressville_breadcrumbs', '' ) as $breadcrumb ) : ?>

							<li class="breadcrumbs__item">
								<span class="breadcrumbs__item-decor" aria-hidden="true"></span>
								<a href="<?php echo esc_url( $breadcrumb['url'] ); ?>" class="breadcrumbs__link"><?php echo esc_html( $breadcrumb['label'] ); ?></a>
							</li>

						<?php endforeach; ?>

					</ul>
				</nav>

				<div>
					<?php // Header languages
					get_template_part( 'template-parts/header/languages-voces' ); ?>
				</div>

				<?php if ( true === apply_filters( 'lsvr_pressville_narrow_content_enable', false ) ) : ?>

						</div>
					</div>

				<?php endif; ?>

				<?php do_action( 'lsvr_pressville_breadcrumbs_bottom' ); ?>

			</div>
		</div>
		
	</div>
	<!-- BREADCRUMBS : end -->

	<?php do_action( 'lsvr_pressville_breadcrumbs_after' ); ?>

<?php endif; ?>