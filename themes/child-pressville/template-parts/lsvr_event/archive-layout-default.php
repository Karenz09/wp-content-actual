<?php
/*
 * Events functionality supports recurring events created via custom DB table,
 * that's why we can't use standard WP loop, but will have to do it via custom function instead
 */
?>

<!-- POST ARCHIVE : begin -->
<div class="lsvr_event-post-page post-archive lsvr_event-post-archive lsvr_event-post-archive--default">

	<?php // Main header
	get_template_part( 'template-parts/main-header' ); ?>

	<?php // Archive categories
	get_template_part( 'template-parts/archive-categories' ); ?>

	<?php // Archive category description
	get_template_part( 'template-parts/archive-category-description' ); ?>

	<?php // Archive filter
	get_template_part( 'template-parts/lsvr_event/archive-filter' ); ?>

	<?php if ( lsvr_pressville_has_events() ) : ?>

		<!-- POST ARCHIVE GRID : begin -->
		<div class="post-archive__grid">

			<?php $i = 1; $event_occurrences = lsvr_pressville_get_event_archive(); foreach ( $event_occurrences as $event_occurrence ) : ?>

				<?php lsvr_pressville_the_event_post_archive_grid_begin( $event_occurrence, $i ); ?>

				<div class="<?php lsvr_pressville_the_event_post_archive_grid_column_class(); ?>">

					<!-- POST : begin -->
					<article <?php lsvr_pressville_the_event_post_class( $event_occurrence['postid'] ); ?>>
						<div class="post__inner">

							<?php // Post thumbnail
							include( locate_template( 'template-parts/lsvr_event/archive-post-thumbnail.php' ) ); ?>

							<!-- POST CONTENT : begin -->
							<div class="post__content">

								<!-- POST DATE : begin -->
								<p class="post__date">
									<?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $event_occurrence['start'] ) ) ); ?>
								</p>
								<!-- POST DATE : end -->

								<!-- POST TITLE : begin -->
								<h3 class="post__title">
									<a href="<?php echo get_permalink( $event_occurrence['postid'] ); ?>" class="post__title-link" rel="bookmark">
										<?php echo esc_html( get_the_title( $event_occurrence['postid'] ) ); ?>
									</a>
								</h3>
								<!-- POST TITLE : end -->

								<!-- POST META : begin -->
								<p class="post__meta">

									<span class="post__meta-time" title="<?php echo esc_attr( esc_html__( 'Event Time', 'pressville' ) ); ?>">
										<?php lsvr_pressville_the_event_archive_time( $event_occurrence, esc_html__( '%s - %s', 'pressville' ) ); ?>
									</span>

									<span class="post__meta-location" title="<?php echo esc_attr( esc_html__( 'Event Location', 'pressville' ) ); ?>">
										<?php lsvr_pressville_the_event_location_linked( $event_occurrence['postid'], esc_html__( 'at %s', 'pressville' ) ); ?>
									</span>

								</p>
								<!-- POST META : end -->

							</div>
							<!-- POST CONTENT : begin -->

						</div>
					</article>
					<!-- POST : end -->

				</div>

				<?php lsvr_pressville_the_event_post_archive_grid_end( $i, count( $event_occurrences ) ); ?>

			<?php $i++; endforeach; ?>

		</div>
		<!-- POST ARCHIVE GRID : end -->

		<?php // Pagination
		get_template_part( 'template-parts/lsvr_event/archive-pagination' ); ?>

	<?php else : ?>

		<?php lsvr_pressville_the_alert_message( esc_html__( 'No events matched your criteria', 'pressville' ) ); ?>

	<?php endif; ?>

</div>
<!-- POST ARCHIVE : end -->