<?php if ( ! post_password_required( get_the_ID() ) && ! empty( lsvr_pressville_get_document_attachments( get_the_ID(), get_theme_mod( 'lsvr_document_archive_attachments_per_post', 0 ) ) ) ) : ?>

	<!-- POST ATTACHMENTS : begin -->
	<div class="post__attachments">

		<?php if ( is_singular() ) : ?>

			<h3 class="post__attachments-title"><?php esc_html_e( 'Attachments', 'pressville' ); ?></h3>

		<?php else : ?>

			<h3 class="post__attachments-title screen-reader-text"><?php esc_html_e( 'Attachments', 'pressville' ); ?></h3>

		<?php endif; ?>

		<ul class="post__attachment-list">

			<?php foreach ( lsvr_pressville_get_document_attachments( get_the_ID(), get_theme_mod( 'lsvr_document_archive_attachments_per_post', 0 ) ) as $attachment ) : ?>

				<li class="post__attachment-item">

					<span class="post__attachment-icon lsvr_document-attachment-icon lsvr_document-attachment-icon--<?php echo esc_attr( $attachment['extension'] ); ?><?php if ( ! empty( $attachment['filetype'] ) ) { echo ' lsvr_document-attachment-icon--' . esc_attr( $attachment['filetype'] ); } ?>"
						aria-hidden="true"></span>

					<a href="<?php echo esc_url( $attachment['url'] ); ?>"
						target="_blank"
						class="post__attachment-link">
						<?php if ( true === get_theme_mod( 'lsvr_document_enable_attachment_titles', false ) && ! empty( $attachment['title'] ) ) : ?>
							<?php echo esc_html( $attachment['title'] ); ?>
						<?php else : ?>
							<?php echo esc_html( $attachment['filename'] ); ?>
						<?php endif; ?>
					</a>

					<?php if ( true === get_theme_mod( 'lsvr_document_enable_attachment_titles', false ) && ! empty( $attachment['title'] ) ) : ?>

						<span class="screen-reader-text post__attachment-extension-wrapper" role="group">
							<span class="screen-reader-text"><?php esc_html_e( 'File extension:', 'pressville' ); ?></span>
							<span class="post__attachment-extension screen-reader-text"><?php echo esc_html( $attachment['extension'] ); ?></span>
						</span>

					<?php endif; ?>

					<?php if ( ! empty( $attachment['filesize'] ) ) : ?>

						<span class="post__attachment-filesize-wrapper" role="group">
							<span class="screen-reader-text"><?php esc_html_e( 'File size:', 'pressville' ); ?></span>
							<span class="post__attachment-filesize"><?php echo esc_html( $attachment['filesize'] ); ?></span>
						</span>

					<?php endif; ?>

					<?php if ( true === $attachment['external'] ) : ?>

						<span class="post__attachment-label"><?php esc_html_e( 'External', 'pressville' ); ?></span>

					<?php endif; ?>

				</li>

			<?php endforeach; ?>

		</ul>

	</div>
	<!-- POST ATTACHMENTS : end -->

<?php endif; ?>