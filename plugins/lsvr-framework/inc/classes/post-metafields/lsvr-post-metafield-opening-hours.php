<?php
/**
 * Opening hours metafield class
 */
if ( ! class_exists( 'Lsvr_Post_Metafield_Opening_Hours' ) && class_exists( 'Lsvr_Post_Metafield' ) ) {
    class Lsvr_Post_Metafield_Opening_Hours extends Lsvr_Post_Metafield {

    	public function __construct( $args ) {
    		parent::__construct( $args );
    	}

    	// Display field
    	public function display_metafield() {

    		// Create array with all weekdays
			$weekdays = array(
    			array( 'id' => 'sun', 'label' => date_i18n( 'l', strtotime( 'Sunday' ) ) ),
    			array( 'id' => 'mon', 'label' => date_i18n( 'l', strtotime( 'Monday' ) ) ),
    			array( 'id' => 'tue', 'label' => date_i18n( 'l', strtotime( 'Tuesday' ) ) ),
    			array( 'id' => 'wed', 'label' => date_i18n( 'l', strtotime( 'Wednesday' ) ) ),
    			array( 'id' => 'thu', 'label' => date_i18n( 'l', strtotime( 'Thursday' ) ) ),
    			array( 'id' => 'fri', 'label' => date_i18n( 'l', strtotime( 'Friday' ) ) ),
    			array( 'id' => 'sat', 'label' => date_i18n( 'l', strtotime( 'Saturday' ) ) ),
			);

    		// Get start day of week from Settings / Global
			$start_of_week = get_option( 'start_of_week' );
			$start_of_week = ! empty( $weekdays[ $start_of_week ] ) ? $start_of_week : 0;

			// Change order of weekdays based on $start_of_week
			if ( $start_of_week > 0 ) {
				$weekdays_part1 = array_slice( $weekdays, $start_of_week );
				$weekdays_part2 = array_slice( $weekdays, 0, $start_of_week );
				$weekdays_sorted = array_merge( $weekdays_part1, $weekdays_part2 );
			} else {
				$weekdays_sorted = $weekdays;
			}

			// Convert current JSON value to array
			if ( $this->current_value !== '' ) {
				$current_hours = @json_decode( $this->current_value );
			}

    		?>

			<div class="lsvr-post-metafield-opening-hours">

				<input type="hidden" value="<?php echo esc_attr( $this->current_value ); ?>"
					class="lsvr-post-metafield__value lsvr-post-metafield-opening-hours__value"
					id="<?php echo esc_attr( $this->input_id ); ?>"
					name="<?php echo esc_attr( $this->input_id ); ?>">

				<div class="lsvr-post-metafield-opening-hours__rows">

					<?php foreach ( $weekdays_sorted as $day ) : ?>

						<div class="lsvr-post-metafield-opening-hours__row"
							data-day="<?php echo esc_attr( $day['id'] ); ?>">

							<?php

							// Check if hours aren't closed for this row
							$day_id = $day['id'];
							$is_closed = ! empty( $current_hours->$day_id )
								&& 'closed' === $current_hours->$day_id ? true : false;

							// Check for breaks
							$breaks_count = ! empty( $current_hours->$day_id ) && substr_count( $current_hours->$day_id, ',' ) > 0 ? substr_count( $current_hours->$day_id, ',' ) : 0;
							$breaks_arr = array();

							// Parse time
							if ( false === $is_closed && ! empty( $current_hours->$day_id ) ) {

								// Parse time period
								$i = 0; foreach ( explode( ',', $current_hours->$day_id ) as $time_period ) { $i++;

									$breaks_arr[ $i ]['time_from'] = substr( $time_period, 0, strpos( $time_period, '-' ) );
									$breaks_arr[ $i ]['hour_from'] = substr( $breaks_arr[ $i ]['time_from'], 0, strpos( $breaks_arr[ $i ]['time_from'], ':' ) );
									$breaks_arr[ $i ]['minute_from'] = substr( $breaks_arr[ $i ]['time_from'], strpos( $breaks_arr[ $i ]['time_from'], ':' ) + 1, strlen( $breaks_arr[ $i ]['time_from'] ) );
									$breaks_arr[ $i ]['time_to'] = substr( $time_period, strpos( $time_period, '-' ) + 1, strlen( $time_period ) );
									$breaks_arr[ $i ]['hour_to'] = substr( $breaks_arr[ $i ]['time_to'], 0, strpos( $breaks_arr[ $i ]['time_to'], ':' ) );
									$breaks_arr[ $i ]['minute_to'] = substr( $breaks_arr[ $i ]['time_to'], strpos( $breaks_arr[ $i ]['time_to'], ':' ) + 1, strlen( $breaks_arr[ $i ]['time_to'] ) );

								}

							} ?>

							<strong class="lsvr-post-metafield-opening-hours__label">
								<?php echo esc_html( $day['label'] ); ?>
							</strong>

							<?php for ( $i = 1; $i <= 3; $i++ ) : ?>

								<div class="lsvr-post-metafield-opening-hours__time-wrapper lsvr-post-metafield-opening-hours__time-wrapper--<?php echo esc_attr( $i ); if ( $i > $breaks_count + 1 ) { echo ' lsvr-post-metafield-opening-hours__time-wrapper--disabled'; } ?>"
									<?php if ( true === $is_closed || $i > $breaks_count + 1 ) { echo ' style="display: none; "';}  ?>>

									<select class="lsvr-post-metafield-opening-hours__select lsvr-post-metafield-opening-hours__hour-from lsvr-post-metafield-opening-hours__hour-from--<?php echo esc_attr( $i ); ?>"
										<?php if ( true === $is_closed || $i > $breaks_count + 1 ) { echo ' disabled="disabled"'; } ?>>

										<?php for ( $j = 0; $j < 24; $j++ ) :
											$value = str_pad( $j, 2, 0, STR_PAD_LEFT ); ?>

											<option value="<?php echo esc_attr( $value ); ?>"
												<?php if ( false === $is_closed && ! empty( $breaks_arr[ $i ]['hour_from'] ) &&
													$value === $breaks_arr[ $i ]['hour_from'] ) { echo ' selected="selected"'; } ?>>
												<?php echo esc_html( $value ); ?>
											</option>

										<?php endfor; ?>

									</select>

									<span class="lsvr-post-metafield-opening-hours__colon">:</span>

									<select class="lsvr-post-metafield-opening-hours__select lsvr-post-metafield-opening-hours__minute-from lsvr-post-metafield-opening-hours__minute-from--<?php echo esc_attr( $i ); ?>"
										<?php if ( true === $is_closed || $i > $breaks_count + 1 ) { echo ' disabled="disabled"'; } ?>>

										<?php for ( $j = 0; $j < 60; $j++ ) :
											$value = str_pad( $j, 2, 0, STR_PAD_LEFT ); ?>

											<option value="<?php echo esc_attr( $value ); ?>"
												<?php if ( false === $is_closed && ! empty( $breaks_arr[ $i ]['minute_from'] ) &&
													$value === $breaks_arr[ $i ]['minute_from'] ) { echo ' selected="selected"'; } ?>>
												<?php echo esc_html( $value ); ?>
											</option>

										<?php endfor; ?>

									</select>

									<span class="lsvr-post-metafield-opening-hours__separator">-</span>

									<select class="lsvr-post-metafield-opening-hours__select lsvr-post-metafield-opening-hours__hour-to lsvr-post-metafield-opening-hours__hour-to--<?php echo esc_attr( $i ); ?>"
										<?php if ( true === $is_closed || $i > $breaks_count + 1 ) { echo ' disabled="disabled"'; } ?>>

										<?php for ( $j = 0; $j < 24; $j++ ) :
											$value = str_pad( $j, 2, 0, STR_PAD_LEFT ); ?>

											<option value="<?php echo esc_attr( $value ); ?>"
												<?php if ( false === $is_closed && ! empty( $breaks_arr[ $i ]['hour_to'] ) &&
													$value === $breaks_arr[ $i ]['hour_to'] ) { echo ' selected="selected"'; } ?>>
												<?php echo esc_html( $value ); ?>
											</option>

										<?php endfor; ?>

									</select>

									<span class="lsvr-post-metafield-opening-hours__colon">:</span>

									<select class="lsvr-post-metafield-opening-hours__select lsvr-post-metafield-opening-hours__minute-to lsvr-post-metafield-opening-hours__minute-to--<?php echo esc_attr( $i ); ?>"
										<?php if ( true === $is_closed || $i > $breaks_count + 1 ) { echo ' disabled="disabled"'; } ?>>

										<?php for ( $j = 0; $j < 60; $j++ ) :
											$value = str_pad( $j, 2, 0, STR_PAD_LEFT ); ?>

											<option value="<?php echo esc_attr( $value ); ?>"
												<?php if ( false === $is_closed && ! empty( $breaks_arr[ $i ]['minute_to'] ) &&
													$value === $breaks_arr[ $i ]['minute_to'] ) { echo ' selected="selected"'; } ?>>
												<?php echo esc_html( $value ); ?>
											</option>

										<?php endfor; ?>

									</select>

								</div>

							<?php endfor; ?>

							<div class="lsvr-post-metafield-opening-hours__breaks"
								<?php if ( true === $is_closed ) { echo ' style="display: none;"'; } ?>>

								<label for="lsvr-post-metafield-opening-hours__breaks-input-0--<?php echo esc_attr( $day['id'] ); ?>"
									class="lsvr-post-metafield-opening-hours__breaks-item-label">
									<input type="radio"
										class="lsvr-post-metafield-opening-hours__breaks-input"
										id="lsvr-post-metafield-opening-hours__breaks-input-0--<?php echo esc_attr( $day['id'] ); ?>"
										name="lsvr-post-metafield-opening-hours__breaks--<?php echo esc_attr( $day['id'] ); ?>"
										value="0"
										<?php if ( true === $is_closed ) { echo ' disabled="disabled"'; } ?>
										<?php if ( 0 === $breaks_count ) { echo ' checked="checked"'; } ?>>
									<span><?php esc_html_e( 'No breaks', 'lsvr-framework' ); ?></span>
								</label>

								<label for="lsvr-post-metafield-opening-hours__breaks-input-1--<?php echo esc_attr( $day['id'] ); ?>"
									class="lsvr-post-metafield-opening-hours__breaks-item-label">
									<input type="radio"
										class="lsvr-post-metafield-opening-hours__breaks-input"
										id="lsvr-post-metafield-opening-hours__breaks-input-1--<?php echo esc_attr( $day['id'] ); ?>"
										name="lsvr-post-metafield-opening-hours__breaks--<?php echo esc_attr( $day['id'] ); ?>"
										value="1"
										<?php if ( 1 === $breaks_count ) { echo ' checked="checked"'; } ?>>
									<span><?php esc_html_e( 'One break', 'lsvr-framework' ); ?></span>
								</label>

								<label for="lsvr-post-metafield-opening-hours__breaks-input-2--<?php echo esc_attr( $day['id'] ); ?>"
									class="lsvr-post-metafield-opening-hours__breaks-item-label">
									<input type="radio"
										class="lsvr-post-metafield-opening-hours__breaks-input"
										id="lsvr-post-metafield-opening-hours__breaks-input-2--<?php echo esc_attr( $day['id'] ); ?>"
										name="lsvr-post-metafield-opening-hours__breaks--<?php echo esc_attr( $day['id'] ); ?>"
										value="2"
										<?php if ( 2 === $breaks_count ) { echo ' checked="checked"'; } ?>>
									<span><?php esc_html_e( 'Two breaks', 'lsvr-framework' ); ?></span>
								</label>

							</div>

							<div class="lsvr-post-metafield-opening-hours__closed">

								<label for="lsvr-post-metafield-opening-hours__checkbox-closed--<?php echo esc_attr( $day['id'] ); ?>"
									class="lsvr-post-metafield-opening-hours__label-closed">
									<input type="checkbox" value="closed"
										class="lsvr-post-metafield-opening-hours__checkbox-closed"
										id="lsvr-post-metafield-opening-hours__checkbox-closed--<?php echo esc_attr( $day['id'] ); ?>"
										<?php if ( true === $is_closed ) { echo ' checked="checked"'; } ?>>
									<span><?php esc_html_e( 'Closed', 'lsvr-framework' ); ?></span>
								</label>

							</div>

						</div>

					<?php endforeach; ?>

				</div>

			</div>

    		<?php
    	}

    }
}

?>