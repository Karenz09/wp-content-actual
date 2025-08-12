<!-- POST ARCHIVE : begin -->
<div class="post-archive lsvr_notice-post-archive lsvr_notice-post-archive--default">

	<?php // Main header
	get_template_part( 'template-parts/main-header' ); ?>

	<?php // Archive categories
	get_template_part( 'template-parts/archive-categories' ); ?>

	<?php // Archive category description
	get_template_part( 'template-parts/archive-category-description' ); ?>

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<!-- POST : begin -->
			<article <?php post_class( 'post' ); ?>>
				<div class="post__inner">

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

						<?php the_content(); ?>

					</div>
					<!-- POST CONTENT : end -->

				</div>
			</article>
			<!-- POST : end -->

		<?php endwhile; ?>

		<?php // Pagination
		the_posts_pagination(); ?>

	<?php endif; ?>

</div>
<!-- POST ARCHIVE : end -->