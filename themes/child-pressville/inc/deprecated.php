<?php

// Post archive categories
if ( ! function_exists( 'lsvr_pressville_the_post_archive_categories' ) ) {
	function lsvr_pressville_the_post_archive_categories( $post_type, $taxonomy ) {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$terms = get_terms( $taxonomy );
		if ( ! empty( $terms ) ) { ?>

			<!-- POST ARCHIVE CATEGORIES : begin -->
			<div class="post-archive-categories">
				<h6 class="screen-reader-text"><?php esc_html_e( 'Categories:', 'pressville' ); ?></h6>
				<ul class="post-archive-categories__list">

					<li class="post-archive-categories__item">
						<?php if ( is_tax( $taxonomy ) ) : ?>
							<a href="<?php echo esc_url( get_post_type_archive_link( $post_type ) ); ?>" class="post-archive-categories__item-link"><?php esc_html_e( 'All', 'pressville' ); ?></a>
						<?php else : ?>
							<strong><?php esc_html_e( 'All', 'pressville' ); ?></strong>
						<?php endif; ?>
					</li>

					<?php foreach ( $terms as $term ) : ?>
						<li class="post-archive-categories__item">
							<?php if ( get_queried_object_id() === $term->term_id ) : ?>
								<?php echo esc_html( $term->name ); ?>
							<?php else : ?>
								<a href="<?php echo esc_url( get_term_link( $term->term_id, $taxonomy ) ); ?>" class="post-archive-categories__item-link"><?php echo esc_html( $term->name ); ?></a>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>

				</ul>
			</div>
			<!-- POST ARCHIVE CATEGORIES : end -->

		<?php }

	}
}

// Get blog archive layout
if ( ! function_exists( 'lsvr_pressville_get_blog_archive_layout' ) ) {
	function lsvr_pressville_get_blog_archive_layout() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$path_prefix = 'template-parts/blog/archive-layout-';

		// Get layout from Customizer
		if ( ! empty( locate_template( $path_prefix . get_theme_mod( 'blog_archive_layout', 'default' ) . '.php' ) ) ) {
			return get_theme_mod( 'blog_archive_layout', 'default' );
		}

		// Default layout
		else {
			return 'default';
		}

	}
}

// Has narrow content
if ( ! function_exists( 'lsvr_pressville_has_narrow_content' ) ) {
	function lsvr_pressville_has_narrow_content() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		if ( ! is_active_sidebar( apply_filters( 'lsvr_pressville_sidebar_id', 'lsvr-pressville-default-sidebar' ) ) && (
			is_singular( 'post' )
			|| ( ( is_category() || is_home() ) && 'default' === get_theme_mod( 'blog_archive_layout', 'default' ) )
			|| is_singular( 'lsvr_listing' )
			|| is_singular( 'lsvr_event' )
				|| ( ( is_post_type_archive( 'lsvr_event' )
					|| is_tax( 'lsvr_event_cat' )
					|| is_tax( 'lsvr_event_location' ) ||
					is_tax( 'lsvr_event_tag' ) )
				&& 'timeline' === get_theme_mod( 'lsvr_event_archive_layout', 'default' ) )
			|| is_singular( 'lsvr_person' )
			|| is_singular( 'lsvr_document' ) || is_post_type_archive( 'lsvr_document' )
			)) {

			return true;

		} else {

			return false;

		}

	}
}

// Has page sidebar
if ( ! function_exists( 'lsvr_pressville_has_page_sidebar' ) ) {
	function lsvr_pressville_has_page_sidebar() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$sidebar_position = lsvr_pressville_get_page_sidebar_position();
		return $sidebar_position !== 'disable' ? true : false;

	}
}

// Get page sidebar position
if ( ! function_exists( 'lsvr_pressville_get_page_sidebar_position' ) ) {
	function lsvr_pressville_get_page_sidebar_position() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		// Is blog single
		if ( is_singular( 'post' ) ) {
			return get_theme_mod( 'blog_single_sidebar_position', 'right' );
		}

		// Is blog archive
		else if ( lsvr_pressville_is_blog() ) {
			return get_theme_mod( 'blog_archive_sidebar_position', 'right' );
		}

		// Filter for other CPT
		else if ( ! empty( apply_filters( 'lsvr_pressville_sidebar_position', 'disable' ) ) ) {
			return apply_filters( 'lsvr_pressville_sidebar_position', 'disable' );
		}

		// Default
		else {
			return 'disable';
		}

	}
}

// Get page sidebar ID
if ( ! function_exists( 'lsvr_pressville_get_page_sidebar_id' ) ) {
	function lsvr_pressville_get_page_sidebar_id( $page_id = false ) {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		// Page
		if ( is_page() ) {
			$page_id = ! empty( $page_id ) ? $page_id : get_the_ID();
			$sidebar_id = ! empty( $page_id ) ? get_post_meta( $page_id, 'lsvr_pressville_page_sidebar', true ) : false;

			if ( ! empty( $sidebar_id ) ) {
				$sidebar_id = $sidebar_id;
			} else {
				$sidebar_id = 'lsvr-pressville-default-sidebar';
			}
		}

		// Is blog single
		else if ( is_singular( 'post' ) ) {
			$sidebar_id = get_theme_mod( 'blog_single_sidebar_id' );
		}

		// Is blog archive
		else if ( lsvr_pressville_is_blog() ) {
			$sidebar_id = get_theme_mod( 'blog_archive_sidebar_id', 'lsvr-pressville-default-sidebar' );
		}

		// Filter
		else if ( ! empty( apply_filters( 'lsvr_pressville_sidebar_id', 'lsvr-pressville-default-sidebar' ) ) ) {
			$sidebar_id = apply_filters( 'lsvr_pressville_sidebar_id', 'lsvr-pressville-default-sidebar' );
		}

		// Default
		else {
			$sidebar_id = 'lsvr-pressville-default-sidebar';
		}

		$sidebar_id = ! empty( $sidebar_id ) ? $sidebar_id : 'lsvr-pressville-default-sidebar';

		return $sidebar_id;

	}
}

// Get breadcrumbs
if ( ! function_exists( 'lsvr_pressville_get_breadcrumbs' ) ) {
	function lsvr_pressville_get_breadcrumbs() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		global $wp_query, $post;
		$breadcrumbs = [];

		// Home link
		$breadcrumbs[] = array(
			'url' => esc_url( home_url( '/' ) ),
			'label' => esc_html__( 'Home', 'pressville' ),
		);

		// Blog root for blog pages
		if ( get_option( 'page_for_posts' ) ) {
			$blog_root = array(
				'url' => get_permalink( get_option( 'page_for_posts' ) ),
				'label' => get_the_title( get_option( 'page_for_posts' ) ),
			);
		}
		else {
			$blog_root = array(
				'url' => esc_url( home_url( '/' ) ),
				'label' => esc_html__( 'News', 'pressville' ),
			);
		}

		// Blog
		if ( is_tag() || is_day() || is_month() || is_year() || is_author() || is_singular( 'post' ) ) {
			array_push( $breadcrumbs, $blog_root );
		}

		// Blog category
		else if ( is_category() ) {
			$breadcrumbs[] = $blog_root;
			$current_term = $wp_query->queried_object;
			$current_term_id = $current_term->term_id;
			$parent_ids = lsvr_pressville_get_term_parents( $current_term_id, 'category' );
			if ( ! empty( $parent_ids ) ) {
				foreach( $parent_ids as $parent_id ){
					$parent = get_term( $parent_id, 'category' );
					$breadcrumbs[] = array(
						'url' => get_term_link( $parent, 'category' ),
						'label' => $parent->name,
					);
				}
			}
		}

		// Regular page
		else if ( is_page() ) {
			$parent_id = $post->post_parent;
			$parents_arr = [];
			while ( $parent_id ) {
				$page = get_page( $parent_id );
				$parents_arr[] = array(
					'url' => get_permalink( $page->ID ),
					'label' => get_the_title( $page->ID ),
				);
				$parent_id = $page->post_parent;
			}
			$parents_arr = array_reverse( $parents_arr );
			foreach ( $parents_arr as $parent ) {
				$breadcrumbs[] = $parent;
			}
		}

		// Apply filters
		if ( ! empty( apply_filters( 'lsvr_pressville_add_to_breadcrumbs', array() ) ) ) {
			$breadcrumbs = array_merge( $breadcrumbs, apply_filters( 'lsvr_pressville_add_to_breadcrumbs', array() ) );
		}

		// Taxonomy
		if ( is_tax() ) {

			$taxonomy = get_query_var( 'taxonomy' );
			$term_parents = lsvr_pressville_get_term_parents( get_queried_object_id(), $taxonomy );
			if ( ! empty( $term_parents ) ) {
				foreach( $term_parents as $term_id ) {

					$term = get_term_by( 'id', $term_id, $taxonomy );
					$breadcrumbs[] = array(
						'url' => get_term_link( $term_id, $taxonomy ),
						'label' => $term->name,
					);

				}
			}
		}

		// Return breadcrumbs
		return $breadcrumbs;

	}
}

// Post categories
if ( ! function_exists( 'lsvr_pressville_the_post_categories' ) ) {
	function lsvr_pressville_the_post_categories( $post_id, $taxonomy, $template = '%s', $separator = ', ', $limit = 0 ) {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$terms = wp_get_post_terms( $post_id, $taxonomy );
		$terms_parsed = array();
		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				array_push( $terms_parsed, '<a href="' . esc_url( get_term_link( $term->term_id, $taxonomy ) ) . '" class="post__category-link">' . esc_html( $term->name ) . '</a>' );
			}
			if ( $limit > 0 && count( $terms_parsed ) > $limit ) {
				$terms_parsed = array_slice( $terms_parsed, 0, $limit );
			}
		}

		if ( ! empty( $terms_parsed ) ) { ?>

			<span class="post__categories">
				<?php echo sprintf( $template, implode( ', ', $terms_parsed ) ); ?>
			</span>

		<?php }

	}
}

// Post tags
if ( ! function_exists( 'lsvr_pressville_the_post_tags' ) ) {
	function lsvr_pressville_the_post_tags( $post_id, $taxonomy ) {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$terms = wp_get_post_terms( $post_id, $taxonomy );

		if ( 'post_tag' === $taxonomy && true === apply_filters( 'lsvr_pressville_the_post_tags_the_tags_enable', false ) ) {
			the_tags();
		}

		elseif ( ! empty( $terms ) ) { ?>

			<!-- POST TAGS : begin -->
			<ul class="post__tags-list">
				<?php foreach ( $terms as $term ) : ?>

					<li class="post__tag-item">
						<a href="<?php echo esc_url( get_term_link( $term->term_id, $taxonomy ) ); ?>"
							class="post__tag-item-link">
							<?php echo esc_html( $term->name ); ?>
						</a>
					</li>

				<?php endforeach; ?>
			</ul>
			<!-- POST TAGS : end -->

		<?php }

	}
}

// Tax term description
if ( ! function_exists( 'lsvr_pressville_the_tax_term_description' ) ) {
	function lsvr_pressville_the_tax_term_description() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		if ( is_tax() && lsvr_pressville_has_tax_term_description( get_queried_object_id(), get_query_var( 'taxonomy' ) ) ) : ?>

			<!-- POST ARCHIVE DESCRIPTION : begin -->
			<div class="post-archive-description">
				<?php echo wp_kses( lsvr_pressville_get_tax_term_description( get_queried_object_id(), get_query_var( 'taxonomy' ) ), array(
					'p' => array(),
				) ); ?>
			</div>
			<!-- POST ARCHIVE DESCRIPTION : end -->

		<?php endif;

	}
}

// Back to top button
if ( ! function_exists( 'lsvr_pressville_the_back_to_top_button' ) ) {
	function lsvr_pressville_the_back_to_top_button() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		if ( 'disable' !== get_theme_mod( 'back_to_top_button_enable', 'disable' ) ) {

			$class = array( 'back-to-top' );
			array_push( $class, 'back-to-top--type-' . get_theme_mod( 'back_to_top_button_enable', 'disable' ) );
			array_push( $class, 'back-to-top--threshold-' . strval( get_theme_mod( 'back_to_top_button_threshold', 100 ) ) );

			?>

			<!-- BACK TO TOP : begin -->
			<div class="<?php echo esc_attr( implode( $class, ' ' ) ); ?>"
				data-threshold="<?php echo esc_attr( get_theme_mod( 'back_to_top_button_threshold', 100 ) ); ?>">
				<a class="back-to-top__link" href="#header"><span class="back-to-top__label"><?php esc_html_e( 'Back to top', 'pressville' ); ?></span></a>
			</div>
			<!-- BACK TO TOP : end -->

		<?php }

	}
}

// Header languages mobile
if ( ! function_exists( 'lsvr_pressville_the_header_languages_mobile' ) ) {
	function lsvr_pressville_the_header_languages_mobile() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$languages = lsvr_pressville_get_languages();
		$active_language = lsvr_pressville_get_active_language();

		if ( ! empty( $languages ) ) { ?>

			<!-- HEADER LANGUAGES MOBILE : begin -->
			<div class="header-languages-mobile">

				<div class="header-languages-mobile__inner">
					<span class="screen-reader-text"><?php esc_html_e( 'Choose language:', 'pressville' ); ?></span>
					<ul class="header-languages-mobile__list">

						<?php foreach ( $languages as $language ) : ?>
							<?php if ( ! empty( $language['label'] ) && ! empty( $language['url'] ) ) : ?>

								<li class="header-languages-mobile__item">
									<a href="<?php echo esc_url( $language['url'] ); ?>"
										class="header-languages-mobile__item-link<?php if ( ! empty( $language['active'] ) ) { echo ' header-languages-mobile__item-link--active'; } ?>"><?php echo esc_html( $language['label'] ); ?></a>
								</li>

							<?php endif; ?>
						<?php endforeach; ?>

					</ul>
				</div>

				<?php if ( ! empty( $active_language['label'] ) ) : ?>
					<button type="button" class="header-languages-mobile__toggle"><?php echo esc_html( $active_language['label'] ); ?></button>
				<?php endif; ?>

			</div>
			<!-- HEADER LANGUAGES MOBILE : end -->

		<?php }

	}
}

// Header mobile menu toggle
if ( ! function_exists( 'lsvr_pressville_the_header_mobile_toggle' ) ) {
	function lsvr_pressville_the_header_mobile_toggle() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		?>

		<button type="button" class="header-mobile-toggle">
			<?php esc_html_e( 'Menu', 'pressville' ); ?>
			<i class="header-mobile-toggle__icon"></i>
		</button>

		<?php

	}
}

// Header background
if ( ! function_exists( 'lsvr_pressville_the_header_titlebar_background' ) ) {
	function lsvr_pressville_the_header_titlebar_background() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$images = array();

		// Get background type
		$background_type = get_theme_mod( 'header_background_type', 'single' );

		// Get align
		$titlebar_background_class_arr = array( 'header-titlebar__background' );
		array_push( $titlebar_background_class_arr, 'header-titlebar__background--align-' . get_theme_mod( 'header_background_vertical_align', 'top' ) );
		array_push( $titlebar_background_class_arr, 'header-titlebar__background--' . get_theme_mod( 'header_background_type', 'single' ) );
			if ( ( is_front_page() && true === get_theme_mod( 'header_background_animated_enable', false ) ) ||
				( ! empty( $_GET['lsvr-animated-header'] ) && 'true' === $_GET['lsvr-animated-header'] ) ) {
				array_push( $titlebar_background_class_arr, 'header-titlebar__background--animated' );
			}

			// If is page and has featured image, use it instead of image defined via Customizer
			if ( is_page() && has_post_thumbnail( get_the_ID() ) ) {
			array_push( $images, get_the_post_thumbnail_url( get_the_ID() ) );
			}

			// Get image from Customizer
			else {

			// Get default image
			$default_image_url = get_theme_mod( 'header_background_image', '' );
			if ( ! empty( $default_image_url )  ) {
				array_push( $images, $default_image_url );
			}

			// Get additional images
			if ( 'slideshow' === $background_type || 'random' === $background_type ||
				( 'slideshow-home' === $background_type && is_front_page() ) ) {

				for ( $i = 2; $i <= 5; $i++ ) {

					$image_url = get_theme_mod( 'header_background_image_' . $i, '' );
					if ( ! empty( $image_url )  ) {
						array_push( $images, $image_url );
					}

				}

			}

		}

		// Create background element
		if ( ! empty( $images ) ) { ?>

			<div class="<?php echo implode( ' ', $titlebar_background_class_arr ); ?>"
				data-slideshow-speed="<?php echo esc_attr( get_theme_mod( 'header_background_slideshow_speed', 10 ) ); ?>">

				<?php // Pick random image
				if ( 'random' === $background_type ) : $random_index = rand( 0, count( $images ) - 1 ); ?>

					<div class="header-titlebar__background-image header-titlebar__background-image--default"
						style="background-image: url( '<?php echo ! empty( $images[ $random_index ] ) ? esc_url( $images[ $random_index ] ) : esc_url( reset( $images ) ); ?>' );"></div>

				<?php // List all images
				else : ?>

					<?php foreach ( $images as $image_url ) : ?>

						<div class="header-titlebar__background-image<?php if ( $image_url === reset( $images ) ) { echo ' header-titlebar__background-image--default'; } ?>"
							style="background-image: url('<?php echo esc_url( $image_url ); ?>'); "></div>

					<?php endforeach; ?>

				<?php endif; ?>

			</div>

		<?php }

	}
}

// Header titlebar overlay
if ( ! function_exists( 'lsvr_pressville_the_header_titlebar_overlay' ) ) {
	function lsvr_pressville_the_header_titlebar_overlay() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$overlay_opacity = (int) get_theme_mod( 'header_background_overlay_opacity', 80 ) / 100;
		$opacity_css = 'opacity: ' . $overlay_opacity . ';'; // For modern browsers
		$opacity_filter_css = 'filter: alpha(opacity=' . $overlay_opacity . ');'; // For IE
		echo '<span class="header-titlebar__overlay" style="' . esc_attr( $opacity_css . $opacity_filter_css ) . '"></span>';

	}
}

// Header languages
if ( ! function_exists( 'lsvr_pressville_the_header_languages' ) ) {
	function lsvr_pressville_the_header_languages() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$languages = lsvr_pressville_get_languages();

		if ( ! empty( $languages ) ) { ?>

			<!-- HEADER LANGUAGES : begin -->
			<div class="header-languages">
				<span class="screen-reader-text"><?php esc_html_e( 'Choose language:', 'pressville' ); ?></span>
				<ul class="header-languages__list">

					<?php foreach ( $languages as $language ) : ?>
						<?php if ( ! empty( $language['label'] ) && ! empty( $language['url'] ) ) : ?>

							<li class="header-languages__item<?php if ( ! empty( $language['active'] ) ) { echo ' header-languages__item--active'; } ?>">
								<a href="<?php echo esc_url( $language['url'] ); ?>" class="header-languages__item-link"><?php echo esc_html( $language['label'] ); ?></a>
							</li>

						<?php endif; ?>
					<?php endforeach; ?>

				</ul>
			</div>
			<!-- HEADER LANGUAGES : end -->

		<?php }

	}
}

// Header search
if ( ! function_exists( 'lsvr_pressville_the_header_search' ) ) {
	function lsvr_pressville_the_header_search() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		if ( true === get_theme_mod( 'header_search_enable', true ) ) { ?>

			<!-- HEADER SEARCH WRAPPER : begin -->
			<div class="header-search__wrapper">

				<!-- HEADER SEARCH TOGGLE : begin -->
				<button type="button" class="header-search__toggle">
					<i class="header-search__toggle-icon"></i>
				</button>
				<!-- HEADER SEARCH TOGGLE : end -->

				<!-- HEADER SEARCH : begin -->
				<div class="header-search<?php if ( true === get_theme_mod( 'header_search_ajax_enable', true ) ) { echo ' header-search--ajaxed'; } ?>">
					<div class="header-search__inner">

						<!-- SEARCH FORM : begin -->
						<form class="header-search__form"
							action="<?php echo esc_url( home_url( '/' ) ); ?>"
							method="get">

							<!-- SEARCH OPTIONS : begin -->
							<div class="header-search__options">

								<label for="header-search-input" class="header-search__input-label"><?php esc_html_e( 'Search:', 'pressville' ); ?></label>

								<!-- INPUT WRAPPER : begin -->
								<div class="header-search__input-wrapper">

									<input class="header-search__input" type="text" name="s" autocomplete="off"
										id="header-search-input"
										placeholder="<?php echo get_theme_mod( 'header_search_input_placeholder', esc_html__( 'Search this site', 'pressville' ) ); ?>"
										value="<?php echo esc_attr( get_search_query() ); ?>">
									<button class="header-search__submit" type="submit" title="<?php esc_html_e( 'Search', 'pressville' ); ?>">
										<i class="header-search__submit-icon"></i>
									</button>
									<div class="c-spinner header-search__spinner"></div>

								</div>
								<!-- INPUT WRAPPER : end -->

								<?php if ( true === get_theme_mod( 'header_search_filter_enable', true ) ) : ?>

									<?php // Default filters
									$filters = array(
										array(
											'name' => 'post',
											'label' => esc_html__( 'posts', 'pressville' ),
										),
										array(
											'name' => 'page',
											'label' => esc_html__( 'pages', 'pressville' ),
										),
									);

									// bbPress filters
									if ( class_exists( 'bbPress' ) && post_type_exists( 'forum' ) && post_type_exists( 'topic' ) ) {
										array_push( $filters, array(
											'name' => 'forum',
											'label' => esc_html__( 'forums', 'pressville' ),
										));
										array_push( $filters, array(
											'name' => 'topic',
											'label' => esc_html__( 'topics', 'pressville' ),
										));
									}

									// Custom filters
									$custom_filters = (array) apply_filters( 'lsvr_pressville_add_header_search_filter', array() );
									$filters = array_merge( $filters, $custom_filters );

									// Active filters
									if ( isset( $_GET['lsvr-search-filter'] ) ) {
										$active_filters = (array) $_GET['lsvr-search-filter'];
									} elseif ( isset( $_GET['lsvr-search-filter-serialized'] ) ) {
										$active_filters = explode( ',', esc_attr( $_GET['lsvr-search-filter-serialized'] ) );
									} else {
										$active_filters = array();
									}

									?>

									<?php if ( ! empty( $filters ) ) : ?>

										<!-- SEARCH FILTER : begin -->
										<div class="header-search__filter">

											<h5 class="header-search__filter-title"><?php esc_html_e( 'Filter results:', 'pressville' ); ?></h5>

											<label for="header-search-filter-type-any" class="header-search__filter-label">
												<input type="checkbox" class="header-search__filter-checkbox"
													id="header-search-filter-type-any"
													name="lsvr-search-filter[]" value="any"
													<?php if ( empty( $active_filters ) || in_array( 'any', $active_filters ) ) { echo ' checked="checked"'; } ?>>
													<?php esc_html_e( 'everything', 'pressville' ); ?>
											</label>

											<?php foreach ( $filters as $filter ) : if ( ! empty( $filter['name'] ) && ! empty( $filter['label'] ) ) : ?>

												<label for="header-search-filter-type-<?php echo esc_attr( $filter['name'] ); ?>" class="header-search__filter-label">
													<input type="checkbox" class="header-search__filter-checkbox"
														id="header-search-filter-type-<?php echo esc_attr( $filter['name'] ); ?>"
														name="lsvr-search-filter[]" value="<?php echo esc_attr( $filter['name'] ); ?>"
														<?php if ( in_array( $filter['name'], $active_filters ) ) { echo ' checked="checked"'; } ?>>
														<?php echo esc_html( $filter['label'] ); ?>
												</label>

											<?php endif; endforeach; ?>


										</div>
										<!-- SEARCH FILTER : end -->

									<?php endif; ?>

								<?php endif; ?>

							</div>
							<!-- SEARCH OPTIONS : end -->

						</form>
						<!-- SEARCH FORM : end -->

						<span class="header-search__arrow"></span>

					</div>
				</div>
				<!-- HEADER SEARCH : end -->

			</div>
			<!-- HEADER SEARCH WRAPPER : end -->

		<?php }

	}
}

?>