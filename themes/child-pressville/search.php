<?php get_header(); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<!-- COLUMNS : begin -->
<div id="columns">
	<div class="columns__inner">
		<div class="lsvr-container">

			<div class="lsvr-grid">
				<div class="lsvr-grid__col lsvr-grid__col--xlg-span-8 lsvr-grid__col--xlg-push-2">

					<!-- MAIN : begin -->
					<main id="main">
						<div class="main__inner">

							<!-- SEARCH RESULTS PAGE : begin -->
							<div class="search-results-page">

								<?php // Main header
								get_template_part( 'template-parts/main-header' ); ?>

								<?php // Search form
								get_search_form() ?>

								<?php if ( have_posts() ) : ?>

									<?php // Results info
									global $wp_query;
									if ( isset( $wp_query->found_posts ) ) : ?>

										<p><?php echo sprintf( esc_html__( 'Showing %d results for "%s":', 'pressville' ), $wp_query->found_posts, get_search_query() ); ?></p>

									<?php endif; ?>

									<ul class="search-results-page__list">

										<?php while ( have_posts() ) : the_post(); ?>

											<li class="search-results-page__item">

												<span class="search-results-page__item-icon <?php echo esc_attr( lsvr_pressville_get_post_type_icon_class( get_post_type() ) ); ?>"
													aria-hidden="true"></span>

												<h2 class="search-results-page__item-title">
													<a href="<?php the_permalink(); ?>" class="search-results-page__item-title-link"><?php the_title(); ?></a>
												</h2>

												<?php $post_object = get_post_type_object( get_post_type() ); ?>
												<span class="search-results-page__item-type"><?php echo esc_html( $post_object->labels->singular_name ); ?></span>

												<?php if ( true === get_theme_mod( 'search_results_excerpt_enable', false ) && ! empty( $post->post_excerpt ) ) : ?>

													<div class="search-results-page__item-excerpt">

														<?php the_excerpt(); ?>

													</div>

												<?php endif; ?>

											</li>

										<?php endwhile; ?>

									</ul>

									<?php // Pagination
									the_posts_pagination(); ?>

								<?php else : ?>

									<?php lsvr_pressville_the_alert_message( sprintf( esc_html__( 'No results for "%s".', 'pressville' ), get_search_query() ) ); ?>

								<?php endif; ?>

							</div>
							<!-- SEARCH RESULTS PAGE : end -->

						</div>
					</main>
					<!-- MAIN : end -->

				</div>
			</div>

		</div>
	</div>
</div>
<!-- COLUMNS : end -->

<?php get_footer(); ?>