<?php
// Sitemap section walker
if ( ! class_exists( 'Lsvr_Pressville_Sitemap_Walker' ) ) {
    class Lsvr_Pressville_Sitemap_Walker extends Walker_Nav_Menu {

        private $lsvr_current_item_id;

        function start_lvl( &$output, $depth = 0, $args = [] ) {
            ob_start(); ?>

            <?php if ( $depth > 0 ) : ?>

                <button id="lsvr-pressville-sitemap__toggle-<?php echo esc_attr( $this->lsvr_current_item_id ); ?>"
                    class="lsvr-pressville-sitemap__toggle lsvr-pressville-sitemap__toggle--level-<?php echo esc_attr( $depth ); ?>" type="button"
                    title="<?php echo esc_attr( esc_html__( 'Expand submenu', 'lsvr-pressville-toolkit' ) ); ?>"
                    aria-controls="lsvr-pressville-sitemap__submenu-<?php echo esc_attr( $this->lsvr_current_item_id ); ?>"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <span class="lsvr-pressville-sitemap__toggle-icon" aria-hidden="true"></span>
                </button>

            <?php endif; ?>

            <ul id="lsvr-pressville-sitemap__submenu-<?php echo esc_attr( $this->lsvr_current_item_id ); ?>"
                class="lsvr-pressville-sitemap__submenu lsvr-pressville-sitemap__submenu--level-<?php echo esc_attr( $depth ); ?>"
                aria-labelledby="lsvr-pressville-sitemap__item-link-<?php echo esc_attr( $this->lsvr_current_item_id ); ?>"
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

            <li id="lsvr-pressville-sitemap__item-<?php echo esc_attr( $item->ID ); ?>"
                class="lsvr-pressville-sitemap__item lsvr-pressville-sitemap__item--level-<?php echo esc_attr( $depth ); ?> <?php echo ! empty( $item->classes ) ? esc_attr( trim( implode( ' ', $item->classes ) ) ) : ''; ?>"
                role="presentation">

                <?php if ( 0 === $depth ) : ?>
                    <h3 class="lsvr-pressville-sitemap__item-title">
                <?php endif; ?>

                <a href="<?php echo esc_url( $item->url ); ?>"
                    id="lsvr-pressville-sitemap__item-link-<?php echo esc_attr( $item->ID ); ?>"
                    class="lsvr-pressville-sitemap__item-link lsvr-pressville-sitemap__item-link--level-<?php echo esc_attr( $depth ); ?>"
                    role="menuitem"

                    <?php if ( in_array( 'menu-item-has-children', $item->classes ) ) : ?>

                        aria-owns="lsvr-pressville-sitemap__submenu-<?php echo esc_attr( $item->ID ); ?>"
                        aria-controls="lsvr-pressville-sitemap__submenu-<?php echo esc_attr( $item->ID ); ?>"
                        aria-haspopup="true"
                        aria-expanded="false"

                    <?php endif; ?>

                    <?php echo ! empty( $item->post_excerpt ) ? ' title="' . esc_attr( $item->post_excerpt ) . '"' : ''; ?>
                    <?php echo ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : ''; ?>>

                    <?php echo esc_html( $item->title ); ?></a>

                <?php if ( 0 === $depth ) : ?>
                    </h3>
                <?php endif; ?>

                <?php if ( 0 === $depth && ! empty( trim( $item->post_content ) ) ) : ?>

                    <p class="lsvr-pressville-sitemap__item-description" role="presentation">
                        <?php echo wp_kses( $item->post_content, array(
                            'a' => array(
                                'href' => array(),
                            ),
                            'br' => array(),
                            'strong' => array(),
                        )); ?>
                    </p>

                <?php endif; ?>

            <?php $output .= ob_get_clean();
        }

        function end_el( &$output, $item, $depth = 0, $args = [] ) {
            ob_start(); ?>

            </li>

            <?php $output .= ob_get_clean();

        }

    }
}