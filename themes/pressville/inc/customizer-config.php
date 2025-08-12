<?php
/**
 * WordPress customizer settings
 */
add_action( 'customize_register', 'lsvr_pressville_customize_register' );
if ( ! function_exists( 'lsvr_pressville_customize_register' ) ) {
    function lsvr_pressville_customize_register( $wp_customize ) {

        // Init the LSVR Customizer object
        if ( class_exists( 'Lsvr_Customizer' ) ) {

            $lsvr_customizer = new Lsvr_Customizer( $wp_customize, 'lsvr_pressville_' );

            // Change order of default sections
            $wp_customize->get_section( 'static_front_page' )->priority = 117;
            $wp_customize->get_section( 'custom_css' )->priority = 300;

            // Header
            $lsvr_customizer->add_section( 'header_settings', array(
                'title' => esc_html__( 'Header', 'pressville' ),
                'priority' => 101,
            ));

                // Default background Image
                $lsvr_customizer->add_field( 'header_background_image', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Default Background Image', 'pressville' ),
                    'description' => esc_html__( 'Optimal resolution is about 2000x1000px or more.', 'pressville' ),
                    'type' => 'image',
                    'priority' => 1010,
                ));

                // Background type
                $lsvr_customizer->add_field( 'header_background_type', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Background Type', 'pressville' ),
                    'description' => esc_html__( 'Background can be created as a single image (Default Background Image will be used), slide show with multiple images, or a random image (randomized when loading a page).', 'pressville' ),
                    'type' => 'radio',
                    'choices' => array(
                        'single' => esc_html__( 'Single Image', 'pressville' ),
                        'slideshow' => esc_html__( 'Image Slideshow', 'pressville' ),
                        'slideshow-home' => esc_html__( 'Image Slideshow (Homepage Only)', 'pressville' ),
                        'random' => esc_html__( 'Random Image', 'pressville' ),
                    ),
                    'default' => 'single',
                    'priority' => 1020,
                ));

                // Background Image 2
                $lsvr_customizer->add_field( 'header_background_image_2', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Background Image 2', 'pressville' ),
                    'description' => esc_html__( 'Optimal resolution is about 2000x1000px or more.', 'pressville' ),
                    'type' => 'image',
                    'priority' => 1030,
                    'required' => array(
                        'setting' => 'header_background_type',
                        'operator' => '==',
                        'value' => 'slideshow,slideshow-home,random',
                    ),
                ));

                // Background Image 3
                $lsvr_customizer->add_field( 'header_background_image_3', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Background Image 3', 'pressville' ),
                    'description' => esc_html__( 'Optimal resolution is about 2000x1000px or more.', 'pressville' ),
                    'type' => 'image',
                    'priority' => 1040,
                    'required' => array(
                        'setting' => 'header_background_type',
                        'operator' => '==',
                        'value' => 'slideshow,slideshow-home,random',
                    ),
                ));

                // Background Image 4
                $lsvr_customizer->add_field( 'header_background_image_4', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Background Image 4', 'pressville' ),
                    'description' => esc_html__( 'Optimal resolution is about 2000x1000px or more.', 'pressville' ),
                    'type' => 'image',
                    'priority' => 1050,
                    'required' => array(
                        'setting' => 'header_background_type',
                        'operator' => '==',
                        'value' => 'slideshow,slideshow-home,random',
                    ),
                ));

                // Background Image 5
                $lsvr_customizer->add_field( 'header_background_image_5', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Background Image 5', 'pressville' ),
                    'description' => esc_html__( 'Optimal resolution is about 2000x1000px or more.', 'pressville' ),
                    'type' => 'image',
                    'priority' => 1060,
                    'required' => array(
                        'setting' => 'header_background_type',
                        'operator' => '==',
                        'value' => 'slideshow,slideshow-home,random',
                    ),
                ));

                // Animate background
                $lsvr_customizer->add_field( 'header_background_animated_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Animated Background Image', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => false,
                    'priority' => 1070,
                ));

                // Slideshow speed
                $lsvr_customizer->add_field( 'header_background_slideshow_speed', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Slideshow Speed', 'pressville' ),
                    'description' => esc_html__( 'Set how many seconds it takes to change to the next image.', 'pressville' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 1,
                        'max' => 60,
                        'step' => 1,
                    ),
                    'default' => 10,
                    'priority' => 1090,
                    'required' => array(
                        'setting' => 'header_background_type',
                        'operator' => '==',
                        'value' => 'slideshow,slideshow-home',
                    ),
                ));

                // Background Vertical Align
                $lsvr_customizer->add_field( 'header_background_vertical_align', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Background Vertical Align', 'pressville' ),
                    'description' => esc_html__( 'Align of background image.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'top' => esc_html__( 'Top', 'pressville' ),
                        'center' => esc_html__( 'Middle', 'pressville' ),
                        'bottom' => esc_html__( 'Bottom', 'pressville' ),
                    ),
                    'default' => 'top',
                    'priority' => 1100,
                ));

                // Background Overlay Opacity
                $lsvr_customizer->add_field( 'header_background_overlay_opacity', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Background Overlay Opacity', 'pressville' ),
                    'description' => esc_html__( 'Set to 0 for invisible overlay and to 100 for solid color.', 'pressville' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ),
                    'default' => 80,
                    'priority' => 1110,
                ));

                // Separator
                $lsvr_customizer->add_separator( 'header_separator_2', array(
                    'section' => 'header_settings',
                    'priority' => 2000,
                ));

                // Max logo width
                $lsvr_customizer->add_field( 'header_logo_max_width', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Logo Max Width', 'pressville' ),
                    'description' => esc_html__( 'Set maximum width of your header logo. You can upload your site logo under Customizer / Site Identity.', 'pressville' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 50,
                        'max' => 300,
                        'step' => 1,
                    ),
                    'default' => 120,
                    'priority' => 2010,
                ));

                // Site title enable
                $lsvr_customizer->add_field( 'header_site_title_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Display Site Title', 'pressville' ),
                    'description' => esc_html__( 'Show your site title in the header. It can be changed under Settings / General.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2020,
                ));

                // Site description enable
                $lsvr_customizer->add_field( 'header_site_description_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Display Site Tagline', 'pressville' ),
                    'description' => esc_html__( 'Show your site description in the header. It can be changed under Settings / General (Tagline).', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2030,
                ));

                // Site description front page enable
                $lsvr_customizer->add_field( 'header_site_description_frontpage_only_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Display Site Tagline on Front Page only', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2040,
                    'required' => array(
                        'setting' => 'header_site_description_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));

                // Center logo
                $lsvr_customizer->add_field( 'header_logo_centered_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Center Logo', 'pressville' ),
                    'description' => esc_html__( 'Center logo, tagline and description.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => false,
                    'priority' => 2050,
                ));

                // Separator
                $lsvr_customizer->add_separator( 'header_separator_3', array(
                    'section' => 'header_settings',
                    'priority' => 3000,
                ));

                // Sticky navbar
                $lsvr_customizer->add_field( 'sticky_navbar_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Enable Sticky Navbar', 'pressville' ),
                    'description' => esc_html__( 'Make primary menu stick to the top of the page.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 3010,
                ));

                // Larger header
                $lsvr_customizer->add_field( 'header_large_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Enable Large Header On Home', 'pressville' ),
                    'description' => esc_html__( 'Make the header on the front page larger.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 3015,
                ));

                // Header search
                $lsvr_customizer->add_field( 'header_search_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Enable Header Search', 'pressville' ),
                    'description' => esc_html__( 'Search input will be displayed after clicking on the search button.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 3020,
                ));

                // Header ajax search
                $lsvr_customizer->add_field( 'header_search_ajax_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Enable Ajax Search', 'pressville' ),
                    'description' => esc_html__( 'Results will be displayed without refreshing the page.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 3030,
                    'required' => array(
                        'setting' => 'header_search_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));

                // Header search filter
                $lsvr_customizer->add_field( 'header_search_filter_enable', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Display Search Filter', 'pressville' ),
                    'description' => esc_html__( 'Filter the search results.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 3040,
                    'required' => array(
                        'setting' => 'header_search_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));

                // Header search ajax limit
                $lsvr_customizer->add_field( 'header_search_ajax_results_limit', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Number of Search Results', 'pressville' ),
                    'description' => esc_html__( 'Maximum number of search results to display via ajax search.', 'pressville' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 5,
                        'max' => 20,
                        'step' => 1,
                    ),
                    'default' => 15,
                    'priority' => 3050,
                    'required' => array(
                        'setting' => 'header_search_ajax_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));

                // Header search input placeholder
                $lsvr_customizer->add_field( 'header_search_input_placeholder', array(
                    'section' => 'header_settings',
                    'label' => esc_html__( 'Search Input Placeholder', 'pressville' ),
                    'description' => esc_html__( 'Text to display before user starts to type.', 'pressville' ),
                    'type' => 'text',
                    'default' => esc_html__( 'Search this site', 'pressville' ),
                    'priority' => 3060,
                    'required' => array(
                        'setting' => 'header_search_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));


            // Footer settings
            $lsvr_customizer->add_section( 'footer_settings', array(
                'title' => esc_html__( 'Footer', 'pressville' ),
                'priority' => 102,
            ));

                // Background Image
                $lsvr_customizer->add_field( 'footer_background_image', array(
                    'section' => 'footer_settings',
                    'label' => esc_html__( 'Background Image', 'pressville' ),
                    'description' => esc_html__( 'Optimal resolution is about 2000x1600px or more.', 'pressville' ),
                    'type' => 'image',
                    'priority' => 1010,
                ));

                // Background Overlay Opacity
                $lsvr_customizer->add_field( 'footer_background_overlay_opacity', array(
                    'section' => 'footer_settings',
                    'label' => esc_html__( 'Background Overlay Opacity', 'pressville' ),
                    'description' => esc_html__( 'Set to 0 for invisible overlay and to 100 for solid color.', 'pressville' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ),
                    'default' => 80,
                    'priority' => 1020,
                ));

                // Separator
                $lsvr_customizer->add_separator( 'footer_separator_1', array(
                    'section' => 'footer_settings',
                    'priority' => 2000,
                ));

                // Footer widgets columns
                $lsvr_customizer->add_field( 'footer_widgets_columns', array(
                    'section' => 'footer_settings',
                    'label' => esc_html__( 'Widget Columns', 'pressville' ),
                    'description' => esc_html__( 'How many columns should be used to display widgets in the footer. You can populate the footer with widgets under Appearance / Widgets.', 'pressville' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 1,
                        'max' => 4,
                        'step' => 1,
                    ),
                    'default' => 4,
                    'priority' => 2010,
                ));

                // Wider first column
                $lsvr_customizer->add_field( 'footer_widgets_wider_col_enable', array(
                    'section' => 'footer_settings',
                    'label' => esc_html__( 'Make First Column Wider', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => false,
                    'priority' => 2020,
                    'required' => array(
                        'setting' => 'footer_widgets_columns',
                        'operator' => '==',
                        'value' => '4',
                    ),
                ));

                // Separator
                $lsvr_customizer->add_separator( 'footer_separator_2', array(
                    'section' => 'footer_settings',
                    'priority' => 3000,
                ));

                // Show social links
                $lsvr_customizer->add_field( 'footer_social_links_enable', array(
                    'section' => 'footer_settings',
                    'label' => esc_html__( 'Show Social Links in Footer', 'pressville' ),
                    'description' => esc_html__( 'You can manage them under Customizer / Social Links.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 3010,
                ));

                // Separator
                $lsvr_customizer->add_separator( 'footer_separator_3', array(
                    'section' => 'footer_settings',
                    'priority' => 4000,
                ));

                // Footer text
                $lsvr_customizer->add_field( 'footer_text', array(
                    'section' => 'footer_settings',
                    'label' => esc_html__( 'Footer Text', 'pressville' ),
                    'description' => esc_html__( 'Ideal for copyright info. You can use A, BR, EM, P and STRONG tags and CURRENT_YEAR variable to display the current year. For example: &amp;copy; CURRENT_YEAR &lt;a href="http://mysite.com"&gt;MySite&lt;/a&gt;', 'pressville' ),
                    'type' => 'textarea',
                    'default'  => '&copy; CURRENT_YEAR ' . get_bloginfo( 'name' ),
                    'priority' => 4010,
                ));


            // Sidebar settings
            $lsvr_customizer->add_section( 'sidebar_settings', array(
                'title' => esc_html__( 'Custom Sidebars', 'pressville' ),
                'priority' => 115,
            ));

                // Custom sidebars
                $lsvr_customizer->add_field( 'custom_sidebars', array(
                    'section' => 'sidebar_settings',
                    'label' => esc_html__( 'Manage Custom Sidebars', 'pressville' ),
                    'description' => esc_html__( 'Here you can manage your custom sidebars. You can populate them with widgets under Appearance / Widgets. To assign a sidebar to a page, set its page template to "Sidebar on the Left" or "Sidebar on the Right" and then choose the sidebar under Sidebar Settings of that page. You can assign sidebars to post type pages (directory, events, galleries, etc.) in the Customizer.', 'pressville' ),
                    'type' => 'lsvr-sidebars',
                    'priority' => 1010,
                ));


            // Blog settings
            $lsvr_customizer->add_section( 'blog_settings', array(
                'title' => esc_html__( 'Standard Posts', 'pressville' ),
                'priority' => 120,
            ));

                // Archive settings
                $lsvr_customizer->add_info( 'blog_archive_info', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Archive Settings', 'pressville' ),
                    'description' => esc_html__( 'The following settings apply to post archive page. You can change your default post archive page under Settings / Reading. Scroll down for post detail page settings.', 'pressville' ),
                    'priority' => 1010,
                ));

                // Archive layout
                $lsvr_customizer->add_field( 'blog_archive_layout', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Archive Layout', 'pressville' ),
                    'description' => esc_html__( 'Change layout for the post archive page.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'pressville' ),
                        'grid' => esc_html__( 'Grid', 'pressville' ),
                    ),
                    'default' => 'default',
                    'priority' => 1020,
                ));

                // Archive thumbnail position
                $lsvr_customizer->add_field( 'blog_archive_thumb_position', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Archive Thumbnail Position', 'pressville' ),
                    'description' => esc_html__( 'Set the thumbnail image position for posts in archive.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'top' => esc_html__( 'Top', 'pressville' ),
                        'left' => is_rtl() ? esc_html__( 'Right', 'pressville' ) : esc_html__( 'Left', 'pressville' ),
                    ),
                    'default' => 'top',
                    'priority' => 1030,
                    'required' => array(
                        'setting' => 'blog_archive_layout',
                        'operator' => '==',
                        'value' => 'default',
                    ),
                ));

                // Archive grid columns
                $lsvr_customizer->add_field( 'blog_archive_grid_columns', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Number of Columns', 'pressville' ),
                    'description' => esc_html__( 'Divide layout into several columns.', 'pressville' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 1,
                        'max' => 4,
                        'step' => 1,
                    ),
                    'default' => 3,
                    'priority' => 1040,
                    'required' => array(
                        'setting' => 'blog_archive_layout',
                        'operator' => '==',
                        'value' => 'grid',
                    ),
                ));

                // Enable categories
                $lsvr_customizer->add_field( 'blog_archive_categories_enable', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Display Archive Categories', 'pressville' ),
                    'description' => esc_html__( 'Display links to post categories.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => false,
                    'priority' => 1210,
                ));

                // Enable author on archive
                $lsvr_customizer->add_field( 'blog_archive_author_enable', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Display Author on Archive', 'pressville' ),
                    'description' => esc_html__( 'Display post author on archive page.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => false,
                    'priority' => 1220,
                ));

                // Archive sidebar position
                $lsvr_customizer->add_field( 'blog_archive_sidebar_position', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Archive Sidebar Position', 'pressville' ),
                    'description' => esc_html__( 'Change the post archive sidebar position.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'pressville' ),
                        'left' => esc_html__( 'Left', 'pressville' ),
                        'right' => esc_html__( 'Right', 'pressville' ),
                    ),
                    'default' => 'right',
                    'priority' => 1510,
                ));

                // Archive sidebar ID
                $lsvr_customizer->add_field( 'blog_archive_sidebar_id', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Archive Sidebar', 'pressville' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'pressville' ),
                    'type' => 'select',
                    'choices' => lsvr_pressville_get_sidebars(),
                    'priority' => 1120,
                    'default' => 'lsvr-pressville-default-sidebar',
                    'required' => array(
                        'setting' => 'blog_archive_sidebar_position',
                        'operator' => '==',
                        'value' => 'left,right',
                    ),
                ));

                // Separator
                $lsvr_customizer->add_separator( 'blog_separator_1', array(
                    'section' => 'blog_settings',
                    'priority' => 2000,
                ));

                // Detail settings
                $lsvr_customizer->add_info( 'blog_single_info', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Detail Settings', 'pressville' ),
                    'description' => esc_html__( 'The following settings apply to post detail pages.', 'pressville' ),
                    'priority' => 2010,
                ));

                // Enable author
                $lsvr_customizer->add_field( 'blog_single_author_enable', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Display Author on Detail', 'pressville' ),
                    'description' => esc_html__( 'Display post author on post detail.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2020,
                ));

                // Enable thumbnail
                $lsvr_customizer->add_field( 'blog_single_thumbnail_enable', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Display Featured Image on Detail', 'pressville' ),
                    'description' => esc_html__( 'Display post featured image on post detail.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2030,
                ));

                // Enable post detail navigation
                $lsvr_customizer->add_field( 'blog_single_post_navigation_enable', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Enable Post Detail Navigation', 'pressville' ),
                    'description' => esc_html__( 'Display links to previous and next posts at the bottom of the current post.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2040,
                ));

                // Single sidebar position
                $lsvr_customizer->add_field( 'blog_single_sidebar_position', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Detail Sidebar Position', 'pressville' ),
                    'description' => esc_html__( 'Change the post detail sidebar position.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'pressville' ),
                        'left' => esc_html__( 'Left', 'pressville' ),
                        'right' => esc_html__( 'Right', 'pressville' ),
                    ),
                    'default' => 'right',
                    'priority' => 2110,
                ));

                // Single sidebar ID
                $lsvr_customizer->add_field( 'blog_single_sidebar_id', array(
                    'section' => 'blog_settings',
                    'label' => esc_html__( 'Detail Sidebar', 'pressville' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'pressville' ),
                    'type' => 'select',
                    'choices' => lsvr_pressville_get_sidebars(),
                    'priority' => 2120,
                    'default' => 'lsvr-pressville-default-sidebar',
                    'required' => array(
                        'setting' => 'blog_single_sidebar_position',
                        'operator' => '==',
                        'value' => 'left,right',
                    ),
                ));


            // Typography
            $lsvr_customizer->add_section( 'typography_settings', array(
                'title' => esc_html__( 'Typography', 'pressville' ),
                'priority' => 200,
            ));

                // Enable Google Fonts
                $lsvr_customizer->add_field( 'typography_google_fonts_enable', array(
                    'section' => 'typography_settings',
                    'label' => esc_html__( 'Enable Google Fonts', 'pressville' ),
                    'description' => esc_html__( 'If you disable Google Fonts, default sans-serif font will be used for all text.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1010,
                ));

                // Primary font
                $lsvr_customizer->add_field( 'typography_primary_font', array(
                    'section' => 'typography_settings',
                    'label' => esc_html__( 'Primary Font', 'pressville' ),
                    'description' => esc_html__( 'This font will be used for almost all text except some headlines and titles.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'Alegreya' => 'Alegreya',
                        'Alegreya+Sans' => 'Alegreya Sans',
                        'Archivo+Narrow' => 'Archivo Narrow',
                        'Assistant' => 'Assistant',
                        'Fira+Sans' => 'Fira Sans',
                        'Hind' => 'Hind',
                        'Inconsolata' => 'Inconsolata',
                        'Karla' => 'Karla',
                        'Lato' => 'Lato',
                        'Libre+Baskerville' => 'Libre Baskerville',
                        'Lora' => 'Lora',
                        'Merriweather' => 'Merriweather',
                        'Montserrat' => 'Montserrat',
                        'Nunito+Sans' => 'Nunito Sans',
                        'Open+Sans' => 'Open Sans',
                        'PT+Serif' => 'PT Serif',
                        'Playfair+Display' => 'Playfair Display',
                        'Roboto' => 'Roboto',
                        'Roboto+Slab' => 'Roboto Slab',
                        'Source+Sans+Pro' => 'Source Sans Pro',
                        'Source+Serif+Pro' => 'Source Serif Pro',
                        'Work+Sans' => 'Work Sans',
                    ),
                    'default' => 'Source+Sans+Pro',
                    'priority' => 1020,
                    'required' => array(
                        'setting' => 'typography_google_fonts_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));

                // Secondary font
                $lsvr_customizer->add_field( 'typography_secondary_font', array(
                    'section' => 'typography_settings',
                    'label' => esc_html__( 'Secondary Font', 'pressville' ),
                    'description' => esc_html__( 'This font will be used for most headlines.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'Alegreya' => 'Alegreya',
                        'Alegreya+Sans' => 'Alegreya Sans',
                        'Archivo+Narrow' => 'Archivo Narrow',
                        'Assistant' => 'Assistant',
                        'Fira+Sans' => 'Fira Sans',
                        'Hind' => 'Hind',
                        'Inconsolata' => 'Inconsolata',
                        'Karla' => 'Karla',
                        'Lato' => 'Lato',
                        'Libre+Baskerville' => 'Libre Baskerville',
                        'Lora' => 'Lora',
                        'Merriweather' => 'Merriweather',
                        'Montserrat' => 'Montserrat',
                        'Nunito+Sans' => 'Nunito Sans',
                        'Open+Sans' => 'Open Sans',
                        'PT+Serif' => 'PT Serif',
                        'Playfair+Display' => 'Playfair Display',
                        'Roboto' => 'Roboto',
                        'Roboto+Slab' => 'Roboto Slab',
                        'Source+Sans+Pro' => 'Source Sans Pro',
                        'Source+Serif+Pro' => 'Source Serif Pro',
                        'Work+Sans' => 'Work Sans',
                    ),
                    'default' => 'Lora',
                    'priority' => 1030,
                    'required' => array(
                        'setting' => 'typography_google_fonts_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));

                // Base font size
                $lsvr_customizer->add_field( 'typography_base_font_size', array(
                    'section' => 'typography_settings',
                    'label' => esc_html__( 'Base Font Size', 'pressville' ),
                    'description' => esc_html__( 'Font size of basic content text. All other font sizes will also be calculated from this value. Default font size is 16px.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        '12' => esc_html__( '12px', 'pressville' ),
                        '13' => esc_html__( '13px', 'pressville' ),
                        '14' => esc_html__( '14px', 'pressville' ),
                        '15' => esc_html__( '15px', 'pressville' ),
                        '16' => esc_html__( '16px', 'pressville' ),
                        '17' => esc_html__( '17px', 'pressville' ),
                        '18' => esc_html__( '18px', 'pressville' ),
                    ),
                    'default' => '16',
                    'priority' => 1040,
                ));

                // Font subsets
                $lsvr_customizer->add_field( 'typography_font_subsets', array(
                    'section' => 'typography_settings',
                    'label' => esc_html__( 'Font Subsets', 'pressville' ),
                    'description' => esc_html__( 'Only the Latin subset is loaded by default. If your site is in any other language than English, you may need to load an additional font subset. Please note that not all font families support all font subsets.', 'pressville' ),
                    'type' => 'lsvr-multicheck',
                    'choices' => array(
                        'latin-ext' => esc_html__( 'Latin Extended', 'pressville' ),
                        'greek' => esc_html__( 'Greek', 'pressville' ),
                        'greek-ext' => esc_html__( 'Greek Extended', 'pressville' ),
                        'vietnamese' => esc_html__( 'Vietnamese', 'pressville' ),
                        'cyrillic' => esc_html__( 'Cyrillic', 'pressville' ),
                        'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'pressville' ),
                    ),
                    'priority' => 1050,
                    'required' => array(
                        'setting' => 'typography_google_fonts_enable',
                        'operator' => '==',
                        'value' => true,
                    ),
                ));


            // Colors
            $lsvr_customizer->add_section( 'colors_settings', array(
                'title' => esc_html__( 'Colors', 'pressville' ),
                'priority' => 210,
            ));

                // Colors method
                $lsvr_customizer->add_field( 'colors_method', array(
                    'section' => 'colors_settings',
                    'label' => esc_html__( 'Set Colors By', 'pressville' ),
                    'type' => 'radio',
                    'choices' => array(
                        'predefined' => esc_html__( 'Predefined Scheme', 'pressville' ),
                        'custom-colors' => esc_html__( 'Custom Colors', 'pressville' ),
                        'custom-skin' => esc_html__( 'Custom Scheme', 'pressville' ),
                    ),
                    'default' => 'predefined',
                    'priority' => 1010,
                ));

                // Predefined skin
                $lsvr_customizer->add_field( 'colors_predefined_skin', array(
                    'section' => 'colors_settings',
                    'label' => esc_html__( 'Choose Predefined Skin', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'pressville' ),
                        'blue-green' => esc_html__( 'Blue & Green', 'pressville' ),
                        'blue-orange' => esc_html__( 'Blue & Orange', 'pressville' ),
                        'plum-sand' => esc_html__( 'Plum & Sand', 'pressville' ),
                    ),
                    'default' => 'default',
                    'priority' => 2010,
                    'required' => array(
                        'setting' => 'colors_method',
                        'operator' => '==',
                        'value' => 'predefined',
                    ),
                ));

                // Accent 1
                $lsvr_customizer->add_field( 'colors_custom_accent1', array(
                    'section' => 'colors_settings',
                    'label' => esc_html__( 'Accent 1', 'pressville' ),
                    'type' => 'color',
                    'default' => '#cd4335',
                    'priority' => 3010,
                    'required' => array(
                        'setting' => 'colors_method',
                        'operator' => '==',
                        'value' => 'custom-colors',
                    ),
                ));

                // Accent 2
                $lsvr_customizer->add_field( 'colors_custom_accent2', array(
                    'section' => 'colors_settings',
                    'label' => esc_html__( 'Accent 2', 'pressville' ),
                    'type' => 'color',
                    'default' => '#2d93c5',
                    'priority' => 3020,
                    'required' => array(
                        'setting' => 'colors_method',
                        'operator' => '==',
                        'value' => 'custom-colors',
                    ),
                ));

                // Link
                $lsvr_customizer->add_field( 'colors_custom_link', array(
                    'section' => 'colors_settings',
                    'label' => esc_html__( 'Link', 'pressville' ),
                    'type' => 'color',
                    'default' => '#2d93c5',
                    'priority' => 3030,
                    'required' => array(
                        'setting' => 'colors_method',
                        'operator' => '==',
                        'value' => 'custom-colors',
                    ),
                ));

                // Text
                $lsvr_customizer->add_field( 'colors_custom_text', array(
                    'section' => 'colors_settings',
                    'label' => esc_html__( 'Text', 'pressville' ),
                    'type' => 'color',
                    'default' => '#545e69',
                    'priority' => 3040,
                    'required' => array(
                        'setting' => 'colors_method',
                        'operator' => '==',
                        'value' => 'custom-colors',
                    ),
                ));

                // Child theme's style.csss
                $lsvr_customizer->add_info( 'colors_info_skin', array(
                    'section' => 'colors_settings',
                    'label' => esc_html( 'About Custom Scheme', 'pressville' ),
                    'description' => esc_html__( 'Please refer to the documentation on how to generate your custom color scheme. Put your generated code into child theme\'s style.css file (you can access it via Appearance / Editor).', 'pressville' ),
                    'priority' => 4010,
                    'required' => array(
                        'setting' => 'colors_method',
                        'operator' => '==',
                        'value' => 'custom-skin',
                    ),
                ));


            // Social settings
            $lsvr_customizer->add_section( 'social_settings', array(
                'title' => esc_html__( 'Social Links', 'pressville' ),
                'priority' => 220,
            ));

                // About
                $lsvr_customizer->add_info( 'social_links_info', array(
                    'section' => 'social_settings',
                    'label' => esc_html( 'Info', 'pressville' ),
                    'description' => esc_html__( 'You can add your social links either by using custom fields, predefined fields or combination of both.', 'pressville' ),
                    'priority' => 1000,
                ));

                // Custom Social Link 1 Icon
                $lsvr_customizer->add_field( 'custom_social_link1_icon', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 1 Icon', 'pressville' ),
                    'description' => esc_html__( 'Add icon class here. Please refer to the documentation to learn more about icons.', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1110,
                ));

                // Custom Social Link 1 URL
                $lsvr_customizer->add_field( 'custom_social_link1_url', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 1 URL', 'pressville' ),
                    'description' => esc_html__( 'Absolute URL to your social profile.', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1120,
                ));

                // Custom Social Link 1 Label
                $lsvr_customizer->add_field( 'custom_social_link1_label', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 1 Label', 'pressville' ),
                    'description' => esc_html__( 'This label will appear when you hover over the icon.', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1130,
                ));

                // Custom Social Link 2 Icon
                $lsvr_customizer->add_field( 'custom_social_link2_icon', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 2 Icon', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1210,
                ));

                // Custom Social Link 2 URL
                $lsvr_customizer->add_field( 'custom_social_link2_url', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 2 URL', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1220,
                ));

                // Custom Social Link 2 Label
                $lsvr_customizer->add_field( 'custom_social_link2_label', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 2 Label', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1230,
                ));

                // Custom Social Link 3 Icon
                $lsvr_customizer->add_field( 'custom_social_link3_icon', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 3 Icon', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1310,
                ));

                // Custom Social Link 3 URL
                $lsvr_customizer->add_field( 'custom_social_link3_url', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 3 URL', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1320,
                ));

                // Custom Social Link 3 Label
                $lsvr_customizer->add_field( 'custom_social_link3_label', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Custom Social Link 3 Label', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1330,
                ));

                // Separator
                $lsvr_customizer->add_separator( 'social_links_separator_1', array(
                    'section' => 'social_settings',
                    'priority' => 2000,
                ));

                // Predefined Social Links
                $lsvr_customizer->add_field( 'social_links', array(
                    'section' => 'social_settings',
                    'label' => esc_html__( 'Predefined Social Links', 'pressville' ),
                    'description' => esc_html__( 'Insert URLs into inputs of social networks which you want to display. You can drag and drop items to change the order.', 'pressville' ),
                    'type' => 'lsvr-social-links',
                    'choices' => array(
                        'email' => array(
                            'label' => esc_html__( 'Email', 'pressville' ),
                            'icon' => 'icon-envelope-o',
                        ),
                        '500px' => array(
                            'label' => esc_html__( '500px', 'pressville' ),
                            'icon' => 'icon-500px',
                        ),
                        'bandcamp' => array(
                            'label' => esc_html__( 'Bandcamp', 'pressville' ),
                            'icon' => 'icon-bandcamp',
                        ),
                        'behance' => array(
                            'label' => esc_html__( 'Behance', 'pressville' ),
                            'icon' => 'icon-behance',
                        ),
                        'codepen' => array(
                            'label' => esc_html__( 'CodePen', 'pressville' ),
                            'icon' => 'icon-codepen',
                        ),
                        'deviantart' => array(
                            'label' => esc_html__( 'DeviantArt', 'pressville' ),
                            'icon' => 'icon-deviantart',
                        ),
                        'dribbble' => array(
                            'label' => esc_html__( 'Dribbble', 'pressville' ),
                            'icon' => 'icon-dribbble',
                        ),
                        'dropbox' => array(
                            'label' => esc_html__( 'Dropbox', 'pressville' ),
                            'icon' => 'icon-dropbox',
                        ),
                        'etsy' => array(
                            'label' => esc_html__( 'Etsy', 'pressville' ),
                            'icon' => 'icon-etsy',
                        ),
                        'facebook' => array(
                            'label' => esc_html__( 'Facebook', 'pressville' ),
                            'icon' => 'icon-facebook',
                        ),
                        'flickr' => array(
                            'label' => esc_html__( 'Flickr', 'pressville' ),
                            'icon' => 'icon-flickr',
                        ),
                        'foursquare' => array(
                            'label' => esc_html__( 'Foursquare', 'pressville' ),
                            'icon' => 'icon-foursquare',
                        ),
                        'github' => array(
                            'label' => esc_html__( 'Github', 'pressville' ),
                            'icon' => 'icon-github',
                        ),
                        'google-plus' => array(
                            'label' => esc_html__( 'Google+', 'pressville' ),
                            'icon' => 'icon-google-plus',
                        ),
                        'instagram' => array(
                            'label' => esc_html__( 'Instagram', 'pressville' ),
                            'icon' => 'icon-instagram',
                        ),
                        'lastfm' => array(
                            'label' => esc_html__( 'last.fm', 'pressville' ),
                            'icon' => 'icon-lastfm',
                        ),
                        'linkedin' => array(
                            'label' => esc_html__( 'LinkedIn', 'pressville' ),
                            'icon' => 'icon-linkedin',
                        ),
                        'odnoklassniki' => array(
                            'label' => esc_html__( 'Odnoklassniki', 'pressville' ),
                            'icon' => 'icon-odnoklassniki',
                        ),
                        'pinterest' => array(
                            'label' => esc_html__( 'Pinterest', 'pressville' ),
                            'icon' => 'icon-pinterest',
                        ),
                        'qq' => array(
                            'label' => esc_html__( 'QQ', 'pressville' ),
                            'icon' => 'icon-qq',
                        ),
                        'reddit' => array(
                            'label' => esc_html__( 'Reddit', 'pressville' ),
                            'icon' => 'icon-reddit',
                        ),
                        'skype' => array(
                            'label' => esc_html__( 'Skype', 'pressville' ),
                            'icon' => 'icon-skype',
                        ),
                        'slack' => array(
                            'label' => esc_html__( 'Slack', 'pressville' ),
                            'icon' => 'icon-slack',
                        ),
                        'snapchat' => array(
                            'label' => esc_html__( 'Snapchat', 'pressville' ),
                            'icon' => 'icon-snapchat',
                        ),
                        'tripadvisor' => array(
                            'label' => esc_html__( 'TripAdvisor', 'pressville' ),
                            'icon' => 'icon-tripadvisor',
                        ),
                        'tumblr' => array(
                            'label' => esc_html__( 'Tumblr', 'pressville' ),
                            'icon' => 'icon-tumblr',
                        ),
                        'twitch' => array(
                            'label' => esc_html__( 'Twitch', 'pressville' ),
                            'icon' => 'icon-twitch',
                        ),
                        'twitter' => array(
                            'label' => esc_html__( 'Twitter', 'pressville' ),
                            'icon' => 'icon-twitter',
                        ),
                        'vimeo' => array(
                            'label' => esc_html__( 'Vimeo', 'pressville' ),
                            'icon' => 'icon-vimeo',
                        ),
                        'vk' => array(
                            'label' => esc_html__( 'VK', 'pressville' ),
                            'icon' => 'icon-vk',
                        ),
                        'yahoo' => array(
                            'label' => esc_html__( 'Yahoo', 'pressville' ),
                            'icon' => 'icon-yahoo',
                        ),
                        'yelp' => array(
                            'label' => esc_html__( 'Yelp', 'pressville' ),
                            'icon' => 'icon-yelp',
                        ),
                        'youtube' => array(
                            'label' => esc_html__( 'YouTube', 'pressville' ),
                            'icon' => 'icon-youtube',
                        ),
                    ),
                    'priority' => 2100,
                ));


            // Language settings
            $lsvr_customizer->add_section( 'language_settings', array(
                'title' => esc_html__( 'Languages', 'pressville' ),
                'priority' => 230,
            ));

                // About
                $lsvr_customizer->add_info( 'language_info', array(
                    'section' => 'language_settings',
                    'label' => esc_html( 'Info', 'pressville' ),
                    'description' => esc_html__( 'The following settings are useful if you want to run your site in more than one language. If you just want to translate the theme to a single language, please check out the documentation on how to do that.', 'pressville' ),
                    'priority' => 1000,
                ));

                // Language switcher
                $lsvr_customizer->add_field( 'language_switcher', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language Switcher', 'pressville' ),
                    'description' => esc_html__( 'Display links to other language versions. WPML plugin is required for "WPML Generated" option to work.', 'pressville' ),
                    'type' => 'radio',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'pressville' ),
                        'wpml' => esc_html__( 'WPML Generated', 'pressville' ),
                        'custom' => esc_html__( 'Custom Links', 'pressville' ),
                    ),
                    'default' => 'disable',
                    'priority' => 1010,
                ));

                // Custom lang 1 label
                $lsvr_customizer->add_field( 'language_custom1_label', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 1 Label', 'pressville' ),
                    'description' => esc_html__( 'For example "EN", "DE" or "ES".', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1020,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 1 code
                $lsvr_customizer->add_field( 'language_custom1_code', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 1 Code', 'pressville' ),
                    'description' => esc_html__( 'It will be used to determine the active language. For example "en_US", "de_DE" or "es_ES".', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1030,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 1 URL
                $lsvr_customizer->add_field( 'language_custom1_url', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 1 URL', 'pressville' ),
                    'description' => esc_html__( 'For example "http://mysite.com/en".', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1040,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 2 label
                $lsvr_customizer->add_field( 'language_custom2_label', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 2 Label', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1050,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 2 code
                $lsvr_customizer->add_field( 'language_custom2_code', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 2 Code', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1060,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 2 URL
                $lsvr_customizer->add_field( 'language_custom2_url', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 2 URL', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1070,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 3 label
                $lsvr_customizer->add_field( 'language_custom3_label', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 3 Label', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1080,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 3 code
                $lsvr_customizer->add_field( 'language_custom3_code', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 3 Code', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1090,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 3 URL
                $lsvr_customizer->add_field( 'language_custom3_url', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 3 URL', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1100,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 4 label
                $lsvr_customizer->add_field( 'language_custom4_label', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 4 Label', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1100,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 4 code
                $lsvr_customizer->add_field( 'language_custom4_code', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 4 Code', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1120,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 4 URL
                $lsvr_customizer->add_field( 'language_custom4_url', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 4 URL', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1130,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 5 label
                $lsvr_customizer->add_field( 'language_custom5_label', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 5 Label', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1140,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 5 code
                $lsvr_customizer->add_field( 'language_custom5_code', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 5 Code', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1150,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

                // Custom lang 5 URL
                $lsvr_customizer->add_field( 'language_custom5_url', array(
                    'section' => 'language_settings',
                    'label' => esc_html__( 'Language 5 URL', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1160,
                    'required' => array(
                        'setting' => 'language_switcher',
                        'operator' => '==',
                        'value' => 'custom',
                    ),
                ));

            // Maps settings
            $lsvr_customizer->add_section( 'map_settings', array(
                'title' => esc_html__( 'Map Settings', 'pressville' ),
                'priority' => 240,
            ));

                // Maps provider
                $lsvr_customizer->add_field( 'maps_provider', array(
                    'section' => 'map_settings',
                    'label' => esc_html__( 'Maps Provider', 'pressville' ),
                    'description' => esc_html__( 'Choose map provider for built-in maps (for Directory and Events).', 'pressville' ),
                    'type' => 'radio',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable built-in maps', 'pressville' ),
                        'gmaps' => esc_html__( 'Google Maps', 'pressville' ),
                        'mapbox' => esc_html__( 'Mapbox', 'pressville' ),
                        'osm' => esc_html__( 'Open Street Map', 'pressville' ),
                    ),
                    'default' => 'disable',
                    'priority' => 1010,
                ));

                // Google Maps API key
                $lsvr_customizer->add_field( 'google_api_key', array(
                    'section' => 'map_settings',
                    'label' => __( 'Google Maps API Key', 'pressville' ),
                    'description' => esc_html__( 'API key is needed to display Google Maps. More info on how to obtain your own API key:', 'pressville' ) . '<br><a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">https://developers.google.com/maps/documentation/javascript/get-api-key</a>',
                    'type' => 'text',
                    'priority' => 2010,
                    'required' => array(
                        'setting' => 'maps_provider',
                        'operator' => '==',
                        'value' => 'gmaps',
                    ),
                ));

                // Enable custom maps style
                $lsvr_customizer->add_field( 'google_maps_style', array(
                    'section' => 'map_settings',
                    'label' => esc_html__( 'Google Map Style', 'pressville' ),
                    'description' => esc_html__( 'This will affect only the "terrain" and "roadmap" map styles.', 'pressville' ),
                    'type' => 'radio',
                    'choices' => array(
                        'default' => esc_html__( 'Use default map style', 'pressville' ),
                        'custom' => esc_html__( 'Add custom map style', 'pressville' ),
                    ),
                    'default' => 'default',
                    'priority' => 2020,
                    'required' => array(
                        'setting' => 'maps_provider',
                        'operator' => '==',
                        'value' => 'gmaps',
                    ),
                ));

                // Google Maps style
                $lsvr_customizer->add_field( 'google_maps_style_custom', array(
                    'section' => 'map_settings',
                    'label' => __( 'Google Maps Style', 'pressville' ),
                    'description' => esc_html__( 'Override default custom style for Google maps with your own. Data must be provided in JavaScript array format. More info:', 'pressville' ) . '<br><a href="https://developers.google.com/maps/documentation/javascript/styling" target="_blank">https://developers.google.com/maps/documentation/javascript/styling</a>',
                    'type' => 'textarea',
                    'priority' => 2030,
                    'required' => array(
                        array(
                            'setting' => 'maps_provider',
                            'operator' => '==',
                            'value' => 'gmaps',
                        ),
                        array(
                            'setting' => 'google_maps_style',
                            'operator' => '==',
                            'value' => 'custom',
                        ),
                    ),
                ));

                // Mapbox API key
                $lsvr_customizer->add_field( 'mapbox_api_key', array(
                    'section' => 'map_settings',
                    'label' => __( 'Mapbox API Key', 'pressville' ),
                    'description' => esc_html__( 'API key is needed to display Mapbox maps. You can obtain your key at Mapbox site:', 'pressville' ) . '<br><a href="https://mapbox.com" target="_blank">https://mapbox.com</a>',
                    'type' => 'text',
                    'priority' => 3010,
                    'required' => array(
                        'setting' => 'maps_provider',
                        'operator' => '==',
                        'value' => 'mapbox',
                    ),
                ));


            // Misc settings
            $lsvr_customizer->add_section( 'misc_settings', array(
                'title' => esc_html__( 'Misc', 'pressville' ),
                'priority' => 250,
            ));

                 // Openweather.org API key
                $lsvr_customizer->add_field( 'openweathermap_api_key', array(
                    'section' => 'misc_settings',
                    'label' => __( 'OpenWeatherMap.org API Key', 'pressville' ),
                    'description' => esc_html__( 'Please insert your API key if you want to use LSVR Pressville Weather widget.', 'pressville' ),
                    'type' => 'text',
                    'priority' => 1010,
                ));

                // Separator
                $lsvr_customizer->add_separator( 'misc_separator_2', array(
                    'section' => 'misc_settings',
                    'priority' => 2000,
                ));

                // Search results posts per page
                $lsvr_customizer->add_field( 'search_results_posts_per_page', array(
                    'section' => 'misc_settings',
                    'label' => esc_html__( 'Search Results Per Page', 'pressville' ),
                    'description' => esc_html__( 'Number of search results per page. Set to 0 to display all.', 'pressville' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ),
                    'default' => 10,
                    'priority' => 2010,
                ));

                // Search results excerpt
                $lsvr_customizer->add_field( 'search_results_excerpt_enable', array(
                    'section' => 'misc_settings',
                    'label' => __( 'Search Results Excerpt', 'pressville' ),
                    'description' => esc_html__( 'Display post excerpt on search results page.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => false,
                    'priority' => 2030,
                ));

                // Separator
                $lsvr_customizer->add_separator( 'misc_separator_3', array(
                    'section' => 'misc_settings',
                    'priority' => 3000,
                ));

                // Enable back to top button
                $lsvr_customizer->add_field( 'back_to_top_button_enable', array(
                    'section' => 'misc_settings',
                    'label' => esc_html__( 'Back to Top Button', 'pressville' ),
                    'description' => esc_html__( 'Display a link to the top of the page.', 'pressville' ),
                    'type' => 'radio',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable back to top button', 'pressville' ),
                        'enable' => esc_html__( 'Enable back to top button', 'pressville' ),
                        'desktop' => esc_html__( 'Enable on dektop only', 'pressville' ),
                        'mobile' => esc_html__( 'Enable on mobile only', 'pressville' ),
                    ),
                    'default' => 'disable',
                    'priority' => 3010,
                ));

                // Back to top button threshold
                $lsvr_customizer->add_field( 'back_to_top_button_threshold', array(
                    'section' => 'misc_settings',
                    'label' => esc_html__( 'Back to Top Button Threshold', 'pressville' ),
                    'description' => esc_html__( 'Set how many pixels have to be scrolled down before back to top button appears.', 'pressville' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 0,
                        'max' => 500,
                        'step' => 10,
                    ),
                    'default' => 100,
                    'priority' => 3020,
                    'required' => array(
                        'setting' => 'back_to_top_button_enable',
                        'operator' => '==',
                        'value' => 'enable,desktop,mobile',
                    ),
                ));

                // Separator
                $lsvr_customizer->add_separator( 'misc_separator_4', array(
                    'section' => 'misc_settings',
                    'priority' => 4000,
                ));

                // Improve accessibility
                $lsvr_customizer->add_field( 'improved_accessibility_enable', array(
                    'section' => 'misc_settings',
                    'label' => __( 'Improve Accessibility', 'pressville' ),
                    'description' => esc_html__( 'Improve website accessibility for screen readers and keyboard users. Disable if you are using a 3rd party soluton for that.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 4010,
                ));

        }

	}
}

?>