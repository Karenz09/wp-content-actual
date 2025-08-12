<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="<?php echo esc_attr( implode( ' ', $class ) ); ?>"
    <?php echo ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
    <div class="lsvr-alert-message__inner">

        <?php if ( ! empty( $args['title'] ) ) : ?>

            <h3 class="lsvr-alert-message__title">

                <?php echo wp_kses( $args['title'], array(
                    'a' => array(
                        'href' => array(),
                        'target' => array(),
                    ),
                )); ?>

            </h3>

        <?php endif; ?>

        <?php if ( ! empty( $args['text'] ) ) : ?>

            <div class="lsvr-alert-message__text">

                <?php echo wpautop( wp_kses( $args['text'], array(
                    'a' => array(
                        'href' => array(),
                        'target' => array(),
                    ),
                    'strong' => '',
                ))); ?>

            </div>

        <?php endif; ?>

    </div>
</div>

<?php // TEMPLATE : END
endif; ?>