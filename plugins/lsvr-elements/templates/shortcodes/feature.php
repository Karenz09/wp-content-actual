<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="<?php echo esc_attr( implode( ' ', $class ) ); ?>"
    <?php echo ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
    <div class="lsvr-feature__inner">

        <?php if ( ! empty( $args['icon'] ) ) : ?>

            <span class="lsvr-feature__icon <?php echo esc_attr( $args['icon'] ); ?>" aria-hidden="true"></span>

        <?php endif; ?>

        <?php if ( ! empty( $args['title'] ) && ! empty( $args['title_link'] ) ) : ?>

            <h3 class="lsvr-feature__title">
                <a href="<?php echo esc_url( $args['title_link'] ); ?>"
                    class="lsvr-feature__title-link"><?php echo esc_html( $args['title'] ); ?></a>
            </h3>

        <?php elseif ( ! empty( $args['title'] ) ) : ?>

            <h3 class="lsvr-feature__title">
                <?php echo esc_html( $args['title'] ); ?>
            </h3>

        <?php endif; ?>

        <?php if ( ! empty( $args['text'] ) ) : ?>

            <div class="lsvr-feature__text">

                <?php echo wpautop( wp_kses( $args['text'], array(
                    'a' => array(
                        'href' => array(),
                    ),
                    'strong' => array(),
                )));
                ?>

            </div>

        <?php endif; ?>

        <?php if ( ! empty( $args['more_label'] ) && ! empty( $args['more_link'] ) ) : ?>

            <p class="lsvr-feature__more">
                <a href="<?php echo esc_url( $args['more_link'] ); ?>"
                    class="lsvr-feature__more-link"><?php echo esc_html( $args['more_label'] ); ?></a>
            </p>

        <?php endif; ?>

    </div>
</div>

<?php // TEMPLATE : END
endif; ?>