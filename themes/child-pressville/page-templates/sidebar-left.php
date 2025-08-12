<?php /* Template Name: Sidebar on the Left */
esc_html__( 'Sidebar on the Left', 'pressville' ); ?>

<?php get_header(); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<!-- COLUMNS : begin -->
<div id="columns">
	<div class="columns__inner">
		<div class="lsvr-container">

			<div class="lsvr-grid">
				<div class="columns__main lsvr-grid__col lsvr-grid__col--span-8 lsvr-grid__col--push-4">

					<!-- MAIN : begin -->
					<main id="main">
						<div class="main__inner">

							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

								<div <?php post_class(); ?>>

									<!-- PAGE HEADER : begin -->
									<header class="page__header">
										<h1 class="page__title is-main-headline">
											<?php the_title(); ?>
										</h1>
									</header>
									<!-- PAGE HEADER : end -->

									<?php get_template_part( 'template-parts/page-content' ); ?>

								</div>

							<?php endwhile; endif; ?>

						</div>
					</main>
					<!-- MAIN : end -->

				</div>
				<div class="columns__sidebar columns__sidebar--left lsvr-grid__col lsvr-grid__col--span-4 lsvr-grid__col--pull-8">

					<?php // Sidebar
					get_sidebar(); ?>

				</div>
			</div>

		</div>
	</div>
</div>
<!-- COLUMNS : end -->

<?php get_footer(); ?>