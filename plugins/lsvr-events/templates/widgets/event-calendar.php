<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content">

	<?php if ( ! empty( $calendar ) ) : ?>

		<div class="lsvr_event-calendar-widget__calendar"
			data-instance-json="<?php echo esc_attr( json_encode( $instance ) ); ?>"
			data-month-names="<?php echo esc_attr( json_encode( lsvr_events_get_list_of_month_names() ) ); ?>"
			data-year="<?php echo esc_attr( $year ); ?>"
			data-month="<?php echo esc_attr( $month ); ?>">

			<div class="lsvr_event-calendar-widget__calendar-inner">

				<div class="lsvr_event-calendar-widget__calendar-header">

					<h4 class="lsvr_event-calendar-widget__calendar-title">
						<span class="lsvr_event-calendar-widget__calendar-title-month">
							<?php echo date_i18n( 'F', strtotime( '01-' . $month .'-' . $year ) ); ?>
						</span>
						<span class="lsvr_event-calendar-widget__calendar-title-year">
							<?php echo date_i18n( 'Y', strtotime( '01-' . $month .'-' . $year ) ); ?>
						</span>
					</h4>

					<button type="button" class="lsvr_event-calendar-widget__nav-btn lsvr_event-calendar-widget__nav-btn--prev">
						<span class="lsvr_event-calendar-widget__nav-btn-icon" aria-hidden="true"></span>
						<span class="screen-reader-text"><?php esc_html_e( 'Previous Month', 'lsvr-events' ); ?></span>
					</button>

					<button type="button" class="lsvr_event-calendar-widget__nav-btn lsvr_event-calendar-widget__nav-btn--next">
						<span class="lsvr_event-calendar-widget__nav-btn-icon" aria-hidden="true"></span>
						<span class="screen-reader-text"><?php esc_html_e( 'Next Month', 'lsvr-events' ); ?></span>
					</button>

				</div>

				<ul class="lsvr_event-calendar-widget__weekday-list" aria-hidden="true">

					<?php foreach ( $weekdays as $weekday ) : ?>

						<li class="lsvr_event-calendar-widget__weekday">
							<?php echo esc_html( $weekday ); ?>
						</li>

					<?php endforeach; ?>

				</ul>

				<a href="#lsvr_event-calendar-widget__back-to-days-<?php echo esc_attr( $unique_id ); ?>" id="lsvr_event-calendar-widget__skip-days-<?php echo esc_attr( $unique_id ); ?>"
					class="screen-reader-text"><?php esc_html_e( 'Skip calendar days', 'lsvr-events' ); ?></a>

				<div class="lsvr_event-calendar-widget__day-list-wrapper">
					<ul class="lsvr_event-calendar-widget__day-list">

						<?php if ( ! empty( $calendar ) ) : foreach ( $calendar as $day_key => $day_data ) : ?>

							<li<?php lsvr_events_the_event_calendar_widget_day_class( $day_key, $day_data ) ?>
								<?php if ( ! empty( $day_data['occurrences'] ) ) : ?>
									title="<?php echo esc_attr( sprintf( esc_html( _n( '%s - %d Event', '%s - %d Events', count( $day_data['occurrences'] ), 'lsvr-events') ), date_i18n( get_option( 'date_format' ), strtotime( $day_key ) ), count( $day_data['occurrences'] ) ) ); ?>"
								<?php else : ?>
									title="<?php echo esc_attr( sprintf( esc_html__( '%s - No Events', 'lsvr-events' ), date_i18n( get_option( 'date_format' ), strtotime( $day_key ) ) ) ); ?>"
								<?php endif; ?>>

								<?php if ( empty( $day_data['occurrences'] ) ) : ?>

									<span class="lsvr_event-calendar-widget__day-cell" aria-hidden="true">
										<span><?php echo esc_html( date_i18n( 'j', strtotime( $day_key ) ) ); ?></span>
									</span>

								<?php // Has events
								elseif ( ! empty( $day_data['occurrences'] ) ) : ?>

									<?php if ( count( $day_data['occurrences'] ) > 1 ) : ?>

										<a href="<?php echo esc_url( add_query_arg( array( 'date_from' => $day_key, 'date_to' => $day_key ), get_post_type_archive_link( 'lsvr_event' ) ) ); ?>"
											aria-label="<?php echo esc_attr( esc_html__( 'Go to events', 'lsvr-events' ) ); ?>"
											class="lsvr_event-calendar-widget__day-cell">
											<?php echo esc_html( date_i18n( 'j', strtotime( $day_key ) ) ); ?>
										</a>

									<?php elseif ( ! empty( $day_data['occurrences'][0]['postid'] ) ) : ?>

										<a href="<?php echo esc_url( get_permalink( $day_data['occurrences'][0]['postid'] ) ); ?>"
											class="lsvr_event-calendar-widget__day-cell"
											aria-label="<?php echo esc_attr( esc_html__( 'Go to event', 'lsvr-events' ) ); ?>">
											<?php echo esc_html( date_i18n( 'j', strtotime( $day_key ) ) ); ?>
										</a>

									<?php endif; ?>

								<?php endif; ?>

							</li>

						<?php endforeach; endif; ?>

					</ul>
					<span class="c-spinner" aria-hidden="true"></span>
				</div>

				<a href="#lsvr_event-calendar-widget__skip-days-<?php echo esc_attr( $unique_id ); ?>" id="lsvr_event-calendar-widget__back-to-days-<?php echo esc_attr( $unique_id ); ?>"
					class="screen-reader-text"><?php esc_html_e( 'Back to calendar days', 'lsvr-events' ); ?></a>

			</div>
		</div>

		<?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>

			<p class="widget__more">

				<?php if ( ! empty( $instance['location'] ) && is_numeric( $instance['location'] ) ) : ?>

					<a href="<?php echo esc_url( get_term_link( (int) $instance['location'], 'lsvr_event_location' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

				<?php elseif ( ! empty( $instance['category'] ) && is_numeric( $instance['category'] ) ) : ?>

					<a href="<?php echo esc_url( get_term_link( (int) $instance['category'], 'lsvr_event_cat' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

				<?php else : ?>

					<a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_event' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

				<?php endif; ?>

			</p>

		<?php endif; ?>

	<?php endif; ?>

</div>

<?php // TEMPLATE : END
endif; ?>