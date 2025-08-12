<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<!-- PRESSVILLE GALLERIES : begin -->
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

                                    <a href="<?php echo esc_url( get_term_link( $category_id, 'lsvr_gallery_cat' ) ); ?>" class="c-button lsvr-pressville-post-grid__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                                <?php else : ?>

                                    <a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_gallery' ) ); ?>" class="c-button lsvr-pressville-post-grid__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                                <?php endif; ?>

                            </p>

                        <?php endif; ?>

                        <?php if ( ! empty( $args['icon'] ) ) : ?>

                            <span class="<?php echo esc_attr( $args['icon'] ); ?> lsvr-pressville-post-grid__icon" aria-hidden="true"></span>

                        <?php endif; ?>

                    </header>

                <?php endif; ?>

                <?php if ( ! empty( $gallery_posts ) ) : ?>

                    <div class="lsvr-pressville-post-grid__list-wrapper">

                        <div class="<?php echo esc_attr( $grid_class ); ?> lsvr-pressville-post-grid__list lsvr-pressville-post-grid__list--<?php echo esc_attr( count( $gallery_posts ) ); ?>-items<?php if ( true === $enable_slider ) { echo ' lsvr-pressville-post-grid--slider lsvr-pressville-post-grid__list--loading'; } ?>"
                            data-columns-count="<?php echo esc_attr( $args['columns_count'] ); ?>">

                            <?php foreach ( $gallery_posts as $gallery_post ) : ?>

                                <div class="<?php echo esc_attr( $col_class ); ?> lsvr-pressville-post-grid__item">

                                    <article <?php post_class( 'lsvr-pressville-post-grid__post', $gallery_post->ID ); ?>
                                        <?php if ( has_post_thumbnail( $gallery_post->ID ) ) { echo ' style="background-image: url( ' . esc_url( get_the_post_thumbnail_url( $gallery_post->ID, $thumb_size ) ) . ' );"'; } ?>>
                                        <div class="lsvr-pressville-post-grid__post-inner">
                                            <div class="lsvr-pressville-post-grid__post-bg">

                                                <div class="lsvr-pressville-post-grid__post-content">

                                                    <h3 class="lsvr-pressville-post-grid__post-title">
                                                        <a href="<?php echo esc_url( get_the_permalink( $gallery_post->ID ) ); ?>" class="lsvr-pressville-post-grid__post-title-link" rel="bookmark"><?php echo esc_html( $gallery_post->post_title ); ?></a>
                                                    </h3>

                                                </div>

                                                <p class="lsvr-pressville-post-grid__post-meta">

                                                    <span class="lsvr-pressville-post-grid__post-meta-date" role="group"><?php echo get_the_date( get_option( 'date_format' ), $gallery_post->ID ); ?></span>

                                                    <?php if ( lsvr_pressville_toolkit_has_post_terms( $gallery_post->ID, 'lsvr_gallery_cat' ) ) : ?>
                                                        <span class="lsvr-pressville-post-grid__post-meta-categories" role="group"><?php lsvr_pressville_toolkit_the_post_categories( $gallery_post->ID, 'lsvr_gallery_cat', esc_html__( 'in %s', 'pressville' ) ); ?></span>
                                                    <?php endif; ?>

                                                    <span class="lsvr-pressville-post-grid__post-meta-images-count"><?php echo esc_html( sprintf( _n( '%d image', '%d images', lsvr_pressville_toolkit_get_gallery_images_count( $gallery_post->ID ), 'lsvr-pressville-toolkit' ), lsvr_pressville_toolkit_get_gallery_images_count( $gallery_post->ID ) ) ); ?></span>

                                                </p>

                                                <a href="<?php echo esc_url( get_the_permalink( $gallery_post->ID ) ); ?>" class="lsvr-pressville-post-grid__post-overlay-link">
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

                                <a href="<?php echo esc_url( get_term_link( $category_id, 'lsvr_gallery_cat' ) ); ?>" class="c-button lsvr-pressville-post-grid__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                            <?php else : ?>

                                <a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_gallery' ) ); ?>" class="c-button lsvr-pressville-post-grid__more-link"><?php echo esc_html( $args[ 'more_label' ] ); ?></a>

                            <?php endif; ?>

                        </p>

                    </footer>

                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
<!-- PRESSVILLE GALLERIES : end -->

<?php // TEMPLATE : END
endif; ?>