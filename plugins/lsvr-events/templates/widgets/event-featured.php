<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content lsvr_event-featured-widget__content">

	<?php if ( ! empty( $event_post ) ) : ?>

        <?php // Thumbnail
        if ( has_post_thumbnail( $event_post->ID ) ) : ?>

            <p class="lsvr_event-featured-widget__thumb">
                <a href="<?php echo esc_url( get_permalink( $event_post->ID ) ); ?>" class="lsvr_event-featured-widget__thumb-link">
                    <?php echo get_the_post_thumbnail( $event_post->ID, 'medium' ); ?>
                </a>
            </p>

        <?php endif; ?>

		<div class="lsvr_event-featured-widget__content-inner">

            <?php $event_occurrence = lsvr_events_get_event_featured_occurrence( $event_post->ID );
            if ( ! empty( $event_occurrence ) ) : ?>

    			<h4 class="lsvr_event-featured-widget__title">
    				<a href="<?php echo esc_url( get_permalink( $event_post->ID ) ); ?>" class="lsvr_event-featured-widget__title-link">
    					<?php echo get_the_title( $event_post->ID ); ?>
    				</a>
    			</h4>

                <p class="lsvr_event-featured-widget__date" title="<?php echo esc_attr( esc_html__( 'Event Date', 'lsvr-events' ) ); ?>">
                    <?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $event_occurrence['start'] ) ) ); ?>
                </p>

                <p class="lsvr_event-featured-widget__info">

                    <span class="lsvr_event-featured-widget__time" title="<?php echo esc_attr( esc_html__( 'Event Time', 'lsvr-events' ) ); ?>">

                        <?php // Time
                        lsvr_events_the_event_time( $event_occurrence ); ?>

                    </span>

                    <?php // Location
                    if ( lsvr_events_has_post_terms( $event_occurrence['postid'], 'lsvr_event_location' ) ) : ?>

                        <span class="lsvr_event-featured-widget__location" title="<?php echo esc_attr( esc_html__( 'Event Location', 'lsvr-events' ) ); ?>">
                            <?php echo sprintf( esc_html__( 'at %s', 'lsvr-events' ), lsvr_events_get_post_taxonomy_html( $event_occurrence['postid'], 'lsvr_event_location', '<a href="%s" class="lsvr_event-featured-widget__location-link">%s</a>' ) ); ?>
                        </span>

                    <?php endif; ?>

                </p>

                <?php // Excerpt
                if ( true === $show_excerpt && has_excerpt( $event_post->ID ) ) : ?>

                    <div class="lsvr_event-featured-widget__excerpt">
                        <?php echo wpautop( get_the_excerpt( $event_post->ID ) ); ?>
                    </div>

                <?php endif; ?>

            <?php endif; ?>

            <?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>

                <p class="widget__more">
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_event' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>
                </p>

            <?php endif; ?>

		</div>

	<?php else : ?>

        <p class="widget__no-results"><?php esc_html_e( 'There are no events', 'lsvr-events' ); ?></p>

	<?php endif; ?>

</div>

<?php // TEMPLATE : END
endif; ?>