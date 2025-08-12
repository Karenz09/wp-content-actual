<?php

// Get event archive layout
if ( ! function_exists( 'lsvr_pressville_get_event_archive_layout' ) ) {
	function lsvr_pressville_get_event_archive_layout() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$path_prefix = 'template-parts/lsvr_event/archive-layout-';

		// Get layout from Customizer
		if ( ! empty( locate_template( $path_prefix . get_theme_mod( 'lsvr_event_archive_layout', 'default' ) . '.php' ) ) ) {
			return get_theme_mod( 'lsvr_event_archive_layout', 'default' );
		}

		// Default layout
		else {
			return 'default';
		}

	}
}

// Event archive categories
if ( ! function_exists( 'lsvr_pressville_the_event_archive_categories' ) ) {
	function lsvr_pressville_the_event_archive_categories() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$url_args = array();

		// Add date from and date to params to URL
		if ( isset( $_GET['date_from'] ) ) {
			$url_args['date_from'] = preg_replace( '/[^0-9-]/', '', $_GET['date_from'] );
		}
		if ( isset( $_GET['date_to'] ) ) {
			$url_args['date_to'] = preg_replace( '/[^0-9-]/', '', $_GET['date_to'] );
		}

		$terms = get_terms( 'lsvr_event_cat' );
		if ( ! empty( $terms ) ) { ?>

			<!-- POST ARCHIVE CATEGORIES : begin -->
			<div class="post-archive-categories">
				<h6 class="screen-reader-text"><?php esc_html_e( 'Categories:', 'pressville' ); ?></h6>
				<ul class="post-archive-categories__list">

					<li class="post-archive-categories__item">
						<?php if ( is_tax( 'lsvr_event_cat' ) ) : ?>
							<a href="<?php echo esc_url( add_query_arg( $url_args, get_post_type_archive_link( 'lsvr_event' ) ) ); ?>" class="post-archive-categories__item-link"><?php esc_html_e( 'All', 'pressville' ); ?></a>
						<?php else : ?>
							<?php esc_html_e( 'All', 'pressville' ); ?>
						<?php endif; ?>
					</li>

					<?php foreach ( $terms as $term ) : ?>
						<li class="post-archive-categories__item">
							<?php if ( get_queried_object_id() === $term->term_id ) : ?>
								<?php echo esc_html( $term->name ); ?>
							<?php else : ?>
								<a href="<?php echo esc_url( add_query_arg( $url_args, get_term_link( $term->term_id, 'lsvr_event_cat' ) ) ); ?>" class="post-archive-categories__item-link"><?php echo esc_html( $term->name ); ?></a>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>

				</ul>
			</div>
			<!-- POST ARCHIVE CATEGORIES : end -->

		<?php }

	}
}

// Event filter
if ( ! function_exists( 'lsvr_pressville_the_event_archive_filter' ) ) {
	function lsvr_pressville_the_event_archive_filter() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		if ( true === get_theme_mod( 'lsvr_event_archive_filter_enable', true ) && ( is_post_type_archive( 'lsvr_event' ) || is_tax( 'lsvr_event_cat' ) || is_tax( 'lsvr_event_location' ) ) ) { ?>

			<!-- POST FILTER : begin -->
			<div class="post-archive-filter">
				<div class="post-archive-filter__inner">

					<?php // Hook before form
					do_action( 'lsvr_pressville_event_archive_filter_form_before' ); ?>

					<!-- FILTER FORM : begin -->
					<form class="post-archive-filter__form" method="get"
						action="<?php echo esc_url( lsvr_pressville_get_event_archive_filter_form_action() ); ?>">
						<div class="post-archive-filter__form-inner">

							<?php // Hook before form fields
							do_action( 'lsvr_pressville_event_archive_filter_form_fields_before' ); ?>

							<!-- DATE FROM : begin -->
							<p class="post-archive-filter__option post-archive-filter__option--datepicker post-archive-filter__option--date-from">
								<label for="post-archive-filter__date-from" class="post-archive-filter__label"><?php esc_html_e( 'Date from:', 'pressville' ); ?></label>
								<input type="text" class="post-archive-filter__input post-archive-filter__input--datepicker"
									name="date_from" id="post-archive-filter__date-from"
									placeholder="<?php esc_html_e( 'Choose Date', 'pressville' ); ?>"
									<?php if ( isset( $_GET['date_from'] ) ) : ?>
										value="<?php echo preg_replace( '/[^0-9-]/', '', $_GET['date_from'] ); ?>"
									<?php endif; ?>>
							</p>
							<!-- DATE FROM : end -->

							<!-- DATE TO : begin -->
							<p class="post-archive-filter__option post-archive-filter__option--datepicker post-archive-filter__option--date-to">
								<label for="post-archive-filter__date-to" class="post-archive-filter__label"><?php esc_html_e( 'Date to:', 'pressville' ); ?></label>
								<input type="text" class="post-archive-filter__input post-archive-filter__input--datepicker"
									name="date_to" id="post-archive-filter__date-to"
									placeholder="<?php esc_html_e( 'Choose Date', 'pressville' ); ?>"
									<?php if ( isset( $_GET['date_to'] ) ) : ?>
										value="<?php echo preg_replace( '/[^0-9-]/', '', $_GET['date_to'] ); ?>"
									<?php endif; ?>>
							</p>
							<!-- DATE to : end -->

							<?php // Hook before form submit
							do_action( 'lsvr_pressville_event_archive_filter_form_submit_before' ); ?>

							<!-- SUBMIT : begin -->
							<p class="post-archive-filter__submit">
								<button type="submit" class="post-archive-filter__submit-button">
									<?php esc_html_e( 'Filter', 'pressville' ); ?>
								</button>
							</p>
							<!-- SUBMIT : end -->

							<!-- RESET : begin -->
							<p class="post-archive-filter__reset">
								<button type="button" class="post-archive-filter__reset-button">
									<?php esc_html_e( 'Reset filter', 'pressville' ); ?>
								</button>
							</p>
							<!-- RESET : end -->

							<?php // Hook after form submit
							do_action( 'lsvr_pressville_event_archive_filter_form_submit_after' ); ?>

						</div>
					</form>
					<!-- FILTER FORM : end -->

					<?php // Hook after form
					do_action( 'lsvr_pressville_event_archive_filter_form_after' ); ?>

				</div>
			</div>
			<!-- POST FILTER : end -->

		<?php }

	}
}

// Event post thumbnail
if ( ! function_exists( 'lsvr_pressville_the_event_post_archive_thumbnail' ) ) {
	function lsvr_pressville_the_event_post_archive_thumbnail( $post_id ) {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		if ( has_post_thumbnail( $post_id ) ) {

			$thumb_size = (int) get_theme_mod( 'lsvr_event_archive_grid_columns', 3 ) < 4 ? 'large' : 'medium';

			// Cropped thumbnail
			if ( true === get_theme_mod( 'lsvr_event_archive_cropped_thumb_enable', true ) ) {
				echo '<p class="post__thumbnail"><a href="' . esc_url( get_permalink( $post_id ) ) . '" class="post__thumbnail-link post__thumbnail-link--cropped"';
				echo ' style="background-image: url( \'' . esc_url( get_the_post_thumbnail_url( $post_id, $thumb_size ) ) . '\' );">';
				echo '</a></p>';
			}

			// Regular thumbnail
			else {
				echo '<p class="post__thumbnail"><a href="' . esc_url( get_permalink( $post_id ) ) . '" class="post__thumbnail-link">';
				echo get_the_post_thumbnail( $post_id, $thumb_size );
				echo '</a></p>';
			}

		}

	}
}

// Event pagination
if ( ! function_exists( 'lsvr_pressville_the_event_archive_pagination' ) ) {
	function lsvr_pressville_the_event_archive_pagination() {
		if ( function_exists( 'lsvr_events_get_event_archive_pagination' ) ) {

			trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

			$args = array();

			// Pass "date from" attribute
			if ( ! empty( $_GET['date_from'] ) ) {
				$args['date_from'] = $_GET['date_from'];
			}

			// Pass "date to" attribute
			if ( ! empty( $_GET['date_to'] ) ) {
				$args['date_to'] = $_GET['date_to'];
			}

			// Pass "keyword" attribute
			if ( ! empty( $_GET['keyword'] ) ) {
				$args['keyword'] = $_GET['keyword'];
			}

			// If "date from" and "date to" are not defined, show upcoming events
			if ( empty( $_GET['date_from'] ) && empty( $_GET['date_to'] ) ) {
				$args['period'] = 'future';
			}

			// Get pagination data
			$pagination = lsvr_events_get_event_archive_pagination(
				$args,
				get_theme_mod( 'lsvr_event_archive_posts_per_page', 12 ), // Number of posts per page
				2 // Range of displayed page numbers relative to current page number
			);

			if ( ! empty( $pagination ) ) { ?>

				<!-- PAGINATION : begin -->
				<nav class="post-pagination">
					<h6 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'pressville' ); ?></h6>
					<ul class="post-pagination__list">

						<?php // Prev link
						if ( ! empty( $pagination['prev'] ) ) : ?>
							<li class="post-pagination__item post-pagination__prev">
								<a href="<?php echo esc_url( $pagination['prev'] ); ?>"
									class="post-pagination__item-link">
									<?php esc_html_e( 'Previous', 'pressville' ); ?>
								</a>
							</li>
						<?php endif; ?>

						<?php // First page
						if ( ! empty( $pagination['page_first'] ) ) : ?>
							<li class="post-pagination__item post-pagination__number post-pagination__number--first<?php if ( 1 === $pagination['current_page'] ) { echo ' post-pagination__number--active'; } ?>">
								<a href="<?php echo esc_url( $pagination['page_first'] ); ?>"
									class="post-pagination__number-link">1</a>
							</li>
						<?php endif; ?>

						<?php // Page numbers
						if ( ! empty( $pagination['page_numbers'] ) ) : ?>

							<?php // Dots before
							if ( (int) key( $pagination['page_numbers'] ) > 2 ) : ?>
								<li class="post-pagination__item post-pagination__dots">&hellip;</li>
							<?php endif; ?>

							<?php // Page numbers
							foreach ( $pagination['page_numbers'] as $number => $permalink ) : ?>
								<li class="post-pagination__item post-pagination__number<?php if ( (int) $number === $pagination['current_page'] ) { echo ' post-pagination__number--active'; } ?>">
									<a href="<?php echo esc_url( $permalink ); ?>"
										class="post-pagination__number-link">
										<?php echo esc_html( $number ); ?>
									</a>
								</li>
							<?php endforeach; ?>

							<?php // Dots after
							end( $pagination['page_numbers'] );
							if ( (int) key( $pagination['page_numbers'] ) < (int) $pagination['pages_count'] - 1 ) : ?>
								<li class="post-pagination__item post-pagination__dots">&hellip;</li>
							<?php endif; ?>

						<?php endif; ?>

						<?php // Last page
						if ( ! empty( $pagination['page_last'] ) && ! empty( $pagination['pages_count'] ) ) : ?>
							<li class="post-pagination__item post-pagination__number post-pagination__number--last<?php if ( (int) $pagination['pages_count'] === (int) $pagination['current_page'] ) { echo ' post-pagination__number--active'; } ?>">
								<a href="<?php echo esc_url( $pagination['page_last'] ); ?>"
									class="post-pagination__number-link">
									<?php echo (int) $pagination['pages_count']; ?>
								</a>
							</li>
						<?php endif; ?>

						<?php // Next link
						if ( ! empty( $pagination['next'] ) ) : ?>
							<li class="post-pagination__item post-pagination__next">
								<a href="<?php echo esc_url( $pagination['next'] ); ?>"
									class="post-pagination__item-link">
									<?php esc_html_e( 'Next', 'pressville' ); ?>
								</a>
							</li>
						<?php endif; ?>

					</ul>
				</nav>
				<!-- PAGINATION : end -->

			<?php }

		}
	}
}

// Event post archive timeline thumbnail
if ( ! function_exists( 'lsvr_pressville_the_event_post_archive_timeline_thumbnail' ) ) {
	function lsvr_pressville_the_event_post_archive_timeline_thumbnail( $post_id ) {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		if ( has_post_thumbnail( $post_id ) ) {
			echo '<p class="post__thumbnail"><a href="' . esc_url( get_permalink( $post_id ) ) . '" class="post__thumbnail-link"';
			echo ' style="background-image: url( \'' . esc_url( get_the_post_thumbnail_url( $post_id, 'thumbnail' ) ) . '\' );">';
			echo '</a></p>';
		}

	}
}

// Event location map
if ( ! function_exists( 'lsvr_pressville_the_event_location_map' ) ) {
	function lsvr_pressville_the_event_location_map( $post_id ) {
		if ( function_exists( 'lsvr_events_get_event_location_meta' ) ) {

			trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

			$event_location_meta = lsvr_events_get_event_location_meta( $post_id );

			if ( true === get_theme_mod( 'lsvr_event_single_map_enable', true ) &&
				! empty( $event_location_meta['accurate_address'] ) ||
				( ! empty( $event_location_meta['latitude'] ) && ! empty( $event_location_meta['longitude'] ) ) ) { ?>

				<!-- GOOGLE MAP : begin -->
				<div class="c-gmap post__map">
					<div class="c-gmap__canvas c-gmap__canvas--loading post__map-canvas"
					id="lsvr_event-post-single__map-canvas"
					<?php if ( ! empty( $event_location_meta['latitude'] ) && ! empty( $event_location_meta['longitude'] ) ) : ?>
						data-latlong="<?php echo esc_attr( $event_location_meta['latitude'] . ',' . $event_location_meta['longitude'] ); ?>"
					<?php elseif ( ! empty( $event_location_meta['accurate_address'] ) ) : ?>
						data-address="<?php echo esc_attr( $event_location_meta['accurate_address'] ); ?>"
					<?php endif; ?>
					data-maptype="<?php echo esc_attr( get_theme_mod( 'lsvr_event_single_map_type', 'roadmap' ) ); ?>"
					data-zoom="<?php echo esc_attr( get_theme_mod( 'lsvr_event_single_map_zoom', 17 ) ); ?>"
					data-mousewheel="false"></div>
				</div>
				<!-- GOOGLE MAP : end -->

			<?php }

		}
	}
}


// Event upcoming occurrences
if ( ! function_exists( 'lsvr_pressville_the_event_upcoming_occurrences' ) ) {
	function lsvr_pressville_the_event_upcoming_occurrences( $post_id ) {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		if ( lsvr_pressville_is_recurring_event( $post_id ) ) {
			$next_occurrences = lsvr_pressville_get_next_event_occurrences( $post_id, apply_filters( 'lsvr_pressville_event_detail_upcoming_occurrences_count', 30 ) );
			if ( ! empty( $next_occurrences ) ) { ?>

				<div class="post__dates-list-wrapper post__dates-list-wrapper--<?php echo esc_attr( count( $next_occurrences ) ); ?>-items">
					<ul class="post__dates-list">
						<?php foreach ( $next_occurrences as $occurrence ) : if ( ! empty( $occurrence['start'] ) ) : ?>
							<li class="post__dates-item">
								<?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $occurrence['start'] ) ) ); ?>
							</li>
						<?php endif; endforeach; ?>
					</ul>
				</div>

			<?php }

		}

	}
}

// Event recurring pattern
if ( ! function_exists( 'lsvr_pressville_the_event_recurrence_pattern' ) ) {
	function lsvr_pressville_the_event_recurrence_pattern( $post_id , $template = '%s' ) {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		if ( lsvr_pressville_is_recurring_event( $post_id ) ) {

			$pattern = get_post_meta( $post_id, 'lsvr_event_repeat', true );
			$pattern_xth = get_post_meta( $post_id, 'lsvr_event_repeat_xth', true );

			if ( 'day' === $pattern ) {

				$pattern_day = get_post_meta( $post_id, 'lsvr_event_repeat_day', true );

				if ( empty( $pattern_day ) ) {
					$pattern = esc_html__( 'day', 'pressville' );
				}
				else {
					$days = explode( ',', $pattern_day );
					$pattern = implode( ', ', array_map( 'lsvr_pressville_get_day_name', $days ) );
				}

			}
			else if ( 'first' === $pattern || 'second' === $pattern || 'third' === $pattern || 'fourth' === $pattern || 'last' === $pattern ) {
				$pattern_labels = array(
					'first' => esc_html__( '1st', 'pressville' ),
					'second' => esc_html__( '2nd', 'pressville' ),
					'third' => esc_html__( '3rd', 'pressville' ),
					'fourth' => esc_html__( '4th', 'pressville' ),
					'last' => esc_html__( 'last', 'pressville' ),
				);
				$pattern_label = ! empty( $pattern_labels[ $pattern ] ) ? $pattern_labels[ $pattern ] : $pattern;
				$pattern = sprintf( esc_html__( '%s %s', 'pressville' ), $pattern_label, lsvr_pressville_get_day_name( $pattern_xth ) );
			}
			else if ( 'weekday' === $pattern ) {
				$pattern = esc_html__( 'weekday', 'pressville' );
			}
			else if ( 'week' === $pattern ) {
				$pattern = esc_html__( 'week', 'pressville' );
			}
			else if ( 'biweek' === $pattern ) {
				$pattern = esc_html__( 'two weeks', 'pressville' );
			}
			else if ( 'month' === $pattern ) {
				$pattern = esc_html__( 'month', 'pressville' );
			}
			else if ( 'bimonth' === $pattern ) {
				$pattern = esc_html__( 'two months', 'pressville' );
			}
			else if ( 'year' === $pattern ) {
				$pattern = esc_html__( 'year', 'pressville' );
			}

			echo sprintf( $template, $pattern );

		}

	}
}

?>