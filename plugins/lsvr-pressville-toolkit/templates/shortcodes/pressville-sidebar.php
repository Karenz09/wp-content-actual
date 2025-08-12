<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<!-- PRESSVILLE SIDEBAR : begin -->
<section class="<?php echo esc_attr( implode( ' ', $class_arr ) ); ?>"
    <?php echo ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
    <div class="lsvr-pressville-sidebar__bg">
        <div class="lsvr-container">
            <div class="lsvr-pressville-sidebar__inner">

                <?php if ( ! empty( $args['sidebar_id'] ) && is_active_sidebar( $args['sidebar_id'] ) ) : ?>

                    <div class="lsvr-pressville-sidebar__grid lsvr-pressville-sidebar__grid--<?php echo ! empty( $args['columns_count'] ) ? esc_attr( $args['columns_count'] ) : 4; ?>-cols">
                        <?php dynamic_sidebar( $args['sidebar_id'] ); ?>
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
<!-- PRESSVILLE SIDEBAR : end -->

<?php // TEMPLATE : END
endif; ?>