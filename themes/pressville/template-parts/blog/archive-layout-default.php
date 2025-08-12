<!-- POST ARCHIVE : begin -->
<div class="post-archive blog-post-archive blog-post-archive--default<?php if ( has_post_thumbnail() && 'left' === get_theme_mod( 'blog_archive_thumb_position', 'top' ) ) { echo ' blog-post-archive--thumb-left'; } ?>">

	<?php // Main header
	get_template_part( 'template-parts/main-header' ); ?>

	<?php // Archive categories
	get_template_part( 'template-parts/archive-categories' ); ?>

	<?php // Archive category description
	get_template_part( 'template-parts/archive-category-description' ); ?>

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<!-- POST : begin -->
			<article <?php post_class(); ?>>
				<div class="post__inner">

					<?php if ( has_post_thumbnail() && 'left' === get_theme_mod( 'blog_archive_thumb_position', 'top' ) ) : ?>

						<div class="lsvr-grid">
							<div class="lsvr-grid__col lsvr-grid__col--span-6">

								<?php // Post thumbnail
								get_template_part( 'template-parts/archive-post-thumbnail' ); ?>

							</div>
							<div class="lsvr-grid__col lsvr-grid__col--span-6">

					<?php elseif ( has_post_thumbnail() ) : ?>

						<?php // Post thumbnail
						get_template_part( 'template-parts/archive-post-thumbnail' ); ?>

					<?php endif; ?>

					<!-- POST HEADER : begin -->
					<header class="post__header">

						<?php // Post meta
						get_template_part( 'template-parts/archive-post-meta' ); ?>

						<!-- POST TITLE : begin -->
						<h2 class="post__title">
							<a href="<?php the_permalink(); ?>" class="post__title-link" rel="bookmark"><?php the_title(); ?></a>
						</h2>
						<!-- POST TITLE : end -->

					</header>
					<!-- POST HEADER : end -->

					<!-- POST CONTENT : begin -->
					<div class="post__content">

						<?php if ( ! empty( $post->post_excerpt ) ) : ?>

							<?php the_excerpt(); ?>

							<!-- POST PERMALINK : begin -->
							<p class="post__permalink">
								<a href="<?php the_permalink(); ?>" class="c-button post__permalink-link" rel="bookmark">
									<?php esc_html_e( 'Read More', 'pressville' ); ?>
								</a>
							</p>
							<!-- POST PERMALINK : end -->

						<?php elseif ( $post->post_content ) : ?>

							<?php the_content(); ?>

						<?php endif; ?>

					</div>
					<!-- POST CONTENT : end -->

					<?php if ( has_post_thumbnail() && 'left' === get_theme_mod( 'blog_archive_thumb_position', 'top' ) ) : ?>

							</div>
						</div>

					<?php endif; ?>

				</div>
			</article>
			<!-- POST : end -->

		<?php endwhile; ?>

		<?php // Pagination
		the_posts_pagination(); ?>

	<?php endif; ?>

</div>
<!-- POST ARCHIVE : end -->