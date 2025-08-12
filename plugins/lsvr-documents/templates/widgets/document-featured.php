<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content lsvr_document-featured-widget__content">

	<?php if ( ! empty( $document_post ) ) : ?>

		<h4 class="lsvr_document-featured-widget__title">
			<a href="<?php echo esc_url( get_permalink( $document_post->ID ) ); ?>" class="lsvr_document-featured-widget__title-link">
				<?php echo get_the_title( $document_post->ID ); ?>
			</a>
		</h4>

		<?php // Date
		if ( true === $show_date ) : ?>

			<p class="lsvr_document-featured-widget__date">
				<?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $document_post->post_date ) ) ); ?>
			</p>

		<?php endif; ?>

        <?php // Category
        if ( true === $show_category && lsvr_documents_has_post_terms( $document_post->ID, 'lsvr_document_cat' ) ) : ?>

            <p class="lsvr_document-featured-widget__category">
                <?php echo sprintf( esc_html__( 'in %s', 'lsvr-documents' ), lsvr_documents_get_post_taxonomy_html( $document_post->ID, 'lsvr_document_cat', '<a href="%s" class="lsvr_document-featured-widget__category-link">%s</a>' ) ); ?>
            </p>

        <?php endif; ?>

		<?php // Excerpt
		if ( true === $show_excerpt && has_excerpt( $document_post->ID ) ) : ?>

			<div class="lsvr_document-featured-widget__excerpt">
				<?php echo wpautop( get_the_excerpt( $document_post->ID ) ); ?>
			</div>

		<?php endif; ?>

		<?php // Attachments
		if ( true === $show_attachments && ! post_password_required( $document_post->ID ) ) : ?>

			<?php $attachments = lsvr_documents_get_document_attachments( $document_post->ID ); ?>
			<?php if ( ! empty( $attachments ) ) : ?>

				<ul class="lsvr_document-featured-widget__attachments" title="<?php echo esc_attr( esc_html__( 'Attachments', 'lsvr-documents' ) ); ?>">

					<?php foreach ( $attachments as $attachment ) : ?>

						<li class="lsvr_document-featured-widget__attachment">

    						<span class="lsvr_document-featured-widget__attachment-icon lsvr_document-attachment-icon lsvr_document-attachment-icon--<?php echo esc_attr( $attachment['extension'] ); ?><?php if ( ! empty( $attachment['filetype'] ) ) { echo ' lsvr_document-attachment-icon--' . esc_attr( $attachment['filetype'] ); } ?>"
    							aria-hidden="true"></span>

							<a href="<?php echo esc_url( $attachment['url'] ); ?>"
								target="_blank"
								class="lsvr_document-featured-widget__attachment-link">
								<?php if ( true === $show_attachment_titles && ! empty( $attachment['title'] ) ) {
									echo esc_html( $attachment['title'] );
								} else {
									echo esc_html( $attachment['filename'] );
								} ?>
							</a>

							<?php if ( true === $show_attachment_titles && ! empty( $attachment['title'] ) ) : ?>

								<span class="screen-reader-text lsvr_document-featured-widget__attachment-extension-wrapper" role="group">
									<span class="lsvr_document-featured-widget__attachment-extension screen-reader-text"><?php esc_html_e( 'File extension:', 'lsvr-documents' ); ?> <?php echo esc_html( $attachment['extension'] ); ?></span>
								</span>

							<?php endif; ?>

							<?php if ( ! empty( $attachment['filesize'] ) ) : ?>

								<span class="lsvr_document-featured-widget__attachment-filesize-wrapper" role="group">
									<span class="screen-reader-text"><?php esc_html_e( 'File size:', 'lsvr-documents' ); ?></span>
									<span class="lsvr_document-featured-widget__attachment-filesize"><?php echo esc_html( $attachment['filesize'] ); ?></span>
								</span>

							<?php endif; ?>

							<?php if ( true === $attachment['external'] ) : ?>

								<span class="lsvr_document-featured-widget__attachment-label"><?php esc_html_e( 'External', 'lsvr-documents' ); ?></span>

							<?php endif; ?>

						</li>

					<?php endforeach; ?>

				</ul>

			<?php endif; ?>

		<?php endif; ?>

		<?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>

			<p class="widget__more">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_document' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>
			</p>

		<?php endif; ?>

	<?php else : ?>

		<p class="widget__no-results"><?php esc_html_e( 'There are no documents', 'lsvr-documents' ); ?></p>

	<?php endif; ?>

</div>

<?php // TEMPLATE : END
endif; ?>