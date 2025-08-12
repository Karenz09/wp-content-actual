<?php /* Template Name: Default w/o Title */
esc_html__( 'Default w/o Title', 'pressville' ); ?>

<?php get_header(); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<!-- COLUMNS : begin -->
<div id="columns">
	<div class="columns__inner">
		<div class="lsvr-container">

			<!-- MAIN : begin -->
			<main id="main">
				<div class="main__inner">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<div <?php post_class(); ?>>

							<?php get_template_part( 'template-parts/page-content' ); ?>

						</div>

					<?php endwhile; endif; ?>

				</div>
			</main>
			<!-- MAIN : end -->

		</div>
	</div>
</div>
<!-- COLUMNS : end -->

<?php get_footer(); ?>