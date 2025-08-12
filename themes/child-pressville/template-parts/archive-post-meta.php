<?php if ( true === apply_filters( 'lsvr_pressville_post_archive_post_meta_enable', true )
	&& ( true === apply_filters( 'lsvr_pressville_post_archive_post_meta_date_enable', false )
		|| true === apply_filters( 'lsvr_pressville_post_archive_post_meta_author_enable', false )
		|| lsvr_pressville_has_post_terms( get_the_ID(), apply_filters( 'lsvr_pressville_post_category_taxonomy', '' ) )
		|| ( true === apply_filters( 'lsvr_pressville_post_archive_post_meta_comments_enable', true ) && lsvr_pressville_has_post_comments( get_the_ID() ) ) ) ) : ?>

	<!-- POST META : begin -->
	<p class="post__meta">

		<?php if ( true === apply_filters( 'lsvr_pressville_post_archive_post_meta_date_enable', false ) ) : ?>

			<!-- POST DATE : begin -->
			<span class="post__meta-item post__meta-item--date" role="group">
				<?php echo esc_html( get_the_date() ); ?>
			</span>
			<!-- POST DATE : end -->

		<?php endif; ?>

		<?php if ( true === apply_filters( 'lsvr_pressville_post_archive_post_meta_author_enable', false ) ) : ?>

			<!-- POST AUTHOR : begin -->
			<span class="post__meta-item post__meta-item--author">
				<?php echo sprintf( esc_html__( 'by %s', 'pressville' ), '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" class="post__meta-item-link" rel="author">' . get_the_author() . '</a>' ); ?>
			</span>
			<!-- POST AUTHOR : end -->

		<?php endif; ?>

		<?php if ( lsvr_pressville_has_post_terms( get_the_ID(), apply_filters( 'lsvr_pressville_post_category_taxonomy', '' ) ) ) : ?>

				<!-- POST CATEGORIES : begin -->
				<span class="post__meta-item post__meta-item--category" title="<?php echo esc_attr( esc_html__( 'Category', 'pressville' ) ); ?>">
					<?php lsvr_pressville_the_post_terms( get_the_ID(), apply_filters( 'lsvr_pressville_post_category_taxonomy', '' ), esc_html__( 'in %s', 'pressville' ) ); ?>
				</span>
				<!-- POST CATEGORIES : end -->

		<?php endif; ?>

		<?php if ( true === apply_filters( 'lsvr_pressville_post_archive_post_meta_comments_enable', true ) && lsvr_pressville_has_post_comments( get_the_ID() ) ) : ?>

			<!-- POST COMMENTS COUNT : begin -->
			<span class="post__meta-item post__meta-item--comments">
				<a href="<?php the_permalink(); ?>#comments"
					class="post__meta-item-link"><?php echo sprintf( esc_html( _n( '(%s Comment)', '(%s Comments)', lsvr_pressville_get_post_comments_count(), 'pressville' ) ), lsvr_pressville_get_post_comments_count() ); ?></a>
			</span>
			<!-- POST COMMENTS COUNT : end -->

		<?php endif; ?>

	</p>
	<!-- POST META : end -->

<?php endif; ?>