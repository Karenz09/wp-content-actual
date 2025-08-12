<?php if ( true === get_theme_mod( 'header_search_enable', true ) ) : ?>

	<!-- HEADER SEARCH WRAPPER : begin -->
	<div class="header-search__wrapper">

		<!-- HEADER SEARCH TOGGLE : begin -->
		<button id="header-search-toggle" type="button"
			class="header-search__toggle"
			title="<?php echo esc_attr( esc_html__( 'Expand search', 'pressville' ) ); ?>"
        	data-label-expand-popup="<?php echo esc_attr( esc_html__( 'Expand search', 'pressville' ) ); ?>"
        	data-label-collapse-popup="<?php echo esc_attr( esc_html__( 'Collapse search', 'pressville' ) ); ?>"
            aria-controls="header-search"
            aria-haspopup="true"
            aria-expanded="false">
			<span class="header-search__toggle-icon" aria-hidden="true"></span>
		</button>
		<!-- HEADER SEARCH TOGGLE : end -->

		<!-- HEADER SEARCH : begin -->
		<div id="header-search"
			class="header-search<?php if ( true === get_theme_mod( 'header_search_ajax_enable', true ) ) { echo ' header-search--ajaxed'; } ?>"
			role="group"
			aria-expanded="false">
			<div class="header-search__inner">

				<!-- SEARCH FORM : begin -->
				<form class="header-search__form"
					action="<?php echo esc_url( home_url( '/' ) ); ?>"
					method="get"
				 	role="search">

					<?php if ( ! empty( $_GET['lang'] ) ) : ?>
						<input type="hidden" class="header-search__lang-input" name="lang" value="<?php echo esc_attr( $_GET['lang'] ); ?>">
					<?php endif; ?>

					<!-- SEARCH OPTIONS : begin -->
					<div class="header-search__options">

						<label for="header-search-input" class="header-search__input-label"><?php esc_html_e( 'Search:', 'pressville' ); ?></label>

						<!-- INPUT WRAPPER : begin -->
						<div class="header-search__input-wrapper">

							<input id="header-search-input" type="text" name="s" autocomplete="off"
								class="header-search__input"
								value="<?php echo esc_attr( get_search_query() ); ?>"
								placeholder="<?php echo get_theme_mod( 'header_search_input_placeholder', esc_html__( 'Search this site', 'pressville' ) ); ?>"
								aria-label="<?php esc_html_e( 'Search field', 'pressville' ); ?>">

							<button class="header-search__submit" type="submit" title="<?php esc_html_e( 'Submit search', 'pressville' ); ?>">
								<span class="header-search__submit-icon" aria-hidden="true"></span>
							</button>

							<div class="c-spinner header-search__spinner" aria-hidden="true"></div>

						</div>
						<!-- INPUT WRAPPER : end -->

						<?php // Search filter
						get_template_part( 'template-parts/header/search-filter' ); ?>

					</div>
					<!-- SEARCH OPTIONS : end -->

					<button class="header-search__form-close-button screen-reader-text" type="button"><?php esc_html_e( 'Collapse search', 'pressville' ); ?></button>

				</form>
				<!-- SEARCH FORM : end -->

				<span class="header-search__arrow" aria-hidden="true"></span>

			</div>
		</div>
		<!-- HEADER SEARCH : end -->

	</div>
	<!-- HEADER SEARCH WRAPPER : end -->

<?php endif; ?>