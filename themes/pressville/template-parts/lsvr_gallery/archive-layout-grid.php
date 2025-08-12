<!-- POST ARCHIVE : begin -->
<div class="lsvr_gallery-post-page post-archive lsvr_gallery-post-archive lsvr_gallery-post-archive--grid">

	<?php // Main header
	get_template_part( 'template-parts/main-header' ); ?>

	<?php // Archive categories
	get_template_part( 'template-parts/archive-categories' ); ?>

	<?php // Archive category description
	get_template_part( 'template-parts/archive-category-description' ); ?>

	<?php if ( have_posts() ) : ?>

		<!-- POST ARCHIVE GRID : begin -->
		<div <?php lsvr_pressville_the_gallery_post_archive_grid_class(); ?>>

			<?php while ( have_posts() ) : the_post(); ?>

				<div <?php lsvr_pressville_the_gallery_post_archive_grid_column_class(); ?>>

					<!-- POST : begin -->
					<article <?php post_class( 'post' ); ?>
						<?php lsvr_pressville_the_gallery_post_background_thumbnail( get_the_ID() ); ?>>
						<div class="post__inner">
							<div class="post__bg">

								<!-- POST CONTENT : begin -->
								<div class="post__content">

									<!-- POST TITLE : begin -->
									<h2 class="post__title">
										<a href="<?php the_permalink(); ?>" class="post__title-link" rel="bookmark"><?php the_title(); ?></a>
									</h2>
									<!-- POST TITLE : end -->

									<?php // Post meta
									get_template_part( 'template-parts/lsvr_gallery/archive-post-meta' ); ?>

								</div>
								<!-- POST CONTENT : end -->

								<!-- OVERLAY LINK : begin -->
								<a href="<?php the_permalink(); ?>"
									class="post__overlay-link">
									<span class="screen-reader-text"><?php esc_html_e( 'Open Gallery', 'pressville' ); ?></span>
								</a>
								<!-- OVERLAY LINK : end -->

							</div>
						</div>
					</article>
					<!-- POST : end -->

				</div>

			<?php endwhile; ?>

		</div>
		<!-- POST ARCHIVE GRID : end -->

		<?php // Pagination
		the_posts_pagination(); ?>

	<?php else : ?>

		<?php lsvr_pressville_the_alert_message( esc_html__( 'No galleries matched your criteria', 'pressville' ) ); ?>

	<?php endif; ?>

</div>
<!-- POST ARCHIVE : end -->