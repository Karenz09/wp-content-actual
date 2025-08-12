<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="<?php echo esc_attr( implode( ' ', $class ) ); ?>"
    <?php echo ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
    <div class="lsvr-progress-bar__inner">

        <?php if ( ! empty( $args['title'] ) ) : ?>

            <h3 class="lsvr-progress-bar__title">
                <?php echo esc_html( $args['title'] ); ?>
            </h3>

        <?php endif; ?>

        <?php if ( ! empty( $args['percentage'] ) ) : ?>

            <div class="lsvr-progress-bar__bar">
                <div class="lsvr-progress-bar__bar-inner" data-percentage="<?php echo esc_attr( (int) $args['percentage'] ); ?>"
                    style="width: <?php echo esc_attr( (int) $args['percentage'] > 100 ? 100 : (int) $args['percentage'] ); ?>%"></div>

                <?php if ( ! empty( $args['label'] ) ) : ?>
                    <span class="lsvr-progress-bar__bar-label"><?php echo esc_html( $args['label'] ); ?></span>
                <?php endif; ?>

            </div>

        <?php endif; ?>

    </div>
</div>

<?php // TEMPLATE : END
endif; ?>