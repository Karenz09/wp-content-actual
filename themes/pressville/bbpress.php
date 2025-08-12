<?php get_header(); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<?php // Main begin
get_template_part( 'template-parts/main-begin' ); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div <?php post_class(); ?>>

		<?php // Main header
		get_template_part( 'template-parts/main-header' ); ?>

		<!-- PAGE CONTENT : begin -->
		<div class="page__content">

			<?php the_content(); ?>

		</div>
		<!-- PAGE CONTENT : end -->

	</div>

<?php endwhile; endif; ?>

<?php // Main end
get_template_part( 'template-parts/main-end' ); ?>

<?php get_footer(); ?>