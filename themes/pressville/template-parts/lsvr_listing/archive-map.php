<?php if ( have_posts() && lsvr_pressville_has_maps_provider() && true === get_theme_mod( 'lsvr_listing_archive_map_enable', true ) ) : ?>

	<!-- LISTING ARCHIVE MAP : begin -->
	<div class="lsvr_listing-map lsvr_listing-map--<?php echo esc_attr( lsvr_pressville_get_maps_platform() ); ?>">

		<div id="lsvr_listing-map__canvas"
			class="lsvr_listing-map__canvas lsvr_listing-map__canvas--loading"
			data-map-provider="<?php echo esc_attr( lsvr_pressville_get_maps_provider() ); ?>"

			<?php if ( ! empty( lsvr_pressville_get_listing_archive_map_query_json() ) ) : ?>
				data-query="<?php echo esc_attr( lsvr_pressville_get_listing_archive_map_query_json() ); ?>"
			<?php endif; ?>

			<?php if ( 'gmaps' === lsvr_pressville_get_maps_provider() ) : ?>
				data-maptype="<?php echo esc_attr( get_theme_mod( 'lsvr_listing_archive_map_type', 'roadmap' ) ); ?>"
			<?php endif; ?>

			data-zoom="<?php echo esc_attr( get_theme_mod( 'lsvr_listing_archive_map_zoom', 16 ) ); ?>"
			data-mousewheel="false"></div>

		<div class="c-spinner lsvr_listing-map__spinner"></div>

	</div>
	<!-- LISTING ARCHIVE MAP : end -->

<?php endif; ?>