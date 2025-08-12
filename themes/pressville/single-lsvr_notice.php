<?php get_header(); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<?php // Main begin
get_template_part( 'template-parts/main-begin' ); ?>

<!-- POST SINGLE : begin -->
<div class="lsvr_notice-post-page post-single lsvr_notice-post-single">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<!-- POST : begin -->
		<article <?php post_class( 'post' ); ?>>
			<div class="post__inner">

				<!-- POST HEADER : begin -->
				<header class="post__header">

					<!-- POST TITLE : begin -->
					<h1 class="post__title is-main-headline"><?php the_title(); ?></h1>
					<!-- POST TITLE : end -->

					<?php // Post meta
					get_template_part( 'template-parts/single-post-meta' ); ?>

				</header>
				<!-- POST HEADER : end -->

				<?php // Add custom code before content
				do_action( 'lsvr_pressville_notice_single_content_before' ); ?>

				<?php // Post content
				get_template_part( 'template-parts/single-post-content' ); ?>

				<?php // Add custom code before footer
				do_action( 'lsvr_pressville_notice_single_footer_before' ); ?>

				<?php // Post footer
				get_template_part( 'template-parts/single-post-footer' ); ?>

				<?php // Add custom code at post bottom
				do_action( 'lsvr_pressville_notice_single_bottom' ); ?>

			</div>
		</article>
		<!-- POST : end -->

		<?php // Post navigation
		get_template_part( 'template-parts/single-navigation' ); ?>

	<?php endwhile; endif; ?>

</div>
<!-- POST SINGLE : end -->

<?php // Main end
get_template_part( 'template-parts/main-end' ); ?>

<?php get_footer(); ?>