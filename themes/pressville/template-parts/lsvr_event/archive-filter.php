<?php if ( true === get_theme_mod( 'lsvr_event_archive_filter_enable', true ) ) : ?>

	<!-- POST FILTER : begin -->
	<div class="post-archive-filter">
		<div class="post-archive-filter__inner">

			<?php // Add custom code before form
			do_action( 'lsvr_pressville_event_archive_filter_form_before' ); ?>

			<!-- FILTER FORM : begin -->
			<form class="post-archive-filter__form" method="get"
				action="<?php echo esc_url( lsvr_pressville_get_event_archive_filter_form_action() ); ?>">
				<div class="post-archive-filter__form-inner">

					<?php // Add custom code before form fields
					do_action( 'lsvr_pressville_event_archive_filter_form_fields_before' ); ?>

					<!-- DATE FROM : begin -->
					<p class="post-archive-filter__option post-archive-filter__option--datepicker post-archive-filter__option--date-from">

						<label for="post-archive-filter__date-from" class="post-archive-filter__label"><?php esc_html_e( 'Date from:', 'pressville' ); ?></label>
						<input type="text" class="post-archive-filter__input post-archive-filter__input--datepicker"
							name="date_from" id="post-archive-filter__date-from"
							placeholder="<?php esc_html_e( 'Choose Date', 'pressville' ); ?>"

							<?php if ( isset( $_GET['date_from'] ) ) : ?>

								value="<?php echo preg_replace( '/[^0-9-]/', '', $_GET['date_from'] ); ?>"

							<?php endif; ?>>

					</p>
					<!-- DATE FROM : end -->

					<!-- DATE TO : begin -->
					<p class="post-archive-filter__option post-archive-filter__option--datepicker post-archive-filter__option--date-to">

						<label for="post-archive-filter__date-to" class="post-archive-filter__label"><?php esc_html_e( 'Date to:', 'pressville' ); ?></label>
						<input type="text" class="post-archive-filter__input post-archive-filter__input--datepicker"
							name="date_to" id="post-archive-filter__date-to"
							placeholder="<?php esc_html_e( 'Choose Date', 'pressville' ); ?>"

							<?php if ( isset( $_GET['date_to'] ) ) : ?>

								value="<?php echo preg_replace( '/[^0-9-]/', '', $_GET['date_to'] ); ?>"

							<?php endif; ?>>

					</p>
					<!-- DATE to : end -->

					<?php // Add custom code before form submit
					do_action( 'lsvr_pressville_event_archive_filter_form_submit_before' ); ?>

					<!-- SUBMIT : begin -->
					<p class="post-archive-filter__submit">

						<button type="submit" class="post-archive-filter__submit-button">
							<?php esc_html_e( 'Filter', 'pressville' ); ?>
						</button>

					</p>
					<!-- SUBMIT : end -->

					<!-- RESET : begin -->
					<p class="post-archive-filter__reset">

						<button type="button" class="post-archive-filter__reset-button">
							<?php esc_html_e( 'Reset filter', 'pressville' ); ?>
						</button>

					</p>
					<!-- RESET : end -->

					<?php // Add custom code after form submit
					do_action( 'lsvr_pressville_event_archive_filter_form_submit_after' ); ?>

				</div>
			</form>
			<!-- FILTER FORM : end -->

			<?php // Add custom code after form
			do_action( 'lsvr_pressville_event_archive_filter_form_after' ); ?>

		</div>
	</div>
	<!-- POST FILTER : end -->

<?php endif; ?>