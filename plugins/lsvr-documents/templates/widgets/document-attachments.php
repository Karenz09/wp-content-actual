<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content">

	<?php if ( ! empty( $document_posts ) ) : ?>

		<ul class="lsvr_document-attachments-widget__list">
    		<?php $i = 0; foreach ( $document_posts as $document_post ) : ?>

    			<?php $document_attachments = lsvr_documents_get_document_attachments( $document_post->ID ); ?>
    			<?php if ( ! empty( $document_attachments ) ) : ?>

    				<?php foreach ( $document_attachments as $attachment ) : ?>

    					<li class="lsvr_document-attachments-widget__item">

    						<span class="lsvr_document-attachments-widget__item-icon lsvr_document-attachment-icon lsvr_document-attachment-icon--<?php echo esc_attr( $attachment['extension'] ); ?><?php if ( ! empty( $attachment['filetype'] ) ) { echo ' lsvr_document-attachment-icon--' . esc_attr( $attachment['filetype'] ); } ?>"
    							aria-hidden="true"></span>

							<a href="<?php echo esc_url( $attachment['url'] ); ?>"
								target="_blank"
								class="lsvr_document-attachments-widget__item-link">
								<?php if ( true === $show_attachment_titles && ! empty( $attachment['title'] ) ) {
									echo esc_html( $attachment['title'] );
								} else {
									echo esc_html( $attachment['filename'] );
								} ?>
							</a>

							<?php if ( true === $show_attachment_titles && ! empty( $attachment['title'] ) ) : ?>

								<span class="screen-reader-text lsvr_document-attachments-widget__item-extension-wrapper" role="group">
									<span class="lsvr_document-attachments-widget__item-extension screen-reader-text"><?php esc_html_e( 'File extension:', 'lsvr-documents' ); ?> <?php echo esc_html( $attachment['extension'] ); ?></span>
								</span>

							<?php endif; ?>

							<?php if ( ! empty( $attachment['filesize'] ) ) : ?>

								<span class="lsvr_document-attachments-widget__item-filesize-wrapper" role="group">
									<span class="screen-reader-text"><?php esc_html_e( 'File size:', 'lsvr-documents' ); ?></span>
									<span class="lsvr_document-attachments-widget__item-filesize"><?php echo esc_html( $attachment['filesize'] ); ?></span>
								</span>

							<?php endif; ?>

							<?php if ( true === $attachment['external'] ) : ?>

								<span class="lsvr_document-attachments-widget__item-label"><?php esc_html_e( 'External', 'lsvr-documents' ); ?></span>

							<?php endif; ?>

    					</li>

    					<?php $i++; if ( (int) $limit > 0 && $i >= $limit ) { break 2; } ?>

    				<?php endforeach; ?>

    			<?php endif; ?>

    		<?php endforeach; ?>
		</ul>

		<?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>

			<p class="widget__more">

				<?php if ( ! empty( $instance['category'] ) && is_numeric( $instance['category'] ) ) : ?>

				<a href="<?php echo esc_url( get_term_link( (int) $instance['category'], 'lsvr_document_cat' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

				<?php else : ?>

					<a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_document' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

				<?php endif; ?>

			</p>

		<?php endif; ?>

	<?php else : ?>

		<p class="widget__no-results"><?php esc_html_e( 'There are no documents', 'lsvr-documents' ); ?></p>

	<?php endif; ?>

</div>

<?php // TEMPLATE : END
endif; ?>