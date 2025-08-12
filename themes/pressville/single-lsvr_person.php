<?php get_header(); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<?php // Main begin
get_template_part( 'template-parts/main-begin' ); ?>

<!-- POST SINGLE : begin -->
<div class="lsvr_person-post-page post-single lsvr_person-post-single">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<!-- POST : begin -->
		<article <?php post_class( 'post' ); ?>>
			<div class="post__inner">

				<!-- POST HEADER : begin -->
				<header class="post__header<?php if ( has_post_thumbnail() ) { echo ' post__header--has-thumb'; } ?>">

					<?php // Thumbnail
					get_template_part( 'template-parts/single-post-thumbnail' ); ?>

					<!-- POST TITLE : begin -->
					<h1 class="post__title is-main-headline">
						<?php the_title(); ?>
					</h1>
					<!-- POST TITLE : end -->

					<?php if ( lsvr_pressville_has_person_role( get_the_ID() ) ) : ?>

						<!-- POST SUBTITLE : begin -->
						<p class="post__subtitle">
							<?php lsvr_pressville_the_person_role( get_the_ID() ); ?>
						</p>
						<!-- POST SUBTITLE : end -->

					<?php endif; ?>

					<?php // Add custom code before social links
					do_action( 'lsvr_pressville_person_single_social_before' ); ?>

					<?php // Social links
					get_template_part( 'template-parts/lsvr_person/social-links' ); ?>

					<?php // Add custom code after social links
					do_action( 'lsvr_pressville_person_single_social_after' ); ?>

				</header>
				<!-- POST HEADER : end -->

				<?php // Add custom code before contact info
				do_action( 'lsvr_pressville_person_single_contact_info_before' ); ?>

				<?php // Contact info
				get_template_part( 'template-parts/lsvr_person/contact-info' ); ?>

				<?php // Add custom code before content
				do_action( 'lsvr_pressville_person_single_content_before' ); ?>

				<?php // Post content
				get_template_part( 'template-parts/single-post-content' ); ?>

				<?php // Add custom code at post bottom
				do_action( 'lsvr_pressville_person_single_bottom' ); ?>

			</div>
		</article>
		<!-- POST : end -->

	<?php endwhile; endif; ?>

</div>
<!-- POST SINGLE : end -->

<?php // Main end
get_template_part( 'template-parts/main-end' ); ?>

<?php get_footer(); ?>