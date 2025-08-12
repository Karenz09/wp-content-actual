<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content">

	<?php if ( ! empty( $event_posts['occurrences'] ) ) : ?>

		<ul class="lsvr_event-list-widget__list<?php if ( true === $bold_date ) { echo ' lsvr_event-list-widget__list--has-bold-date'; } ?>">

    		<?php foreach ( $event_posts['occurrences'] as $event_occurrence ) : ?>

    			<li class="lsvr_event-list-widget__item<?php if ( has_post_thumbnail( $event_occurrence['postid'] ) ) { echo ' lsvr_event-list-widget__item--has-thumb'; } ?>">

        			<?php // Thumbnail
        			if ( has_post_thumbnail( $event_occurrence['postid'] ) && ! $bold_date ) : ?>

        				<p class="lsvr_event-list-widget__item-thumb">
        					<a href="<?php echo esc_url( get_permalink( $event_occurrence['postid'] ) ); ?>" class="lsvr_event-list-widget__item-thumb-link">
        						<?php echo get_the_post_thumbnail( $event_occurrence['postid'], 'thumbnail' ); ?>
        					</a>
        				</p>

        			<?php // Bold date
        			elseif ( true === $bold_date ) : ?>

						<p class="lsvr_event-list-widget__item-date lsvr_event-list-widget__item-date--bold"
							title="<?php echo esc_attr( date_i18n( get_option( 'date_format' ), strtotime( $event_occurrence['start'] ) ) ); ?>">
							<span class="lsvr_event-list-widget__item-date-month" aria-hidden="true"><?php echo date_i18n( 'M', strtotime( $event_occurrence['start'] ) ); ?></span>
							<span class="lsvr_event-list-widget__item-date-day" aria-hidden="true"><?php echo date_i18n( 'j', strtotime( $event_occurrence['start'] ) ); ?></span>
						</p>

        			<?php endif; ?>

        			<h4 class="lsvr_event-list-widget__item-title">
        				<a href="<?php echo esc_url( get_permalink( $event_occurrence['postid'] ) ); ?>" class="lsvr_event-list-widget__item-title-link">
        					<?php echo get_the_title( $event_occurrence['postid'] ); ?>
        				</a>
        			</h4>

    				<?php // Date
    				if ( ! $bold_date ) : ?>

						<p class="lsvr_event-list-widget__item-date" title="<?php echo esc_attr( esc_html__( 'Event Date', 'lsvr-events' ) ); ?>">
							<?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $event_occurrence['start'] ) ) ); ?>
						</p>

					<?php endif; ?>

        			<p class="lsvr_event-list-widget__item-info">

						<span class="lsvr_event-list-widget__item-time" title="<?php echo esc_attr( esc_html__( 'Event Time', 'lsvr-events' ) ); ?>">

	                        <?php // Time
	                        lsvr_events_the_event_time( $event_occurrence ); ?>

						</span>

	                    <?php // Location
	                    if ( lsvr_events_has_post_terms( $event_occurrence['postid'], 'lsvr_event_location' ) ) : ?>

	                        <span class="lsvr_event-list-widget__item-location" title="<?php echo esc_attr( esc_html__( 'Event Location', 'lsvr-events' ) ); ?>">
	                            <?php echo sprintf( esc_html__( 'at %s', 'lsvr-events' ), lsvr_events_get_post_taxonomy_html( $event_occurrence['postid'], 'lsvr_event_location', '<a href="%s" class="lsvr_event-list-widget__item-location-link">%s</a>' ) ); ?>
	                        </span>

	                    <?php endif; ?>

					</p>

    			</li>

    		<?php endforeach; ?>

		</ul>

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

	<?php else : ?>

		<p class="widget__no-results"><?php esc_html_e( 'There are no events', 'lsvr-events' ); ?></p>

	<?php endif; ?>

</div>

<?php // TEMPLATE : END
endif; ?>