<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="<?php echo esc_attr( implode( ' ', $class ) ); ?>"
    <?php echo ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
    <div class="lsvr-pricing-table__inner">

        <?php if ( ! empty( $args['title'] ) ) : ?>

            <h3 class="lsvr-pricing-table__title">
                <?php echo wp_kses( $args['title'], array(
                    'a' => array(
                        'href' => array(),
                        'target' => array(),
                    ),
                    'strong' => array(),
                )); ?>
            </h3>

        <?php endif; ?>

        <?php if ( ! empty( $args['price'] ) ) : ?>

            <p class="lsvr-pricing-table__price">
                <span class="lsvr-pricing-table__price-value"><?php echo esc_html( $args['price'] ); ?></span>
                <?php if ( ! empty( $args['price_description'] ) ) : ?>
                    <em class="lsvr-pricing-table__price-description"><?php echo esc_html( $args['price_description'] ); ?></em>
                <?php endif;  ?>
            </p>

        <?php endif;  ?>

        <?php if ( ! empty( $args['text'] ) ) : ?>

            <div class="lsvr-pricing-table__text">
                <?php echo wpautop( wp_kses( $args['text'], array(
                    'a' => array(
                        'href' => array(),
                        'target' => array(),
                    ),
                    'br' => array(),
                    'strong' => array(),
                ))); ?>
            </div>

        <?php endif; ?>

       <?php if ( ! empty( $args['more_label'] ) && ! empty( $args['more_link'] ) ) : ?>

            <p class="lsvr-pricing-table__button">
                <a href="<?php echo esc_url( $args['more_link'] ); ?>" class="lsvr-pricing-table__button-link">
                    <?php echo esc_html( $args['more_label'] ); ?>
                </a>
            </p>

        <?php endif; ?>

    </div>
</div>

<?php // TEMPLATE : END
endif; ?>