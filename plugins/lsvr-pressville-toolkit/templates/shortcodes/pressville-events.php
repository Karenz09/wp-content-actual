<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<!-- PRESSVILLE EVENTS : begin -->
<section class="<?php echo esc_attr( implode( ' ', $class_arr ) ); ?>"
    <?php echo ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
    <div class="lsvr-pressville-post-grid__inner">
        <div class="lsvr-container">
            <div class="lsvr-pressville-post-grid__content">

                <?php if ( ! empty( $event_occurrences ) ) : ?>

                    <?php if ( ! empty( $args['title'] ) || ! empty( $args['subtitle'] ) ) : ?>

                        <header class="lsvr-pressville-post-grid__header">

                            <?php if ( ! empty( $args['title'] ) ) : ?>

                                <h2 class="lsvr-pressville-post-grid__title"><?php echo esc_html( $args['title'] ); ?></h2>

                            <?php endif; ?>

                            <?php if ( ! empty( $args['subtitle'] ) ) : ?>

                                <p class="lsvr-pressville-post-grid__subtitle"><?php echo esc_html( $args['subtitle'] ); ?></p>

                            <?php endif; ?>

                            <?php if ( ! empty( $args[ 'more_label' ] ) && 'title-left' === $args['layout'] ) : ?>

                                <p class="lsvr-pressville-post-grid__more lsvr-pressville-post-grid__more--top">

                                    <?php if ( ! empty( $category_id ) ) : ?>

                                        <a href="<?php echo esc_url( get_term_link( $category_id, 'lsvr_event_cat' ) ); ?>" class="c-button lsvr-pressville-post-grid__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                                    <?php else : ?>

                                        <a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_event' ) ); ?>" class="c-button lsvr-pressville-post-grid__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                                    <?php endif; ?>

                                </p>

                            <?php endif; ?>

                            <?php if ( ! empty( $args['icon'] ) ) : ?>

                                <span class="<?php echo esc_attr( $args['icon'] ); ?> lsvr-pressville-post-grid__icon" aria-hidden="true"></span>

                            <?php endif; ?>

                        </header>

                    <?php endif; ?>

                    <div class="lsvr-pressville-post-grid__list-wrapper">

                        <div class="<?php echo esc_attr( $grid_class ); ?> lsvr-pressville-post-grid__list lsvr-pressville-post-grid__list--<?php echo esc_attr( count( $event_occurrences ) ); ?>-items<?php if ( true === $enable_slider ) { echo ' lsvr-pressville-post-grid__list--slider lsvr-pressville-post-grid__list--loading'; } ?>" data-columns-count="<?php echo esc_attr( $args['columns_count'] ); ?>">

                            <?php foreach ( $event_occurrences as $event_occurrence ) : ?>

                                <div class="<?php echo esc_attr( $col_class ); ?> lsvr-pressville-post-grid__item">

                                    <article <?php lsvr_pressville_toolkit_the_event_post_class( $event_occurrence['postid'], 'lsvr-pressville-post-grid__post' ); ?>
                                        <?php if ( has_post_thumbnail( $event_occurrence['postid'] ) ) { echo ' style="background-image: url( ' . esc_url( get_the_post_thumbnail_url( $event_occurrence['postid'], $thumb_size ) ). ' );"'; } ?>>
                                        <div class="lsvr-pressville-post-grid__post-inner">
                                            <div class="lsvr-pressville-post-grid__post-bg">

                                                <p class="lsvr-pressville-post-grid__post-badge lsvr-pressville-post-grid__post-badge--date"
                                                    title="<?php echo esc_attr( date_i18n( get_option( 'date_format' ), strtotime( $event_occurrence['start'] ) ) ); ?>">
                                                    <span class="is-secondary-font lsvr-pressville-post-grid__post-badge-day" aria-hidden="true"><?php echo esc_html( date_i18n( 'j', strtotime( $event_occurrence['start'] ) ) ); ?></span>
                                                    <span class="is-secondary-font lsvr-pressville-post-grid__post-badge-month" aria-hidden="true"><?php echo esc_html( date_i18n( 'M', strtotime( $event_occurrence['start'] ) ) ); ?></span>
                                                </p>

                                                <div class="lsvr-pressville-post-grid__post-content">

                                                    <h3 class="lsvr-pressville-post-grid__post-title">
                                                        <a href="<?php echo get_permalink( $event_occurrence['postid'] ); ?>" class="lsvr-pressville-post-grid__post-title-link" rel="bookmark"><?php echo esc_html( get_the_title( $event_occurrence['postid'] ) ); ?></a>
                                                    </h3>

                                                    <p class="lsvr-pressville-post-grid__post-meta">

                                                        <span class="lsvr-pressville-post-grid__post-meta-time" title="<?php echo esc_attr( esc_html__( 'Event Time', 'lsvr-pressville-toolkit' ) ); ?>"><?php lsvr_pressville_toolkit_the_event_archive_time( $event_occurrence, esc_html__( '%s - %s', 'lsvr-pressville-toolkit' ) ); ?></span>

                                                        <?php if ( lsvr_pressville_toolkit_has_post_terms( $event_occurrence['postid'], 'lsvr_listing_location' ) ) : ?>

                                                            <span class="lsvr-pressville-post-grid__post-meta-location" title="<?php echo esc_attr( esc_html__( 'Event Location', 'lsvr-pressville-toolkit' ) ); ?>"><?php lsvr_pressville_toolkit_the_event_location_linked( $event_occurrence['postid'], esc_html__( 'at %s', 'lsvr-pressville-toolkit' ) ); ?></span>

                                                        <?php endif; ?>

                                                    </p>

                                                </div>

                                                <a href="<?php echo esc_url( get_the_permalink( $event_occurrence['postid'] ) ); ?>" class="lsvr-pressville-post-grid__post-overlay-link">
                                                    <span class="screen-reader-text"><?php esc_html_e( 'More', 'lsvr-pressville-toolkit' ); ?></span>
                                                </a>

                                            </div>
                                        </div>
                                    </article>

                                </div>

                            <?php endforeach; ?>

                        </div>

                        <?php if ( true === $enable_slider && false === $editor_view ) : ?>

                            <button type="button" class="c-arrow-button lsvr-pressville-post-grid__list-button lsvr-pressville-post-grid__list-button--prev"
                                aria-hidden="true" title="<?php echo esc_attr( esc_html__( 'Previous', 'lsvr-pressville-toolkit' ) ); ?>">
                                <span class="c-arrow-button__icon c-arrow-button__icon--left" aria-hidden="true"></span>
                            </button>

                            <button type="button" class="c-arrow-button lsvr-pressville-post-grid__list-button lsvr-pressville-post-grid__list-button--next"
                                aria-hidden="true" title="<?php echo esc_attr( esc_html__( 'Next', 'lsvr-pressville-toolkit' ) ); ?>">
                                <span class="c-arrow-button__icon c-arrow-button__icon--right" aria-hidden="true"></span>
                            </button>

                        <?php endif; ?>

                    </div>

                    <?php if ( ! empty( $args[ 'more_label' ] ) ) : ?>

                        <footer class="lsvr-pressville-post-grid__footer">

                            <p class="lsvr-pressville-post-grid__more lsvr-pressville-post-grid__more--bottom">

                                <?php if ( ! empty( $category_id ) ) : ?>

                                    <a href="<?php echo esc_url( get_term_link( $category_id, 'lsvr_event_cat' ) ); ?>" class="c-button lsvr-pressville-post-grid__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                                <?php else : ?>

                                    <a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_event' ) ); ?>" class="c-button lsvr-pressville-post-grid__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                                <?php endif; ?>

                            </p>

                        </footer>

                    <?php endif; ?>

                <?php else : ?>

                    <p class="c-alert-message"><?php esc_html_e( 'There are no events', 'lsvr-pressville-toolkit' ); ?></p>

                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
<!-- PRESSVILLE EVENTS : end -->

<?php // TEMPLATE : END
endif; ?>