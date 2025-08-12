<?php

/**
 * GENERAL
 */

	// Document title
	add_filter( 'document_title_parts', 'lsvr_pressville_bbpress_title' );
	if ( ! function_exists( 'lsvr_pressville_bbpress_title' ) ) {
		function lsvr_pressville_bbpress_title( $title ) {

			if ( is_post_type_archive( 'forum' ) ) {
				$title['title'] = sanitize_text_field( lsvr_pressville_get_bbpress_archive_title() );
			}
			return $title;

		}
	}

	// Include bbPress topic CPT in search results
	add_filter( 'bbp_register_topic_post_type', 'lsvr_pressville_bbpress_topic_search_enable' );
	if ( ! function_exists( 'lsvr_pressville_bbpress_topic_search_enable' ) ) {
		function lsvr_pressville_bbpress_topic_search_enable( $topic_search ) {

			$topic_search['exclude_from_search'] = false;
			return $topic_search;

		}
	}

	// Include bbPress forum CPT in search results
	add_filter( 'bbp_register_forum_post_type', 'lsvr_pressville_bbpress_forum_search_enable' );
	if ( ! function_exists( 'lsvr_pressville_bbpress_forum_search_enable' ) ) {
		function lsvr_pressville_bbpress_forum_search_enable( $forum_search ) {

			$forum_search['exclude_from_search'] = false;
			return $forum_search;

		}
	}


/**
 * CORE
 */

	// Add bbpress to search filter
	add_filter( 'lsvr_pressville_header_search_filter', 'lsvr_pressville_bbpress_header_search_filter' );
	if ( ! function_exists( 'lsvr_pressville_bbpress_header_search_filter' ) ) {
		function lsvr_pressville_bbpress_header_search_filter( $filter ) {

			if ( post_type_exists( 'forum' ) && post_type_exists( 'topic' ) ) {
				$filter = array_merge( $filter, array(
					array(
						'name' => 'forum',
						'label' => esc_html__( 'forums', 'pressville' ),
					),
					array(
						'name' => 'topic',
						'label' => esc_html__( 'topics', 'pressville' ),
					),
				));
			}

			return $filter;

		}
	}

	// Breadcrumbs
	add_filter( 'lsvr_pressville_add_to_breadcrumbs', 'lsvr_pressville_bbpress_breadcrumbs' );
	if ( ! function_exists( 'lsvr_pressville_bbpress_breadcrumbs' ) ) {
		function lsvr_pressville_bbpress_breadcrumbs( $breadcrumbs ) {

			if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {

				// Root
				if ( ! is_post_type_archive( 'forum' ) ) {
					$breadcrumbs = array(
						array(
							'url' => get_post_type_archive_link( bbp_get_forum_post_type() ),
							'label' => lsvr_pressville_get_bbpress_archive_title(),
						),
					);
				}

				// Get ancestors
				if ( is_singular() || bbp_is_forum_edit() || bbp_is_topic_edit() || bbp_is_reply_edit() ) {
					$ancestors = array_reverse( (array) get_post_ancestors( get_the_ID() ) );
				}

				// Parse ancestors
				if ( ! empty( $ancestors ) ) {

					// Loop through parents
					foreach ( (array) $ancestors as $parent_id ) {

						// Parents
						$parent = get_post( $parent_id );

						// Skip parent if empty or error
						if ( empty( $parent ) || is_wp_error( $parent ) )
							continue;

						// Switch through post_type to ensure correct filters are applied
						switch ( $parent->post_type ) {

							// Forum
							case bbp_get_forum_post_type() :
								$breadcrumbs[] = array(
									'url' => bbp_get_forum_permalink( $parent->ID ),
									'label' => bbp_get_forum_title( $parent->ID ),
								);
								break;

							// Topic
							case bbp_get_topic_post_type() :
								$breadcrumbs[] = array(
									'url' => bbp_get_topic_permalink( $parent->ID ),
									'label' => bbp_get_topic_title( $parent->ID ),
								);
								break;

							// Reply
							case bbp_get_reply_post_type() :
								$breadcrumbs[] = array(
									'url' => bbp_get_reply_permalink( $parent->ID ),
									'label' => bbp_get_reply_title( $parent->ID ),
								);
								break;

							// WordPress Post/Page/Other
							default :
								$breadcrumbs[] = array(
									'url' => get_permalink( $parent->ID ),
									'label' => get_the_title( $parent->ID ),
								);
								break;
						}

					}

				}

			}

			return $breadcrumbs;

		}
	}

	// Sidebar position
	add_filter( 'lsvr_pressville_sidebar_position', 'lsvr_pressville_bbpress_sidebar_position' );
	if ( ! function_exists( 'lsvr_pressville_bbpress_sidebar_position' ) ) {
		function lsvr_pressville_bbpress_sidebar_position( $sidebar_position ) {

			if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
				$sidebar_position = get_theme_mod( 'lsvr_bbpress_sidebar_position', 'disable' );
			}

			return $sidebar_position;

		}
	}

	// Sidebar ID
	add_filter( 'lsvr_pressville_sidebar_id', 'lsvr_pressville_bbpress_sidebar_id' );
	if ( ! function_exists( 'lsvr_pressville_bbpress_sidebar_id' ) ) {
		function lsvr_pressville_bbpress_sidebar_id( $sidebar_id ) {

			if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
				$sidebar_id = get_theme_mod( 'lsvr_bbpress_sidebar_id' );
			}

			return $sidebar_id;

		}
	}

?>