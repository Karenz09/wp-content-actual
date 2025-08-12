<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<!-- PRESSVILLE SITEMAP : begin -->
<section class="<?php echo esc_attr( implode( ' ', $class_arr ) ); ?>"
    <?php echo ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
    <div class="lsvr-pressville-sitemap__inner">

        <div class="lsvr-container">
            <div class="lsvr-pressville-sitemap__content">

                <?php if ( ! empty( $args['menu_id'] ) ) : ?>

                    <?php if ( ! empty( lsvr_pressville_toolkit_get_menu_name_by_id( $args['menu_id'] ) ) ) : ?>

                        <h2 class="screen-reader-text">
                            <?php echo esc_html( lsvr_pressville_toolkit_get_menu_name_by_id( $args['menu_id'] ) ); ?>
                        </h2>

                    <?php endif; ?>

                    <nav class="lsvr-pressville-sitemap__nav lsvr-pressville-sitemap__nav--<?php echo ! empty( $args['columns_count'] ) ? esc_attr( $args['columns_count'] ) : 4; ?>-cols"
                        data-label-expand-popup="<?php echo esc_attr( esc_html__( 'Expand submenu', 'lsvr-pressville-toolkit' ) ); ?>"
                        data-label-collapse-popup="<?php echo esc_attr( esc_html__( 'Collapse submenu', 'lsvr-pressville-toolkit' ) ); ?>">
                        <?php $menu_id = ! empty( $args['menu_id'] ) ? $args['menu_id'] : '';
                        wp_nav_menu(array(
                            'menu' => $menu_id,
                            'container' => '',
                            'menu_class' => 'lsvr-pressville-sitemap__list',
                            'fallback_cb' => '',
                            'items_wrap' => '<ul id="%1$s" class="%2$s" role="menu">%3$s</ul>',
                            'walker' => new Lsvr_Pressville_Sitemap_Walker,
                        )); ?>
                    </nav>

                <?php else : ?>

                    <p class="c-alert-message lsvr-pressville-sitemap__message">
                        <?php esc_html_e( 'Please choose which menu will be used to create this sitemap.', 'lsvr-pressville-toolkit' ); ?>
                    </p>

                <?php endif; ?>

            </div>
        </div>

        <?php if ( ! empty( $bg_image_url ) ) : ?>

            <div class="lsvr-pressville-sitemap__bg" style="background-image: url('<?php echo esc_url( $bg_image_url ); ?>');" aria-hidden="true"></div>

        <?php endif; ?>

    </div>
</section>
<!-- PRESSVILLE SITEMAP : end -->

<?php // TEMPLATE : END
endif; ?>