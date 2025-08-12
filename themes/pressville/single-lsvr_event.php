<?php get_header(); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<?php // Main begin
get_template_part( 'template-parts/main-begin' ); ?>

<!-- POST SINGLE : begin -->
<div class="lsvr_event-post-page post-single lsvr_event-post-single">

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

				<?php // Add custom code before thumbnail
				do_action( 'lsvr_pressville_event_single_thumbnail_before' ); ?>

				<?php // Thumbnail
				get_template_part( 'template-parts/single-post-thumbnail' ); ?>

				<?php // Add custom code before info
				do_action( 'lsvr_pressville_event_single_info_before' ); ?>

				<?php // Event info
				get_template_part( 'template-parts/lsvr_event/single-info' ); ?>

				<?php // Add custom code before content
				do_action( 'lsvr_pressville_event_single_content_before' ); ?>

				<?php // Post content
				get_template_part( 'template-parts/single-post-content' ); ?>

				<?php // Add custom code before map
				do_action( 'lsvr_pressville_event_single_map_before' ); ?>

				<?php // Map
				get_template_part( 'template-parts/lsvr_event/single-map' ); ?>

				<?php // Add custom code before upcoming occurrences
				do_action( 'lsvr_pressville_event_single_upcoming_occurrences_before' ); ?>

				<?php // Upcoming occurrences
				get_template_part( 'template-parts/lsvr_event/single-upcoming-occurrences' ); ?>

				<?php // Add custom code before footer
				do_action( 'lsvr_pressville_event_single_footer_before' ); ?>

				<?php // Post footer
				get_template_part( 'template-parts/single-post-footer' ); ?>

				<?php // Add custom code at post bottom
				do_action( 'lsvr_pressville_event_single_bottom' ); ?>

			</div>
		</article>
		<!-- POST : end -->

	<?php endwhile; endif; ?>

</div>
<!-- POST SINGLE : end -->

<?php // Main end
get_template_part( 'template-parts/main-end' ); ?>

<?php get_footer(); ?>