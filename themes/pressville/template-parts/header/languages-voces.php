<?php if ( ! empty( lsvr_pressville_get_languages() ) ) : ?>

	<!-- HEADER LANGUAGES : begin -->
	<div class="header-languages clase-voces">


		<span class="screen-reader-text"><?php esc_html_e( 'Choose language:', 'pressville' ); ?></span>
		<ul class="header-languages__list">

			<?php foreach ( lsvr_pressville_get_languages() as $language ) : ?>
				<?php if ( ! empty( $language['label'] ) && ! empty( $language['url'] ) ) : ?>

					<li class="header-languages__item<?php if ( ! empty( $language['active'] ) ) { echo ' header-languages__item--active'; } ?>">
						<a href="<?php echo esc_url( $language['url'] ); ?>" class="header-languages__item-link"><?php echo esc_html( $language['label'] ); ?></a>
					</li>

				<?php endif; ?>
			<?php endforeach; ?>

		</ul>

	</div>
	<!-- HEADER LANGUAGES : end -->

<?php endif; ?>