<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content">

	<?php if ( ! empty( $document_posts ) ) : ?>

		<ul class="lsvr_document-list-widget__list">

    		<?php foreach ( $document_posts as $document_post ) : ?>

    			<li class="lsvr_document-list-widget__item">

        			<h4 class="lsvr_document-list-widget__item-title">
        				<a href="<?php echo esc_url( get_permalink( $document_post->ID ) ); ?>" class="lsvr_document-list-widget__item-title-link">
        					<?php echo get_the_title( $document_post->ID ); ?>
        				</a>
        			</h4>

        			<?php $attachments = lsvr_documents_get_document_attachments( $document_post->ID );
        			if ( true === $show_date || ( ! empty( $attachments ) && true === $show_attachment_count ) ) : ?>

        				<div class="lsvr_document-list-widget__item-info">

							<?php // Date
							if ( true === $show_date ) : ?>

								<p class="lsvr_document-list-widget__item-date">
									<?php echo esc_html( get_the_date( get_option( 'date_format' ), $document_post->ID ) ); ?>
								</p>

							<?php endif; ?>

							<?php // Attachments
							if ( ! empty( $attachments ) && true === $show_attachment_count ) : ?>

								<p class="lsvr_document-list-widget__item-count">
									<?php echo esc_html( sprintf( _n( '%s attachment', '%s attachments', count( $attachments ), 'lsvr-documents' ), count( $attachments ) ) ); ?>
								</p>

							<?php endif; ?>

        				</div>

        			<?php endif; ?>

    			</li>

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