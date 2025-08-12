<?php if ( true === get_theme_mod( 'header_search_filter_enable', true ) ) : ?>

	<!-- SEARCH FILTER : begin -->
	<div class="header-search__filter">

		<p class="header-search__filter-title"><?php esc_html_e( 'Filter results:', 'pressville' ); ?></p>

		<label for="header-search-filter-type-any" class="header-search__filter-label">
			<input type="checkbox" class="header-search__filter-checkbox"
				id="header-search-filter-type-any"
				name="lsvr-search-filter[]" value="any"
				<?php if ( empty( lsvr_pressville_get_header_search_active_filters() ) || in_array( 'any', lsvr_pressville_get_header_search_active_filters() ) ) { echo ' checked="checked"'; } ?>>
				<?php esc_html_e( 'everything', 'pressville' ); ?>
		</label>

		<?php foreach ( apply_filters( 'lsvr_pressville_header_search_filter', array() ) as $filter ) : if ( ! empty( $filter['name'] ) && ! empty( $filter['label'] ) ) : ?>

			<label for="header-search-filter-type-<?php echo esc_attr( $filter['name'] ); ?>" class="header-search__filter-label">
				<input type="checkbox" class="header-search__filter-checkbox"
					id="header-search-filter-type-<?php echo esc_attr( $filter['name'] ); ?>"
					name="lsvr-search-filter[]" value="<?php echo esc_attr( $filter['name'] ); ?>"
					<?php if ( in_array( $filter['name'], lsvr_pressville_get_header_search_active_filters() ) ) { echo ' checked="checked"'; } ?>>
					<?php echo esc_html( $filter['label'] ); ?>
			</label>

		<?php endif; endforeach; ?>


	</div>
	<!-- SEARCH FILTER : end -->

<?php endif; ?>