<?php
/**
 * LSVR Pressville Posts Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Pressville_Posts' ) ) {
    class Lsvr_Shortcode_Pressville_Posts {

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
                'columns_count' => 2,
                'enable_dark_bg' => '',
                'enable_slider' => '',
                'thumb_size' => '',
                'exclude_categories' => '',
                'more_label' => '',
                'className' => '',
                'editor_view' => false,
            );

            // Merge default atts with custom atts
            if ( ! empty( apply_filters( 'lsvr_pressville_posts_shortcode_atts', array() ) ) ) {

                $default_atts = array_merge(
                    $default_atts,
                    array_fill_keys( array_column( apply_filters( 'lsvr_pressville_posts_shortcode_atts', array() ), 'name' ), '' )
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

            // Check if dark BG
            $enable_dark_bg = true === $args['enable_dark_bg'] || '1' === $args['enable_dark_bg'] || 'true' === $args['enable_dark_bg'] ? true : false;

            // Check if is slider
            $enable_slider = true === $args['enable_slider'] || '1' === $args['enable_slider'] || 'true' === $args['enable_slider'] ? true : false;

            // Get thumb size
            if ( ! empty( $args['thumb_size'] ) ) {
                $thumb_size = $args['thumb_size'];
            } else {
                $thumb_size = (int) $args['columns_count'] < 4 ? 'large' : 'medium';
            }

            // Element class
            $class_arr = array( 'lsvr-pressville-post-grid lsvr-pressville-post-grid--posts' );
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
                'post_type' => 'post',
            );

            // Get category
            if ( ! empty( $args['category'] ) && is_numeric( $args['category'] ) && (int) $args['category'] > 0 ) {
                $category_id = (int) $args['category'];
            } else if ( ! empty( $args['category'] ) ) {
                $category_id = get_term_by( 'slug', $args['category'], 'category', ARRAY_A );
                $category_id = ! empty( $category_id['term_taxonomy_id'] ) ? $category_id['term_taxonomy_id'] : false;
            } else {
                $category_id = false;
            }

            // Set category
            if ( ! empty( $category_id ) ) {
                $query_args['tax_query'] = array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $category_id,
                    ),
                );
            }

            // Exluded categories
            if ( ! empty( $args['exclude_categories'] ) ) {
                $query_args['category__not_in'] = explode( ',', $args['exclude_categories'] );
            }

            // Get posts
            $posts = new WP_Query( $query_args );
            wp_reset_query();

            // Prepare template vars
            global $lsvr_template_vars;
            $lsvr_template_vars = array(
                'args' => $args,
                'grid_class' => $grid_class,
                'col_class' => $col_class,
                'enable_dark_bg' => $enable_dark_bg,
                'enable_slider' => $enable_slider,
                'thumb_size' => $thumb_size,
                'category_id' => $category_id,
                'blog_posts' => ! empty( $posts->posts ) ? $posts->posts : false,
                'class_arr' => $class_arr,
                'editor_view' => $editor_view,
            );

            ob_start();

            // Load template
            if ( function_exists( 'lsvr_framework_load_template' ) ) {
                lsvr_framework_load_template( apply_filters( 'lsvr_shortcode_pressville_posts_template_path', 'lsvr-pressville-toolkit/templates/shortcodes/pressville-posts.php' ) );
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
                    'default' => esc_html__( 'Latest News', 'lsvr-pressville-toolkit' ),
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
                    'default' => 'icon-newspaper-o',
                    'priority' => 30,
                ),

                // Category
                array(
                    'name' => 'category',
                    'type' => 'taxonomy',
                    'tax' => 'category',
                    'label' => esc_html__( 'Category', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Display posts from a specific category.', 'lsvr-pressville-toolkit' ),
                    'priority' => 40,
                ),

                // More label
                array(
                    'name' => 'more_label',
                    'type' => 'text',
                    'label' => esc_html__( 'More Button Label', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Link to post archive. Leave blank to hide.', 'lsvr-pressville-toolkit' ),
                    'default' => esc_html__( 'More News', 'lsvr-pressville-toolkit' ),
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
                    'label' => esc_html__( 'Number of Posts', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'How many posts should be displayed.', 'lsvr-pressville-toolkit' ),
                    'choices' => array( 0 => esc_html__( 'All', 'lsvr-pressville-toolkit' ) ) + range( 0, 50, 1 ),
                    'default' => 4,
                    'priority' => 70,
                ),

                // Columns count
                array(
                    'name' => 'columns_count',
                    'type' => 'select',
                    'label' => esc_html__( 'Number of Columns', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'How many columns should be used to display posts.', 'lsvr-pressville-toolkit' ),
                    'choices' => array( 1 => 1, 2 => 2, 3 => 3, 4 => 4 ),
                    'default' => 2,
                    'priority' => 80,
                ),

                // Enable dark BG
                array(
                    'name' => 'enable_dark_bg',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Darken Background', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Darken the background color of this element.', 'lsvr-pressville-toolkit' ),
                    'priority' => 90,
                ),

                // Enable slider
                array(
                    'name' => 'enable_slider',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Enable Slider', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Display posts as a slider.', 'lsvr-pressville-toolkit' ),
                    'priority' => 100,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'You can use this ID to style this specific element with custom CSS, for example.', 'lsvr-pressville-toolkit' ),
                    'priority' => 110,
                ),

            ), apply_filters( 'lsvr_pressville_posts_shortcode_atts', array() ) );
        }

    }
}
?>