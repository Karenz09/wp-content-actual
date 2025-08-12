<!-- POST ARCHIVE : begin -->
<div class="post-archive blog-post-archive blog-post-archive--grid">

	<?php // Main header
	//get_template_part( 'template-parts/main-header' ); ?>

	<?php // Archive categories
	get_template_part( 'template-parts/archive-categories' ); ?>

	<?php // Archive category description
	get_template_part( 'template-parts/archive-category-description' ); ?>

	<?php if ( have_posts() ) : ?>

		<!-- POST ARCHIVE GRID : begin -->
		<div class="post-archive__grid" style="display: flex; max-width: 1400px;">
			<div class="<?php lsvr_pressville_the_blog_post_archive_grid_class(); ?>" style="width: 80%; margin: 0px 20px 0px 0px;">

				<?php while ( have_posts() ) : the_post(); ?>

					<div class="<?php lsvr_pressville_the_blog_post_archive_grid_column_class( get_the_ID() ); ?> entrada-voces">

						<!-- POST : begin -->
						<article <?php post_class(); ?>
							<?php lsvr_pressville_the_blog_post_background_thumbnail( get_the_ID() ); ?>>
							<div class="post__inner">
								<div class="post__bg">

									<!-- POST HEADER : begin -->
									<header class="post__header">

										<!-- POST TITLE : begin -->
										<h2 class="post__title">
											<a href="<?php the_permalink(); ?>" class="post__title-link" rel="bookmark"><?php the_title(); ?></a>
										</h2>
										<!-- POST TITLE : end -->

										<?php // Post meta
										get_template_part( 'template-parts/archive-post-meta' ); ?>

									</header>
									<!-- POST HEADER : end -->

									<!-- OVERLAY LINK : begin -->
									<a href="<?php the_permalink(); ?>"
										class="post__overlay-link">
										<span class="screen-reader-text"><?php esc_html_e( 'Read More', 'pressville' ); ?></span>
									</a>
									<!-- OVERLAY LINK : end -->

								</div>
							</div>
						</article>
						<!-- POST : end -->

					</div>

				<?php endwhile; ?>

			</div>

			<div class="sidebar-columna">
				<!-- SIDEBAR : begin entradas-->
				<aside id="sidebar">
					<div class="sidebar__inner">

						<?php dynamic_sidebar( apply_filters( 'lsvr_pressville_sidebar_id', 'lsvr-pressville-default-sidebar' ) ); ?>

					</div>
				</aside>
				<!-- SIDEBAR : end entradas-->
			</div>
			
		</div>
		<!-- POST ARCHIVE GRID : end -->
		

		<?php // Pagination
		the_posts_pagination(); ?>

	<?php endif; ?>

</div>
<!-- POST ARCHIVE : end -->