<?php

// Get document archive layout
if ( ! function_exists( 'lsvr_pressville_get_document_archive_layout' ) ) {
	function lsvr_pressville_get_document_archive_layout() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$path_prefix = 'template-parts/lsvr_document/archive-layout-';

		// Get layout from Customizer
		if ( ! empty( locate_template( $path_prefix . get_theme_mod( 'lsvr_document_archive_layout', 'default' ) . '.php' ) ) ) {
			return get_theme_mod( 'lsvr_document_archive_layout', 'default' );
		}

		// Default layout
		else {
			return 'default';
		}

	}
}

// Document attachments
if ( ! function_exists( 'lsvr_pressville_the_document_attachments' ) ) {
	function lsvr_pressville_the_document_attachments( $post_id, $limit = 0 ) {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$document_attachments = lsvr_pressville_get_document_attachments( $post_id, $limit );
		if ( ! empty( $document_attachments ) ) { ?>

			<ul class="post__attachment-list">

				<?php foreach ( $document_attachments as $attachment ) : ?>

					<li class="post__attachment-item">
						<i class="post__attachment-icon lsvr_document-attachment-icon lsvr_document-attachment-icon--<?php echo esc_attr( $attachment['filetype'] ); ?>"></i>
						<a href="<?php echo esc_url( $attachment['url'] ); ?>"
							target="_blank"
							class="post__attachment-link">
							<?php if ( true === get_theme_mod( 'lsvr_document_enable_attachment_titles', false ) && ! empty( $attachment['title'] ) ) {
								echo esc_html( $attachment['title'] );
							} else {
								echo esc_html( $attachment['filename'] );
							} ?>
						</a>
						<?php if ( ! empty( $attachment['filesize'] ) ) : ?>
							<span class="post__attachment-filesize"><?php echo esc_html( $attachment['filesize'] ); ?></span>
						<?php endif; ?>
						<?php if ( true === $attachment['external'] ) : ?>
							<span class="post__attachment-label"><?php esc_html_e( 'External', 'pressville' ); ?></span>
						<?php endif; ?>
					</li>

				<?php endforeach; ?>

			</ul>

		<?php }

	}
}


// Display document attachments tree
if ( ! function_exists( 'lsvr_pressville_the_document_categorized_attachments' ) ) {
	function lsvr_pressville_the_document_categorized_attachments() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

    	// Query args
    	$query_args = [
        	'taxonomy' => 'lsvr_document_cat',
        	'title_li' => '',
        	'show_option_none' => false,
        	'orderby' => 'name',
        	'order' => 'ASC',
        	'walker' => new Lsvr_Pressville_Document_Categorized_Attachments_Walker,
    	];

        // Main archive
        if ( is_post_type_archive( 'lsvr_document' ) ) {

        	// Get exluded categories
        	$excluded_categories = [];
        	if ( lsvr_pressville_is_document() && ! is_tax( 'lsvr_document_category' ) ) {
        		$excluded_categories_data = get_theme_mod( 'lsvr_document_excluded_categories', '' );
        		if ( ! empty( $excluded_categories_data ) ) {
        			$excluded_categories_arr = array_map( 'trim', explode( ',', $excluded_categories_data ) );
        			foreach ( $excluded_categories_arr as $excluded ) {
        				if ( is_numeric( $excluded ) ) {
        					array_push( $excluded_categories, (int) $excluded );
        				} else {
							$term = get_term_by( 'slug', $excluded, 'lsvr_document_cat' );
							if ( ! empty( $term->term_id ) ) {
								array_push( $excluded_categories, $term->term_id );
							}
        				}
        			}
        		}
        	}

        	// Exclude categories
        	if ( ! empty( $excluded_categories ) ) {
        		$query_args['exclude'] = $excluded_categories;
        	}

		}

    	// Category archive
    	else if ( is_tax( 'lsvr_document_cat' ) ) {
			$query_args['child_of'] = get_queried_object_id();
    	}

    	// Get current category attachments
    	$root_attachments = lsvr_pressville_get_document_archive_attachments(); ?>

		<!-- POST ARCHIVE TREE : begin -->
		<div class="post-tree">
			<ul class="post-tree__children post-tree__children--level-1">

		        <?php // Categories
		        wp_list_categories( $query_args ); ?>

	        	<?php // Current category attachments
	        	if ( ! empty( $root_attachments ) ) : ?>
	        		<?php foreach ( $root_attachments as $attachment ) : ?>

						<li class="post-tree__file post-tree__file--level-1">
							<i class="post-tree__file-icon lsvr_document-attachment-icon lsvr_document-attachment-icon--<?php echo esc_attr( $attachment['filetype'] ); ?>"></i>
							<a href="<?php echo esc_url( $attachment['url'] ); ?>"
								target="_blank"
								class="post-tree__file-link">
								<?php if ( true === get_theme_mod( 'lsvr_document_enable_attachment_titles', false ) && ! empty( $attachment['title'] ) ) {
									echo esc_html( $attachment['title'] );
								} else {
									echo esc_html( $attachment['filename'] );
								} ?>
							</a>
							<?php if ( ! empty( $attachment['filesize'] ) ) : ?>
								<span class="post-tree__file-size"><?php echo esc_html( $attachment['filesize'] ); ?></span>
							<?php endif; ?>
							<?php if ( true === $attachment['external'] ) : ?>
								<span class="post-tree__file-label"><?php esc_html_e( 'External', 'pressville' ); ?></span>
							<?php endif; ?>
						</li>

	        		<?php endforeach; ?>
	        	<?php endif; ?>

	        </ul>
        </div>
        <!-- POST ARCHIVE TREE : end -->

	<?php }
}


?>