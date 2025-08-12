<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content">

	<?php // Local time
	if ( ! empty( $instance['show_time'] ) && true === $show_time ) : ?>

		<div class="lsvr-pressville-weather-widget__time">
			<h4 class="lsvr-pressville-weather-widget__time-title"><?php esc_html_e( 'Local Time', 'lsvr-pressville-toolkit' ); ?></h4>
			<p class="lsvr-pressville-weather-widget__time-value"
				data-timezone="<?php echo esc_attr( get_option( 'timezone_string' ) ); ?>">
				<?php echo current_time( get_option( 'time_format' ) ); ?>
			</p>
		</div>

	<?php endif; ?>

	<?php // Weather
	if ( ! empty( $ajax_params_json ) && false === $editor_view ) : ?>

		<div class="lsvr-pressville-weather-widget__weather lsvr-pressville-weather-widget__weather--loading"
			data-ajax-params="<?php echo esc_attr( $ajax_params_json ); ?>"
			data-forecast-length="<?php echo esc_attr( $ajax_params['forecast_length'] ); ?>">

			<span class="lsvr-pressville-weather-widget__weather-spinner c-spinner" aria-hidden="true"></span>

			<ul class="lsvr-pressville-weather-widget__weather-list" style="display: none;">

				<li class="lsvr-pressville-weather-widget__weather-item lsvr-pressville-weather-widget__weather-item--current">

					<div class="lsvr-pressville-weather-widget__weather-item-labels">
						<h4 class="lsvr-pressville-weather-widget__weather-item-title">
							<?php esc_html_e( 'Today', 'lsvr-pressville-toolkit' ); ?>
						</h4>
						<p class="lsvr-pressville-weather-widget__weather-item-date">
							<?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( current_time( 'mysql' ) ) ) ); ?>
						</p>
					</div>

					<div class="lsvr-pressville-weather-widget__weather-item-values">
						<span class="lsvr-pressville-weather-widget__weather-item-icon" aria-hidden="true"></span>
						<div class="lsvr-pressville-weather-widget__weather-item-temperature"
							title="<?php echo esc_attr( esc_html__( 'Temperature', 'lsvr-pressville-toolkit' ) ); ?>">
							<?php echo 'metric' === $ajax_params['units_format'] ? esc_html__( '&deg;C', 'lsvr-pressville-toolkit' ) : esc_html__( '&deg;F', 'lsvr-pressville-toolkit' ); ?>
						</div>
						<div class="lsvr-pressville-weather-widget__weather-item-wind"
							title="<?php echo esc_attr( esc_html__( 'Wind speed', 'lsvr-pressville-toolkit' ) ); ?>">
							<?php echo 'metric' === $ajax_params['units_format'] ? esc_html__( 'm/s', 'lsvr-pressville-toolkit' ) : esc_html__( 'm/h', 'lsvr-pressville-toolkit' ); ?>
						</div>
					</div>

				</li>

				<?php for ( $i = 1; $i <= $ajax_params['forecast_length']; $i++ ) : ?>

					<li class="lsvr-pressville-weather-widget__weather-item lsvr-pressville-weather-widget__weather-item--forecast lsvr-pressville-weather-widget__weather-item--forecast-<?php echo esc_attr( $i ); ?>"
						data-timestamp="<?php echo esc_attr( strtotime( current_time( 'Y-m-d 12:00:00' ) ) + ( 60 * 60 * ( 24 * ( $i ) ) ) ); ?>">

						<div class="lsvr-pressville-weather-widget__weather-item-labels">
							<h4 class="lsvr-pressville-weather-widget__weather-item-title">
								<?php echo date_i18n( 'l', strtotime( current_time( 'mysql' ) ) + ( 60 * 60 * ( 24 * ( $i ) ) ) ); ?>
							</h4>
							<p class="lsvr-pressville-weather-widget__weather-item-date">
								<?php echo date_i18n( get_option( 'date_format' ), strtotime( current_time( 'mysql' ) ) + ( 60 * 60 * ( 24 * ( $i ) ) ) ); ?>
							</p>
						</div>

						<div class="lsvr-pressville-weather-widget__weather-item-values">
							<span class="lsvr-pressville-weather-widget__weather-item-icon" aria-hidden="true"></span>
							<div class="lsvr-pressville-weather-widget__weather-item-temperature"
								title="<?php echo esc_attr( esc_html__( 'Temperature', 'lsvr-pressville-toolkit' ) ); ?>">
								<?php echo 'metric' === $ajax_params['units_format'] ? esc_html__( '&deg;C', 'lsvr-pressville-toolkit' ) : esc_html__( '&deg;F', 'lsvr-pressville-toolkit' ); ?>
							</div>
							<div class="lsvr-pressville-weather-widget__weather-item-wind"
								title="<?php echo esc_attr( esc_html__( 'Wind speed', 'lsvr-pressville-toolkit' ) ); ?>">
								<?php echo 'metric' === $ajax_params['units_format'] ? esc_html__( 'm/s', 'lsvr-pressville-toolkit' ) : esc_html__( 'm/h', 'lsvr-pressville-toolkit' ); ?>
							</div>
						</div>

					</li>

				<?php endfor; ?>

			</ul>

		</div>

	<?php elseif ( true === $editor_view ) :  ?>

        <p class="c-alert-message lsvr-pressville-weather-widget__message">
            <?php esc_html_e( 'Weather forecast can be displayed on front-end only.', 'lsvr-pressville-toolkit' ); ?>
        </p>

	<?php endif; ?>

	<?php // Bottom text
	if ( ! empty( $instance['bottom_text'] ) ) : ?>

		<div class="lsvr-pressville-weather-widget__text">
			<?php echo wpautop( wp_kses( $instance['bottom_text'], array(
				'a' => array(
					'href' => array(),
					'title' => array(),
					'target' => array(),
				),
				'em' => array(),
				'br' => array(),
				'strong' => array(),
				'p' => array(),
			))); ?>
		</div>

	<?php endif; ?>

</div>

<?php // TEMPLATE : END
endif; ?>