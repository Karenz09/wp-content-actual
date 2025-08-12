<?php get_header(); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<!-- MAIN : begin -->
<main id="main">
	<div class="main__inner">

		<!-- ERROR 404 PAGE : begin -->
		<div class="error-404-page">
			<h1 class="error-404-page__404"><?php esc_html_e( '404', 'pressville' ); ?></h1>
			<div class="error-404-page__inner">
				<h2 class="error-404-page__title"><?php esc_html_e( 'Page Not Found', 'pressville' ); ?></h2>
				<p class="error-404-page__text"><?php esc_html_e( 'The server can\'t find the page you requested. The page has either been moved to a different location or deleted, or you may have mistyped the URL.', 'pressville' ); ?></p>
				<p class="error-404-page__link">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="c-button c-button--large"><?php esc_html_e( 'Back to homepage', 'pressville' ); ?></a>
				</p>
			</div>
		</div>
		<!-- ERROR 404 PAGE : end -->

	</div>
</main>
<!-- MAIN : end -->

<?php get_footer(); ?>