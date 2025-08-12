<?php if ( true === apply_filters( 'lsvr_pressville_event_single_upcoming_occurrences_enable', true )
	&& lsvr_pressville_is_recurring_event( get_the_ID() ) && lsvr_pressville_has_next_event_occurrences( get_the_ID() ) ) : ?>

	<?php // Recurring info
	lsvr_pressville_the_alert_message( esc_html__( 'This is a recurring event.', 'pressville' ) . ' ' . lsvr_pressville_get_event_recurrence_pattern_text( get_the_ID(), esc_html__( 'Repeating every %s.', 'pressville' ) ) ); ?>

	<!-- UPCOMING DATES : begin -->
	<div class="post__dates">

		<h2 class="post__dates-title"><?php esc_html_e( 'Upcoming Dates', 'pressville' ); ?></h2>

		<?php $next_occurrences = lsvr_pressville_get_next_event_occurrences( get_the_ID(), apply_filters( 'lsvr_pressville_event_detail_upcoming_occurrences_count', 30 ) );
		if ( ! empty( $next_occurrences ) ) : ?>

			<div class="post__dates-list-wrapper post__dates-list-wrapper--<?php echo esc_attr( count( $next_occurrences ) ); ?>-items">
				<ul class="post__dates-list">

					<?php foreach ( $next_occurrences as $occurrence ) : ?>
						<?php if ( ! empty( $occurrence['start'] ) ) : ?>

							<li class="post__dates-item">
								<?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $occurrence['start'] ) ) ); ?>
							</li>

						<?php endif; ?>
					<?php endforeach; ?>

				</ul>
			</div>

		<?php endif; ?>

	</div>
	<!-- UPCOMING DATES : end -->

<?php endif; ?>