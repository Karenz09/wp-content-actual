<?php if ( lsvr_pressville_has_listing_opening_hours( get_the_ID() ) ) : ?>

	<!-- OPENING HOURS : begin -->
	<div class="post__hours">

		<h2 class="post__hours-title"><?php esc_html_e( 'Opening hours', 'pressville' ); ?></h2>

		<?php if ( 'custom' === get_post_meta( get_the_ID(), 'lsvr_listing_opening_hours', true ) ) : ?>

			<p class="post__hours-custom">
				<?php echo nl2br( wp_kses( get_post_meta( get_the_ID(), 'lsvr_listing_opening_hours_custom', true ), array(
					'a' => array(
						'href' => array(),
						'target' => array(),
					),
					'br' => array(),
					'strong' => array(),
					'span' => array(
						'class' => array(),
						'style' => array(),
					),
				))); ?>
			</p>

		<?php elseif ( 'select' === get_post_meta( get_the_ID(), 'lsvr_listing_opening_hours', true ) ) : $opening_hours = @json_decode( get_post_meta( get_the_ID(), 'lsvr_listing_opening_hours_select', true ) ); ?>

			<?php if ( is_object( $opening_hours ) ) : ?>

				<ul class="post__hours-list">

					<?php foreach ( $opening_hours as $day => $hours ) : ?>

						<li class="post__hours-item post__hours-item--<?php echo strtolower( date( 'D', strtotime( $day ) ) ); ?>">

							<div class="post__hours-item-day">
								<?php echo date_i18n( 'l', strtotime( $day ) ); ?>
							</div>

							<div class="post__hours-item-value">

								<?php if ( 'closed' === $hours ) : ?>

									<?php esc_html_e( 'Closed', 'pressville' ); ?>

								<?php else : foreach ( explode( ',', $hours ) as $hours_parsed ) : $time_from = substr( $hours_parsed, 0, strpos( $hours_parsed, '-' ) ); $time_to = substr( $hours_parsed, strpos( $hours_parsed, '-' ) + 1, strlen( $hours_parsed ) ); ?>

									<span class="post__hours-item-value-from-to">

										<span class="post__hours-item-value-from">
											<?php echo esc_html( date_i18n( get_option( 'time_format' ), strtotime( $time_from ) ) ); ?>
										</span>
										-
										<span class="post__hours-item-value-to">
											<?php echo esc_html( date_i18n( get_option( 'time_format' ), strtotime( $time_to ) ) ); ?>
										</span>

									</span>

								<?php endforeach; endif; ?>

							</div>

						</li>

					<?php endforeach; ?>

				</ul>

				<?php // Note
				if ( ! empty( get_post_meta( get_the_ID(), 'lsvr_listing_opening_hours_note', true ) ) ) : ?>

					<p class="post__hours-note">

						<?php echo nl2br( wp_kses( get_post_meta( get_the_ID(), 'lsvr_listing_opening_hours_note', true ), array(
							'a' => array(
								'href' => array(),
								'target' => array(),
							),
							'br' => array(),
							'strong' => array(),
							'span' => array(
								'class' => array(),
								'style' => array(),
							),
						))); ?>

					</p>

				<?php endif; ?>

			<?php endif; ?>

		<?php endif; ?>

	</div>
	<!-- OPENING HOURS : end -->

<?php endif; ?>