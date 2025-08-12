<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<!-- PRESSVILLE DIRECTORY : begin -->
<section class="<?php echo esc_attr( implode( ' ', $class_arr ) ); ?>"
    <?php echo ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
    <div class="lsvr-pressville-post-grid__inner">
        <div class="lsvr-container">
            <div class="lsvr-pressville-post-grid__content">

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

                                    <a href="<?php echo esc_url( get_term_link( $category_id, 'lsvr_listing_cat' ) ); ?>" class="c-button lsvr-pressville-post-grid__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                                <?php else : ?>

                                    <a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_listing' ) ); ?>" class="c-button lsvr-pressville-post-grid__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                                <?php endif; ?>

                            </p>

                        <?php endif; ?>

                        <?php if ( ! empty( $args['icon'] ) ) : ?>

                            <span class="<?php echo esc_attr( $args['icon'] ); ?> lsvr-pressville-post-grid__icon" aria-hidden="true"></span>

                        <?php endif; ?>

                    </header>

                <?php endif; ?>

                <?php if ( ! empty( $listing_posts ) ) : ?>

                    <div class="lsvr-pressville-post-grid__list-wrapper">

                        <div class="<?php echo esc_attr( $grid_class ); ?> lsvr-pressville-post-grid__list lsvr-pressville-post-grid__list--<?php echo esc_attr( count( $listing_posts ) ); ?>-items<?php if ( true === $enable_slider ) { echo ' lsvr-pressville-post-grid--slider lsvr-pressville-post-grid__list--loading'; } ?>"
                            data-columns-count="<?php echo esc_attr( $args['columns_count'] ); ?>">

                            <?php foreach ( $listing_posts as $listing_post ) : ?>

                                <div class="<?php echo esc_attr( $col_class ); ?> lsvr-pressville-post-grid__item">

                                    <article <?php post_class( 'lsvr-pressville-post-grid__post', $listing_post->ID ); ?>
                                        <?php if ( has_post_thumbnail( $listing_post->ID ) ) { echo ' style="background-image: url( ' . esc_url( get_the_post_thumbnail_url( $listing_post->ID, $thumb_size ) ) . ' );"'; } ?>>
                                        <div class="lsvr-pressville-post-grid__post-inner">
                                            <div class="lsvr-pressville-post-grid__post-bg">

                                                <div class="lsvr-pressville-post-grid__post-content">

                                                    <h3 class="lsvr-pressville-post-grid__post-title">
                                                        <a href="<?php echo esc_url( get_the_permalink( $listing_post->ID ) ); ?>" class="lsvr-pressville-post-grid__post-title-link" rel="bookmark"><?php echo esc_html( $listing_post->post_title ); ?></a>
                                                    </h3>

                                                    <?php if ( lsvr_pressville_toolkit_has_listing_address( $listing_post->ID ) ) : ?>

                                                        <p class="lsvr-pressville-post-grid__post-address">
                                                            <?php lsvr_pressville_toolkit_the_listing_address( $listing_post->ID ); ?>
                                                        </p>

                                                    <?php endif; ?>

                                                </div>

                                                <?php if ( true === $show_category && lsvr_pressville_toolkit_has_post_terms( $listing_post->ID, 'lsvr_listing_cat' ) ) : ?>

                                                    <p class="lsvr-pressville-post-grid__post-badge" title="<?php echo esc_attr( esc_html__( 'Category', 'lsvr-pressville-toolkit' ) ); ?>">
                                                        <span class="lsvr-pressville-post-grid__post-badge-categories"><?php lsvr_pressville_toolkit_the_post_categories( $listing_post->ID, 'lsvr_listing_cat', esc_html__( 'in %s', 'lsvr-pressville-toolkit' ), '', 1 ); ?></span>
                                                    </p>

                                                <?php endif; ?>

                                                <a href="<?php echo esc_url( get_the_permalink( $listing_post->ID ) ); ?>" class="lsvr-pressville-post-grid__post-overlay-link">
                                                    <span class="screen-reader-text"><?php esc_html_e( 'More', 'lsvr-pressville-toolkit' ); ?></span>
                                                </a>

                                            </div>
                                        </div>
                                    </article>

                                </div>

                            <?php endforeach; wp_reset_postdata(); ?>

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

                <?php else : ?>

                    <p class="c-alert-message"><?php esc_html_e( 'There are no posts', 'lsvr-pressville-toolkit' ); ?></p>

                <?php endif; ?>

                <?php if ( ! empty( $args[ 'more_label' ] ) ) : ?>

                    <footer class="lsvr-pressville-post-grid__footer">

                        <p class="lsvr-pressville-post-grid__more lsvr-pressville-post-grid__more--bottom">

                            <?php if ( ! empty( $category_id ) ) : ?>

                                <a href="<?php echo esc_url( get_term_link( $category_id, 'lsvr_listing_cat' ) ); ?>" class="c-button lsvr-pressville-post-grid__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                            <?php else : ?>

                                <a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_listing' ) ); ?>" class="c-button lsvr-pressville-post-grid__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                            <?php endif; ?>

                        </p>

                    </footer>

                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
<!-- PRESSVILLE DIRECTORY : end -->

<?php // TEMPLATE : END
endif; ?>