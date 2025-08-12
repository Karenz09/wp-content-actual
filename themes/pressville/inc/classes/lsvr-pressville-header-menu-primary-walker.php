<?php
// Header menu primary walker
if ( ! class_exists( 'Lsvr_Pressville_Header_Menu_Primary_Walker' ) ) {
    class Lsvr_Pressville_Header_Menu_Primary_Walker extends Walker_Nav_Menu {

        private $lsvr_current_item_id;
        
        function start_lvl( &$output, $depth = 0, $args = [] ) {
            ob_start(); ?>

            <button id="header-menu-primary__submenu-toggle-<?php echo esc_attr( $this->lsvr_current_item_id ); ?>"
                class="header-menu-primary__submenu-toggle header-menu-primary__submenu-toggle--level-<?php echo esc_attr( $depth ); ?>" type="button"
                title="<?php echo esc_attr( esc_html__( 'Expand submenu', 'pressville' ) ); ?>"
                aria-controls="header-menu-primary__submenu-<?php echo esc_attr( $this->lsvr_current_item_id ); ?>"
                aria-haspopup="true"
                aria-expanded="false">
                <span class="header-menu-primary__submenu-toggle-icon" aria-hidden="true"></span>
            </button>

        	<ul id="header-menu-primary__submenu-<?php echo esc_attr( $this->lsvr_current_item_id ); ?>"
                class="header-menu-primary__submenu sub-menu header-menu-primary__submenu--level-<?php echo esc_attr( $depth ); ?>"
                aria-labelledby="header-menu-primary__item-link-<?php echo esc_attr( $this->lsvr_current_item_id ); ?>"
                aria-expanded="false"
                role="menu">

            <?php $output .= ob_get_clean();

        }

        function end_lvl( &$output, $depth = 0, $args = [] ) {
            ob_start(); ?>

        	</ul>

            <?php $output .= ob_get_clean();
        }

        function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
            $this->lsvr_current_item_id = $item->ID;
        	ob_start(); ?>

            <?php if ( 0 === $depth && ! empty( $item->classes ) && in_array( 'lsvr-megamenu', $item->classes ) ) {
                $item->classes[] = 'header-menu-primary__item--megamenu';
            } elseif ( 0 === $depth ) {
                $item->classes[] = 'header-menu-primary__item--dropdown';
            } ?>

        	<li id="header-menu-primary__item-<?php echo esc_attr( $item->ID ); ?>"
                class="header-menu-primary__item header-menu-primary__item--level-<?php echo esc_attr( $depth ); ?> <?php echo ! empty( $item->classes ) ? esc_attr( trim( implode( ' ', $item->classes ) ) ) : ''; ?>"
                role="presentation">

                <a href="<?php echo esc_url( $item->url ); ?>"
                    id="header-menu-primary__item-link-<?php echo esc_attr( $item->ID ); ?>"
                	class="header-menu-primary__item-link header-menu-primary__item-link--level-<?php echo esc_attr( $depth ); ?>"
                    role="menuitem"

                    <?php if ( in_array( 'menu-item-has-children', $item->classes ) ) : ?>

                        aria-owns="header-menu-primary__submenu-<?php echo esc_attr( $item->ID ); ?>"
                        aria-controls="header-menu-primary__submenu-<?php echo esc_attr( $item->ID ); ?>"
                        aria-haspopup="true"
                        aria-expanded="false"

                    <?php endif; ?>

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