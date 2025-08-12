<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<a href="<?php echo esc_url( $args['link'] ); ?>"
    class="<?php echo esc_attr( implode( ' ', $class ) ); ?>"
    <?php echo true === $open_in_new_window ? ' target="_blank"' : ''; ?>
    <?php echo ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
    <?php echo esc_html( $args['label'] ); ?>
</a>

<?php // TEMPLATE : END
endif; ?>