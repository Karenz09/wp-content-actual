<!-- POST ARCHIVE TREE : begin -->
<div class="post-tree"
	data-label-expand-submenu="<?php echo esc_attr( esc_html__( 'Expand list', 'pressville' ) ); ?>"
	data-label-collapse-submenu="<?php echo esc_attr( esc_html__( 'Collapse list', 'pressville' ) ); ?>">
	<ul class="post-tree__children post-tree__children--level-1">

        <?php // Categories
        wp_list_categories( lsvr_pressville_get_document_categorized_attachments_query_args() ); ?>

    	<?php // Current category attachments
    	foreach ( lsvr_pressville_get_document_archive_attachments() as $attachment ) : ?>

			<li class="post-tree__item post-tree__item--file post-tree__item--level-1">

				<div class="post-tree__item-link-holder post-tree__item-link-holder--file post-tree__item-link-holder--level-1">

					<span class="post-tree__item-icon lsvr_document-attachment-icon lsvr_document-attachment-icon--<?php echo esc_attr( $attachment['extension'] ); ?>"
						aria-hidden="true"></span>
					<a href="<?php echo esc_url( $attachment['url'] ); ?>"
						target="_blank"
						class="post-tree__item-link post-tree__item-link--file post-tree__item-link--level-1">
						<?php if ( true === get_theme_mod( 'lsvr_document_enable_attachment_titles', false ) && ! empty( $attachment['title'] ) ) {
							echo esc_html( $attachment['title'] );
						} else {
							echo esc_html( $attachment['filename'] );
						} ?>
					</a>

					<?php if ( true === get_theme_mod( 'lsvr_document_enable_attachment_titles', false ) && ! empty( $attachment['title'] ) ) : ?>

						<span class="screen-reader-text post-tree__item--extension-wrapper" role="group">
							<span class="post-tree__item--extension screen-reader-text"><?php esc_html_e( 'File extension:', 'pressville' ); ?> <?php echo esc_html( $attachment['extension'] ); ?></span>
						</span>

					<?php endif; ?>

					<?php if ( ! empty( $attachment['filesize'] ) ) : ?>

						<span class="post-tree__item-size-wrapper" role="group">
							<span class="screen-reader-text"><?php esc_html_e( 'File size:', 'pressville' ); ?></span>
							<span class="post-tree__item-size"><?php echo esc_html( $attachment['filesize'] ); ?></span>
						</span>

					<?php endif; ?>

					<?php if ( true === $attachment['external'] ) : ?>

						<span class="post-tree__item-label"><?php esc_html_e( 'External', 'pressville' ); ?></span>

					<?php endif; ?>

				</div>

			</li>

		<?php endforeach; ?>

    </ul>
</div>
<!-- POST ARCHIVE TREE : end -->