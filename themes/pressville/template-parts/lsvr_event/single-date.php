<?php // Multi-day event
if ( lsvr_pressville_is_multiday_event( get_the_ID() ) ) : ?>

	<li class="post__info-item post__info-item--date">

		<span class="post__info-item-icon post__info-item-icon--date" aria-hidden="true"></span>

		<h3 class="post__info-item-title is-primary-font"><?php esc_html_e( 'Start', 'pressville' ); ?></h3>
		<p class="post__info-item-text">

			<?php lsvr_pressville_the_event_start_date( get_the_ID() ); ?>

			<?php if ( ! lsvr_pressville_is_allday_event( get_the_ID() ) ) : ?>

				<br><?php lsvr_pressville_the_event_start_time( get_the_ID() ); ?>

			<?php else : ?>

				<br><?php esc_html_e( 'All-day Event', 'pressville' ); ?>

			<?php endif; ?>

		</p>

	</li>

	<li class="post__info-item post__info-item--date">

		<span class="post__info-item-icon post__info-item-icon--date" aria-hidden="true"></span>

		<h3 class="post__info-item-title is-primary-font"><?php esc_html_e( 'End', 'pressville' ); ?></h3>
		<p class="post__info-item-text">

			<?php lsvr_pressville_the_event_end_date( get_the_ID() ); ?>

			<?php if ( ! lsvr_pressville_is_allday_event( get_the_ID() ) && lsvr_pressville_has_event_end_time( get_the_ID() ) ) : ?>

				<br><?php lsvr_pressville_the_event_end_time( get_the_ID() ); ?>

			<?php elseif ( lsvr_pressville_is_allday_event( get_the_ID() ) ) : ?>

				<br><?php esc_html_e( 'All-day Event', 'pressville' ); ?>

			<?php endif; ?>

		</p>

	</li>

<?php // Single-day event
else : ?>

	<li class="post__info-item post__info-item--date">

		<span class="post__info-item-icon post__info-item-icon--date" aria-hidden="true"></span>

		<h3 class="post__info-item-title is-primary-font"><?php esc_html_e( 'Date', 'pressville' ); ?></h3>
		<p class="post__info-item-text">
			<?php lsvr_pressville_the_event_start_date( get_the_ID() ); ?>
		</p>

	</li>

	<li class="post__info-item post__info-item--time">

		<span class="post__info-item-icon post__info-item-icon--time" aria-hidden="true"></span>

		<h3 class="post__info-item-title is-primary-font"><?php esc_html_e( 'Time', 'pressville' ); ?></h3>
		<p class="post__info-item-text">
			<?php lsvr_pressville_the_event_time( get_the_ID(), esc_html__( '%s - %s', 'pressville' ) ); ?>
		</p>

	</li>

<?php endif; ?>