<?php
/*
 * Events functionality supports recurring events created via custom DB table,
 * that's why we can't use standard WP loop, but will have to do it via custom function instead
 */
?>

<!-- POST ARCHIVE : begin -->
<div class="lsvr_event-post-page post-archive lsvr_event-post-archive lsvr_event-post-archive--timeline">

	<?php // Main header
	get_template_part( 'template-parts/main-header' ); ?>

	<?php // Archive categories
	get_template_part( 'template-parts/archive-categories' ); ?>

	<?php // Archive category description
	get_template_part( 'template-parts/archive-category-description' ); ?>

	<?php // Archive filter
	get_template_part( 'template-parts/lsvr_event/archive-filter' ); ?>

	<?php if ( lsvr_pressville_has_events() ) : ?>

		<!-- POST ARCHIVE TIMELINE : begin -->
		<div class="post-archive__timeline">

			<?php $event_occurrences = lsvr_pressville_get_event_archive(); foreach ( $event_occurrences as $event_occurrence ) : ?>

				<!-- POST : begin -->
				<article <?php post_class( 'post' ); ?>>
					<div class="post__inner">

						<!-- POST HEADER : begin -->
						<header class="post__header">

							<!-- POST DATE : begin -->
							<p class="post__date is-secondary-font" title="<?php echo esc_attr( date_i18n( get_option( 'date_format' ), strtotime( $event_occurrence['start'] ) ) ); ?>">

								<span class="post__date-day" aria-hidden="true">
									<?php echo esc_html( date_i18n( 'j', strtotime( $event_occurrence['start'] ) ) ); ?>
								</span>

								<span class="post__date-month" aria-hidden="true">
									<?php echo esc_html( date_i18n( 'F', strtotime( $event_occurrence['start'] ) ) ); ?>
								</span>

								<span class="post__date-year" aria-hidden="true">
									<?php echo esc_html( date_i18n( 'Y', strtotime( $event_occurrence['start'] ) ) ); ?>
								</span>

								<span class="post__date-full" aria-hidden="true">
									<?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $event_occurrence['start'] ) ) ); ?>
								</span>

							</p>
							<!-- POST DATE : end -->

							<?php // Post thumbnail
							include( locate_template( 'template-parts/lsvr_event/archive-timeline-post-thumbnail.php' ) ); ?>

							<!-- POST TITLE : begin -->
							<h2 class="post__title">
								<a href="<?php echo esc_url( get_permalink( $event_occurrence['postid'] ) ); ?>" class="post__title-link" rel="bookmark">
									<?php echo esc_html( get_the_title( $event_occurrence['postid'] ) ); ?>
								</a>
							</h2>
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

						</header>
						<!-- POST HEADER : end -->

						<?php if ( has_excerpt( $event_occurrence['postid'] ) ) : ?>

							<!-- POST CONTENT : begin -->
							<div class="post__content">
								<?php echo wpautop( get_the_excerpt( $event_occurrence['postid'] ) ); ?>
							</div>
							<!-- POST CONTENT : end -->

						<?php endif; ?>

						<!-- POST PERMALINK : begin -->
						<p class="post__permalink">
							<a href="<?php echo get_permalink( $event_occurrence['postid'] ); ?>"
								class="c-button post__permalink-link">
								<?php esc_html_e( 'More Info', 'pressville' ); ?>
							</a>
						</p>
						<!-- POST PERMALINK : end -->

					</div>
				</article>
				<!-- POST : end -->

			<?php endforeach; ?>

		</div>
		<!-- POST ARCHIVE TIMELINE : end -->

		<?php // Pagination
		get_template_part( 'template-parts/lsvr_event/archive-pagination' ); ?>

	<?php else : ?>

		<?php lsvr_pressville_the_alert_message( esc_html__( 'No events matched your criteria', 'pressville' ) ); ?>

	<?php endif; ?>

</div>
<!-- POST ARCHIVE : end -->