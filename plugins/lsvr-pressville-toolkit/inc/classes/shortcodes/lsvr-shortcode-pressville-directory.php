<?php
/**
 * LSVR Pressville Directory Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Pressville_Directory' ) ) {
    class Lsvr_Shortcode_Pressville_Directory {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Prepare default atts
            $default_atts = array(
                'id' => '',
                'title' => '',
                'subtitle' => '',
                'icon' => '',
                'category' => 0,
                'layout' => 'title-top',
                'limit' => 4,
                'order' => 'default',
                'columns_count' => 2,
                'show_category' => '',
                'enable_dark_bg' => '',
                'enable_slider' => '',
                'more_label' => '',
                'className' => '',
                'editor_view' => false,
            );

            // Merge default atts with custom atts
            if ( ! empty( apply_filters( 'lsvr_pressville_directory_shortcode_atts', array() ) ) ) {

                $default_atts = array_merge(
                    $default_atts,
                    array_fill_keys( array_column( apply_filters( 'lsvr_pressville_directory_shortcode_atts', array() ), 'name' ), '' )
                );

            }

            // Merge default atts and received atts
            $args = shortcode_atts(
                $default_atts,
                $atts
            );

            // Prepare grid and cols classes
            $grid_class = 'lsvr-grid lsvr-grid--' . $args['columns_count'] . '-cols';
            $grid_class .= (int) $args['columns_count'] > 1 ? ' lsvr-grid--md-2-cols lsvr-grid--sm-2-cols' : '';
            $col_class = 'lsvr-grid__col lsvr-grid__col--span-' . esc_attr( 12 / (int) $args['columns_count'] );
            $col_class .= (int) $args['columns_count'] > 1 ? ' lsvr-grid__col--md-span-6 lsvr-grid__col--sm-span-6' : '';

            // Check if editor view
            $editor_view = true === $args['editor_view'] || '1' === $args['editor_view'] || 'true' === $args['editor_view'] ? true : false;

            // Check if show category
            $show_category = true === $args['show_category'] || '1' === $args['show_category'] || 'true' === $args['show_category'] ? true : false;

            // Check if dark BG
            $enable_dark_bg = true === $args['enable_dark_bg'] || '1' === $args['enable_dark_bg'] || 'true' === $args['enable_dark_bg'] ? true : false;

            // Check if is slider
            $enable_slider = true === $args['enable_slider'] || '1' === $args['enable_slider'] || 'true' === $args['enable_slider'] ? true : false;

            // Determine thumb size
            $thumb_size = (int) $args['columns_count'] < 4 ? 'large' : 'medium';

            // Element class
            $class_arr = array( 'lsvr-pressville-post-grid lsvr-pressville-post-grid--directory' );
            array_push( $class_arr, 'lsvr-pressville-post-grid--layout-' . $args['layout'] );
            if ( true === $editor_view ) {
                array_push( $class_arr, 'lsvr-pressville-post-grid--editor-view' );
            }
            if ( true === $enable_slider ) {
                array_push( $class_arr, 'lsvr-pressville-post-grid--has-slider' );
            }
            if ( true === $enable_dark_bg ) {
                array_push( $class_arr, 'lsvr-pressville-post-grid--dark-bg' );
            } else {
                array_push( $class_arr, 'lsvr-pressville-post-grid--no-bg' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class_arr, $args['className'] );
            }

            // Prepare query
            $limit = 0 === (int) $args['limit'] ? 1000 : (int) $args['limit'];
            $query_args = array(
                'posts_per_page' => $limit,
                'post_type' => 'lsvr_listing',
            );
            if ( ! empty( $args['order'] ) && 'default' !== $args['order'] ) {
                if ( 'date_desc' == $args['order'] ) {
                    $query_args['orderby'] = 'date';
                    $query_args['order'] = 'DESC';
                }
                elseif ( 'date_asc' == $args['order'] ) {
                    $query_args['orderby'] = 'date';
                    $query_args['order'] = 'ASC';
                }
                elseif ( 'title_asc' == $args['order'] ) {
                    $query_args['orderby'] = 'title';
                    $query_args['order'] = 'ASC';
                }
                elseif ( 'title_desc' == $args['order'] ) {
                    $query_args['orderby'] = 'title';
                    $query_args['order'] = 'DESC';
                }
                elseif ( 'random' == $args['order'] ) {
                    $query_args['orderby'] = 'rand';
                }
            }

            // Get category
            if ( ! empty( $args['category'] ) && is_numeric( $args['category'] ) && (int) $args['category'] > 0 ) {
                $category_id = (int) $args['category'];
            } else if ( ! empty( $args['category'] ) ) {
                $category_id = get_term_by( 'slug', $args['category'], 'lsvr_listing_cat', ARRAY_A );
                $category_id = ! empty( $category_id['term_taxonomy_id'] ) ? $category_id['term_taxonomy_id'] : false;
            } else {
                $category_id = false;
            }

            // Set category
            if ( ! empty( $category_id ) ) {
                $query_args['tax_query'] = array(
                    array(
                        'taxonomy' => 'lsvr_listing_cat',
                        'field' => 'ID',
                        'terms' => array( $category_id ),
                        'operator' => 'IN',
                    ),
                );
            }

            // Get posts
            $posts = get_posts( $query_args );

            // Prepare template vars
            global $lsvr_template_vars;
            $lsvr_template_vars = array(
                'args' => $args,
                'grid_class' => $grid_class,
                'col_class' => $col_class,
                'show_category' => $show_category,
                'enable_dark_bg' => $enable_dark_bg,
                'enable_slider' => $enable_slider,
                'thumb_size' => $thumb_size,
                'category_id' => $category_id,
                'listing_posts' => $posts,
                'class_arr' => $class_arr,
                'editor_view' => $editor_view,
            );

            ob_start();

            // Load template
            if ( function_exists( 'lsvr_framework_load_template' ) ) {
                lsvr_framework_load_template( apply_filters( 'lsvr_shortcode_pressville_directory_template_path', 'lsvr-pressville-toolkit/templates/shortcodes/pressville-directory.php' ) );
            }

            return ob_get_clean();

        }

        // Shortcode params
        public static function lsvr_shortcode_atts() {
            return array_merge( array(

                // Title
                array(
                    'name' => 'title',
                    'type' => 'text',
                    'label' => esc_html__( 'Title', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Title of this section.', 'lsvr-pressville-toolkit' ),
                    'default' => esc_html__( 'Directory', 'lsvr-pressville-toolkit' ),
                    'priority' => 10,
                ),

                // Subtitle
                array(
                    'name' => 'subtitle',
                    'type' => 'text',
                    'label' => esc_html__( 'Subtitle', 'lsvr-pressville-toolkit' ),
                    'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit', 'lsvr-pressville-toolkit' ),
                    'priority' => 20,
                ),

                // Icon
                array(
                    'name' => 'icon',
                    'type' => 'text',
                    'label' => esc_html__( 'Icon', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Class of the icon which will be displayed in element title. Check out the documentation to learn more about icons. Leave blank to hide.', 'lsvr-pressville-toolkit' ),
                    'default' => 'icon-location-map',
                    'priority' => 30,
                ),

                // Category
                array(
                    'name' => 'category',
                    'type' => 'taxonomy',
                    'tax' => 'lsvr_listing_cat',
                    'label' => esc_html__( 'Category', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Display listings from specific category.', 'lsvr-pressville-toolkit' ),
                    'priority' => 40,
                ),

                // More label
                array(
                    'name' => 'more_label',
                    'type' => 'text',
                    'label' => esc_html__( 'More Button Label', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Link to directory archive. Leave blank to hide.', 'lsvr-pressville-toolkit' ),
                    'default' => esc_html__( 'More Listings', 'lsvr-pressville-toolkit' ),
                    'priority' => 50,
                ),

                // Layout
                array(
                    'name' => 'layout',
                    'type' => 'select',
                    'label' => esc_html__( 'Layout', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Choose the layout of this element. Please note that the Title in the Background layout does not display the subtitle and icon on desktops and all layouts are displayed as Title on the Top on small devices.', 'lsvr-pressville-toolkit' ),
                    'choices' => array(
                        'title-top' => esc_html__( 'Title on the Top', 'lsvr-pressville-toolkit' ),
                        'title-left' => esc_html__( 'Title on the Left', 'lsvr-pressville-toolkit' ),
                        'title-bg' => esc_html__( 'Title in the Background', 'lsvr-pressville-toolkit' ),
                    ),
                    'default' => 'title-top',
                    'priority' => 60,
                ),

                // Limit
                array(
                    'name' => 'limit',
                    'type' => 'select',
                    'label' => esc_html__( 'Number of Listings', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'How many listings should be displayed.', 'lsvr-pressville-toolkit' ),
                    'choices' => array( 0 => esc_html__( 'All', 'lsvr-pressville-toolkit' ) ) + range( 0, 50, 1 ),
                    'default' => 4,
                    'priority' => 70,
                ),

                // Order
                array(
                    'name' => 'order',
                    'type' => 'select',
                    'label' => esc_html__( 'Order', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Order of listing posts.', 'lsvr-pressville-toolkit' ),
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'lsvr-pressville-toolkit' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lsvr-pressville-toolkit' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lsvr-pressville-toolkit' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lsvr-pressville-toolkit' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lsvr-pressville-toolkit' ),
                        'random' => esc_html__( 'Random', 'lsvr-pressville-toolkit' ),
                    ),
                    'default' => 'default',
                    'priority' => 80,
                ),

                // Columns count
                array(
                    'name' => 'columns_count',
                    'type' => 'select',
                    'label' => esc_html__( 'Number of Columns', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'How many columns should be used to display listings.', 'lsvr-pressville-toolkit' ),
                    'choices' => array( 1 => 1, 2 => 2, 3 => 3, 4 => 4 ),
                    'default' => 2,
                    'priority' => 90,
                ),

                // Show category
                array(
                    'name' => 'show_category',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Show Category', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Show badge with listing category.', 'lsvr-pressville-toolkit' ),
                    'priority' => 100,
                ),

                // Enable dark BG
                array(
                    'name' => 'enable_dark_bg',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Darken Background', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Darken the background color of this element.', 'lsvr-pressville-toolkit' ),
                    'priority' => 110,
                ),

                // Enable slider
                array(
                    'name' => 'enable_slider',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Enable Slider', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Display listings as a slider.', 'lsvr-pressville-toolkit' ),
                    'priority' => 120,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'You can use this ID to style this specific element with custom CSS, for example.', 'lsvr-pressville-toolkit' ),
                    'priority' => 200,
                ),

            ), apply_filters( 'lsvr_pressville_directory_shortcode_atts', array() ) );
        }

    }
}
?>