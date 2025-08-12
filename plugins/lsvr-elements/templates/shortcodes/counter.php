<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="<?php echo esc_attr( implode( ' ', $class ) ); ?>"
    <?php echo ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
    <div class="lsvr-counter__inner">

        <?php if ( ! empty( $args['number_unit'] ) ) : ?>

            <h3 class="lsvr-counter__number">
                <?php echo esc_html( $args['number'] ); ?><span class="lsvr-counter__number-unit"><?php echo esc_html( $args['number_unit'] ); ?></span>
            </h3>

        <?php else : ?>

            <h3 class="lsvr-counter__number">
                <?php echo esc_html( $args['number'] ); ?>
            </h3>

        <?php endif; ?>

        <?php if ( ! empty( $args['label'] ) ) : ?>

            <p class="lsvr-counter__label">
                <?php echo wp_kses( $args['label'], array(
                    'a' => array(
                        'href' => '',
                    ),
                    'strong' => array(),
                )); ?>
            </p>

        <?php endif; ?>

    </div>
</div>

<?php // TEMPLATE : END
endif; ?>