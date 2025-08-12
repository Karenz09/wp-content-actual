<?php /* Template Name: Fullwidth */
esc_html__( 'Fullwidth', 'pressville' ); ?>

<?php get_header(); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<!-- COLUMNS : begin -->
<div id="columns">
	<div class="columns__inner">

		<!-- MAIN : begin -->
		<main id="main" class="main--fullwidth">
			<div class="main__inner">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<div <?php post_class(); ?>>

						<div class="lsvr-container">

							<!-- PAGE HEADER : begin -->
							<header class="page__header">
								<h1 class="page__title is-main-headline">
									<?php the_title(); ?>
								</h1>
							</header>
							<!-- PAGE HEADER : end -->

						</div>

						<?php get_template_part( 'template-parts/page-content' ); ?>

					</div>

				<?php endwhile; endif; ?>

			</div>
		</main>
		<!-- MAIN : end -->

	</div>
</div>
<!-- COLUMNS : end -->

<?php get_footer(); ?>