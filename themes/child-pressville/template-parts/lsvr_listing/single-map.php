<?php  if ( lsvr_pressville_has_maps_provider() && true === get_theme_mod( 'lsvr_listing_single_map_enable', true ) ) : $listing_meta = lsvr_pressville_get_listing_meta( get_the_ID() ); ?>

	<?php if ( ( ! empty( $listing_meta['latitude'] ) && ! empty( $listing_meta['longitude'] ) )
		|| ( ! empty( $listing_meta['latitude_geocoded'] ) && ! empty( $listing_meta['longitude_geocoded'] ) ) ) : ?>

		<!-- LISTING MAP : begin -->
		<div class="post__map c-map c-map--<?php echo esc_attr( lsvr_pressville_get_maps_platform() ); ?>">

			<div id="lsvr_listing-post-single-map__canvas"
				class="post__map-canvas c-map__canvas c-map__canvas--loading"
				data-map-provider="<?php echo esc_attr( lsvr_pressville_get_maps_provider() ); ?>"

				<?php if ( ! empty( $listing_meta['locating_method'] ) && 'latlong' === $listing_meta['locating_method'] && ! empty( $listing_meta['latitude'] ) && ! empty( $listing_meta['longitude'] ) ) : ?>

					data-latlong="<?php echo esc_attr( $listing_meta['latitude'] . ',' . $listing_meta['longitude'] ); ?>"
					data-locating-method="latlong"

				<?php elseif ( ! empty( $listing_meta['locating_method'] ) && 'address' === $listing_meta['locating_method'] && ! empty( $listing_meta['latitude_geocoded'] ) && ! empty( $listing_meta['longitude_geocoded'] ) ) : ?>

					data-latlong="<?php echo esc_attr( $listing_meta['latitude_geocoded'] . ',' . $listing_meta['longitude_geocoded'] ); ?>"
					data-locating-method="address"

				<?php endif; ?>

				<?php if ( ! empty( $listing_meta['accurate_address'] ) ) : ?>
					data-address="<?php echo esc_attr( $listing_meta['accurate_address'] ); ?>"
				<?php endif; ?>

				<?php if ( 'gmaps' === lsvr_pressville_get_maps_provider() ) : ?>
					data-maptype="<?php echo esc_attr( get_theme_mod( 'lsvr_listing_single_map_type', 'roadmap' ) ); ?>"
				<?php endif; ?>

				data-zoom="<?php echo esc_attr( get_theme_mod( 'lsvr_listing_single_map_zoom', 17 ) ); ?>"
				data-mousewheel="false"></div>

		</div>
		<!-- LISTING MAP : end -->

	<?php endif; ?>

<?php endif; ?>