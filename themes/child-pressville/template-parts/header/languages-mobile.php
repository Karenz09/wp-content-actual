<?php if ( lsvr_pressville_has_languages() ) : ?>

	<!-- HEADER LANGUAGES MOBILE : begin -->
	<div class="header-languages-mobile">

		<?php if ( ! empty( lsvr_pressville_get_active_language_label() ) ) : ?>

			<button id="header-languages-mobile__toggle" type="button"
				class="header-languages-mobile__toggle" title="<?php echo esc_attr( esc_html__( 'Show languages', 'pressville' ) ); ?>"
				aria-controls="header-languages-mobile__inner"
    			aria-haspopup="true"
    			aria-expanded="false"
				data-label-expand-popup="<?php echo esc_attr( esc_html__( 'Show languages', 'pressville' ) ); ?>"
    			data-label-collapse-popup="<?php echo esc_attr( esc_html__( 'Hide languages', 'pressville' ) ); ?>">
				<?php echo esc_html( lsvr_pressville_get_active_language_label() ); ?>
			</button>

		<?php endif; ?>

		<div id="header-languages-mobile__inner" class="header-languages-mobile__inner"
			role="group"
            aria-expanded="false">
			<span class="screen-reader-text"><?php esc_html_e( 'Choose language:', 'pressville' ); ?></span>
			<ul class="header-languages-mobile__list">

				<?php foreach ( lsvr_pressville_get_languages() as $language ) : ?>
					<?php if ( ! empty( $language['label'] ) && ! empty( $language['url'] ) ) : ?>

						<li class="header-languages-mobile__item<?php if ( ! empty( $language['active'] ) ) { echo ' header-languages-mobile__item--active'; } ?>">
							<a href="<?php echo esc_url( $language['url'] ); ?>" class="header-languages-mobile__item-link"><?php echo esc_html( $language['label'] ); ?></a>
						</li>

					<?php endif; ?>
				<?php endforeach; ?>

			</ul>
		</div>

	</div>
	<!-- HEADER LANGUAGES MOBILE : end -->

<?php endif; ?>