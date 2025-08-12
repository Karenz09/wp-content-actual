<?php if ( lsvr_pressville_has_maps_provider() && true === get_theme_mod( 'lsvr_event_single_map_enable', true ) ) : $event_location_meta = lsvr_pressville_get_event_location_meta( get_the_ID() ); ?>

	<?php if ( ! empty( $event_location_meta['latitude'] ) && ! empty( $event_location_meta['longitude'] ) ) : ?>

		<!-- EVENT LOCATION MAP : begin -->
		<div class="post__map c-map c-map--<?php echo esc_attr( lsvr_pressville_get_maps_platform() ); ?>">

			<div id="lsvr_event-post-single__map-canvas"
				class="post__map-canvas c-map__canvas c-map__canvas--loading"
				data-map-provider="<?php echo esc_attr( lsvr_pressville_get_maps_provider() ); ?>"

				<?php if ( ! empty( $event_location_meta['latitude'] ) && ! empty( $event_location_meta['longitude'] ) ) : ?>
					data-latlong="<?php echo esc_attr( $event_location_meta['latitude'] . ',' . $event_location_meta['longitude'] ); ?>"
				<?php endif; ?>

				<?php if ( ! empty( $event_location_meta['accurate_address'] ) ) : ?>
					data-address="<?php echo esc_attr( $event_location_meta['accurate_address'] ); ?>"
				<?php endif; ?>

				<?php if ( 'gmaps' === lsvr_pressville_get_maps_provider() ) : ?>
					data-maptype="<?php echo esc_attr( get_theme_mod( 'lsvr_event_single_map_type', 'roadmap' ) ); ?>"
				<?php endif; ?>

				data-zoom="<?php echo esc_attr( get_theme_mod( 'lsvr_event_single_map_zoom', 17 ) ); ?>"
				data-mousewheel="false"></div>

		</div>
		<!-- EVENT LOCATION MAP : end -->

	<?php endif; ?>

<?php endif; ?>