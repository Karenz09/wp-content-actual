<?php get_header(); ?>

<?php // Post gallery
get_template_part( 'template-parts/lsvr_listing/single-gallery' ); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<?php // Main begin
get_template_part( 'template-parts/main-begin' ); ?>

<!-- POST SINGLE : begin -->
<div class="lsvr_listing-post-page post-single lsvr_listing-post-single">

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

					<?php // Social links
					get_template_part( 'template-parts/lsvr_listing/single-social-links' ); ?>

				</header>
				<!-- POST HEADER : end -->

				<?php // Add custom code before thumbnail
				do_action( 'lsvr_pressville_listing_single_thumbnail_before' ); ?>

				<?php // Thumbnail
				get_template_part( 'template-parts/single-post-thumbnail' ); ?>

				<?php // Add custom code before content
				do_action( 'lsvr_pressville_listing_single_content_before' ); ?>

				<?php // Post content
				get_template_part( 'template-parts/single-post-content' ); ?>

				<?php // Add custom code before contact info
				do_action( 'lsvr_pressville_listing_single_contact_info_before' ); ?>

				<?php // Contact info
				get_template_part( 'template-parts/lsvr_listing/single-contact-info' ); ?>

				<?php // Map and address
				if ( true === get_theme_mod( 'lsvr_listing_single_map_enable', true ) &&
					lsvr_pressville_has_listing_map_location( get_the_ID() ) && lsvr_pressville_has_listing_address( get_the_ID() ) ) : ?>

					<?php // Add custom code before map
					do_action( 'lsvr_pressville_listing_single_addressmap_before' ); ?>

					<?php // Address and map
					get_template_part( 'template-parts/lsvr_listing/single-addressmap' ); ?>

				<?php // Map only
				elseif ( true === get_theme_mod( 'lsvr_listing_single_map_enable', true ) && lsvr_pressville_has_listing_map_location( get_the_ID() ) ) : ?>

					<?php // Add custom code before map
					do_action( 'lsvr_pressville_listing_single_map_before' ); ?>

					<?php // Map
					get_template_part( 'template-parts/lsvr_listing/single-map' ); ?>

				<?php // Address only
				elseif ( lsvr_pressville_has_listing_address( get_the_ID() ) ) : ?>

					<?php // Add custom code before map
					do_action( 'lsvr_pressville_listing_single_address_before' ); ?>

					<!-- POST ADDRESS : begin -->
					<p class="post__address">
						<?php lsvr_pressville_the_listing_address( get_the_ID(), false ); ?>
					</p>
					<!-- POST ADDRESS : end -->

				<?php endif; ?>

				<?php // Add custom code before opening hours
				do_action( 'lsvr_pressville_listing_single_opening_hours_before' ); ?>

				<?php // Opening hours
				get_template_part( 'template-parts/lsvr_listing/single-opening-hours' ); ?>

				<?php // Add custom code before footer
				do_action( 'lsvr_pressville_listing_single_footer_before' ); ?>

				<?php // Post footer
				get_template_part( 'template-parts/single-post-footer' ); ?>

				<?php // Add custom code at post bottom
				do_action( 'lsvr_pressville_listing_single_bottom' ); ?>

			</div>
		</article>
		<!-- POST : end -->

	<?php endwhile; endif; ?>

</div>
<!-- POST SINGLE : end -->

<?php // Main end
get_template_part( 'template-parts/main-end' ); ?>

<?php get_footer(); ?>