<?php
// Header menu secondary walker
if ( ! class_exists( 'Lsvr_Pressville_Header_Menu_Secondary_Walker' ) ) {
    class Lsvr_Pressville_Header_Menu_Secondary_Walker extends Walker_Nav_Menu {

        function start_lvl( &$output, $depth = 0, $args = [] ) {
            ob_start(); ?>

        	<ul class="header-menu-secondary__submenu sub-menu header-menu-secondary__submenu--level-<?php echo esc_attr( $depth ); ?>"
                role="menu">

            <?php $output .= ob_get_clean();

        }

        function end_lvl( &$output, $depth = 0, $args = [] ) {
            ob_start(); ?>

        	</ul>

            <?php $output .= ob_get_clean();
        }

        function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
        	ob_start(); ?>

        	<li class="header-menu-secondary__item header-menu-secondary__item--level-<?php echo esc_attr( $depth ); ?> <?php echo ! empty( $item->classes ) ? esc_attr( trim( implode( ' ', $item->classes ) ) ) : ''; ?>"
                role="presentation">

                <a href="<?php echo esc_url( $item->url ); ?>"
                	class="header-menu-secondary__item-link header-menu-secondary__item-link--level-<?php echo esc_attr( $depth ); ?>"
                    role="menuitem"

                    <?php echo ! empty( $item->post_excerpt ) ? ' title="' . esc_attr( $item->post_excerpt ) . '"' : ''; ?>
                	<?php echo ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : ''; ?>>

                    <?php echo esc_html( apply_filters( 'the_title', $item->title, $item->ID ) ); ?></a>

            <?php $output .= ob_get_clean();
        }

        function end_el( &$output, $item, $depth = 0, $args = [] ) {
            ob_start(); ?>

            </li>

            <?php $output .= ob_get_clean();

        }

    }
}
?>