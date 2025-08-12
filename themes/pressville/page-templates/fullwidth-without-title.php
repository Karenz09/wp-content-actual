<?php /* Template Name: Fullwidth w/o Title */
esc_html__( 'Fullwidth w/o Title', 'pressville' ); ?>

<?php get_header(); ?>

<!-- MAIN : begin -->
<main id="main" class="main--fullwidth">
	<div class="main__inner">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div <?php post_class(); ?>>

				<?php get_template_part( 'template-parts/page-content' ); ?>

			</div>

		<?php endwhile; endif; ?>

	</div>
</main>
<!-- MAIN : end -->

<?php get_footer(); ?>