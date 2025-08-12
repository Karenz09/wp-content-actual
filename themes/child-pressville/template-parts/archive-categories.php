<?php if ( true === apply_filters( 'lsvr_pressville_post_archive_categories_enable', false ) &&
	taxonomy_exists( apply_filters( 'lsvr_pressville_post_category_taxonomy', '' ) ) &&
	! empty( get_terms( apply_filters( 'lsvr_pressville_post_category_taxonomy', '' ) ) ) ) : ?>

	<!-- POST ARCHIVE CATEGORIES : begin -->
	<nav class="post-archive-categories" title="<?php echo esc_attr( esc_html__( 'Categories', 'pressville' ) ); ?>">
		<span class="post-archive-categories__icon" aria-hidden="true"></span>
		<ul class="post-archive-categories__list">

			<?php // "All" link
			if ( is_category() || is_tax( apply_filters( 'lsvr_pressville_post_category_taxonomy', '' ) ) ) : ?>

				<li class="post-archive-categories__item post-archive-categories__item--all">
					<a href="<?php echo esc_url( add_query_arg( apply_filters( 'lsvr_pressville_post_archive_categories_url_args', array() ), get_post_type_archive_link( apply_filters( 'lsvr_pressville_current_post_type', '' ) ) ) ); ?>"
						class="post-archive-categories__item-link"><?php esc_html_e( 'All', 'pressville' ); ?></a>
				</li>

			<?php else : ?>

				<li class="post-archive-categories__item post-archive-categories__item--all post-archive-categories__item--active"
					title="<?php echo esc_attr( esc_html__( 'Active category', 'pressville' ) ); ?>">
					<?php esc_html_e( 'All', 'pressville' ); ?>
				</li>

			<?php endif; ?>

			<?php // Categories
			foreach ( get_terms( apply_filters( 'lsvr_pressville_post_category_taxonomy', '' ) ) as $term ) : ?>

				<?php if ( ! in_array( $term->term_id, apply_filters( 'lsvr_pressville_post_archive_categories_excluded', array() ) ) ) : ?>

					<?php if ( get_queried_object_id() === $term->term_id ) : ?>

						<li class="post-archive-categories__item post-archive-categories__item--category post-archive-categories__item--active"
							title="<?php echo esc_attr( esc_html__( 'Active category', 'pressville' ) ); ?>">
							<?php echo esc_html( $term->name ); ?>
						</li>

					<?php else : ?>

						<li class="post-archive-categories__item post-archive-categories__item--category">
							<a href="<?php echo esc_url( add_query_arg( apply_filters( 'lsvr_pressville_post_archive_categories_url_args', array() ), get_term_link( $term->term_id, apply_filters( 'lsvr_pressville_post_category_taxonomy', '' ) ) ) ); ?>"
								class="post-archive-categories__item-link"><?php echo esc_html( $term->name ); ?></a>
						</li>

					<?php endif; ?>

				<?php endif; ?>

			<?php endforeach; ?>

		</ul>
	</nav>
	<!-- POST ARCHIVE CATEGORIES : end -->

<?php endif; ?>