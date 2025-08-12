<!-- POST ARCHIVE : begin -->
<div class="lsvr_person-post-page post-archive lsvr_person-post-archive lsvr_person-post-archive--default">

	<?php // Main header
	get_template_part( 'template-parts/main-header' ); ?>

	<?php // Archive categories
	get_template_part( 'template-parts/archive-categories' ); ?>

	<?php // Archive category description
	get_template_part( 'template-parts/archive-category-description' ); ?>

	<?php if ( have_posts() ) : ?>

		<!-- POST ARCHIVE GRID : begin -->
		<div <?php lsvr_pressville_the_person_post_archive_grid_class(); ?>>

			<?php while ( have_posts() ) : the_post(); ?>

				<div <?php lsvr_pressville_the_person_post_archive_grid_column_class(); ?>>

					<!-- POST : begin -->
					<article <?php post_class( 'post' ); ?>>
						<div class="post__inner">

							<!-- POST HEADER : begin -->
							<header class="post__header">

								<?php // Post thumbnail
								get_template_part( 'template-parts/archive-post-thumbnail' ); ?>

								<!-- POST TITLE : begin -->
								<h2 class="post__title">
									<a href="<?php the_permalink(); ?>" class="post__title-link" rel="bookmark">
										<?php the_title(); ?>
									</a>
								</h2>
								<!-- POST TITLE : end -->

								<?php if ( lsvr_pressville_has_person_role( get_the_ID() ) ) : ?>

									<!-- POST SUBTITLE : begin -->
									<p class="post__subtitle">
										<?php lsvr_pressville_the_person_role( get_the_ID() ); ?>
									</p>
									<!-- POST SUBTITLE : end -->

								<?php endif; ?>

							</header>
							<!-- POST HEADER : end -->

							<?php if ( has_excerpt( get_the_ID() ) ) : ?>

								<!-- POST CONTENT : begin -->
								<div class="post__content">

									<?php the_excerpt(); ?>

								</div>
								<!-- POST CONTENT : end -->

							<?php endif; ?>

							<?php // Add custom code before social links
							do_action( 'lsvr_pressville_person_archive_social_before' ); ?>

							<?php // Social links
							get_template_part( 'template-parts/lsvr_person/social-links' ); ?>

							<?php // Add custom code after social links
							do_action( 'lsvr_pressville_person_archive_social_after' ); ?>

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

		<?php lsvr_pressville_the_alert_message( esc_html__( 'There are no person posts', 'pressville' ) ); ?>

	<?php endif; ?>

</div>
<!-- POST ARCHIVE : end -->