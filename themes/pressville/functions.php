<?php add_action( 'after_setup_theme', 'lsvr_pressville_theme_setup' );
if ( ! function_exists( 'lsvr_pressville_theme_setup' ) ) {

   

	function lsvr_pressville_theme_setup() {

		// Constants
		define( 'LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG', esc_html__( 'Method %s is deprecated. Please update all your child theme template files per the parent theme.', 'pressville' ) );

		// Include additional files
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		require_once( get_template_directory() . '/inc/classes/lsvr-pressville-header-menu-primary-walker.php' );
		require_once( get_template_directory() . '/inc/classes/lsvr-pressville-header-menu-secondary-walker.php' );
		require_once( get_template_directory() . '/inc/actions.php' );
		require_once( get_template_directory() . '/inc/ajax-search.php' );
		require_once( get_template_directory() . '/inc/core-functions.php' );
		require_once( get_template_directory() . '/inc/customizer-config.php' );
		require_once( get_template_directory() . '/inc/custom-colors-template.php' );
		require_once( get_template_directory() . '/inc/deprecated.php' );
		require_once( get_template_directory() . '/inc/editor-custom-colors-template.php' );
		require_once( get_template_directory() . '/inc/frontend-functions.php' );
		require_once( get_template_directory() . '/inc/metaboxes-config.php' );
		require_once( get_template_directory() . '/inc/tgm-settings.php' );

		// Include LSVR Notices functions
		if ( class_exists( 'Lsvr_CPT_Notice' ) ) {
			require_once( get_template_directory() . '/inc/lsvr-notices/lsvr-notices.php' );
		}

		// Include LSVR Directory functions
		if ( class_exists( 'Lsvr_CPT_Listing' ) ) {
			require_once( get_template_directory() . '/inc/lsvr-directory/lsvr-directory.php' );
		}

		// Include LSVR Events functions
		if ( class_exists( 'Lsvr_CPT_Event' ) ) {
			require_once( get_template_directory() . '/inc/lsvr-events/lsvr-events.php' );
		}

		// Include LSVR Galleries functions
		if ( class_exists( 'Lsvr_CPT_Gallery' ) ) {
			require_once( get_template_directory() . '/inc/lsvr-galleries/lsvr-galleries.php' );
		}

		// Include LSVR Documents functions
		if ( class_exists( 'Lsvr_CPT_Document' ) ) {
			require_once( get_template_directory() . '/inc/lsvr-documents/lsvr-documents.php' );
		}

		// Include LSVR People functions
		if ( class_exists( 'Lsvr_CPT_Person' ) ) {
			require_once( get_template_directory() . '/inc/lsvr-people/lsvr-people.php' );
		}

		// Include bbPress functions
		if ( class_exists( 'bbpress' ) ) {
			require_once( get_template_directory() . '/inc/bbpress/bbpress.php' );
		}
		
		// Set content width
		if ( ! isset( $content_width ) ) {
			$content_width = 1220;
		}
        
		// Load textdomain
		load_theme_textdomain( 'pressville', get_template_directory() . '/languages' );

		// Enable bbPress support
		add_theme_support( 'bbpress' );

    	// HTML 5 support
		add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

		// Manage site logo via Customizer
		add_theme_support( 'custom-logo', array(
			'flex-height' => true,
			'flex-height' => true,
		));

		// Let WordPress manage the document title
		add_theme_support( 'title-tag' );

		// Enable post thumbnails
		add_theme_support( 'post-thumbnails' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Remove Widgets Block Editor
		remove_theme_support( 'widgets-block-editor' );

    	// Load CSS & JS
		add_action( 'wp_enqueue_scripts', 'lsvr_pressville_load_theme_assets' );
		if ( ! function_exists( 'lsvr_pressville_load_theme_assets' ) ) {
			function lsvr_pressville_load_theme_assets() {

				$version = wp_get_theme( 'pressville' );
				$version = $version->Version;
				$suffix = defined( 'WP_DEBUG' ) && true == WP_DEBUG ? '' : '.min';

				// Main style.css
				wp_enqueue_style( 'lsvr-pressville-main-style', get_bloginfo( 'stylesheet_url' ), array(), $version );

				// Load general.css
				wp_enqueue_style( 'lsvr-pressville-general-style', get_template_directory_uri() . '/assets/css/general.css', array( 'lsvr-pressville-main-style' ), $version );

				// Load comment reply JS for blog posts
				if ( is_singular( 'post' ) ) {
					wp_enqueue_script( 'comment-reply' );
				}

				// Third party scripts
				wp_enqueue_script( 'lsvr-pressville-third-party-scripts', get_template_directory_uri() . '/assets/js/pressville-third-party-scripts.min.js', array( 'jquery' ), $version, true );

				// Main theme scripts
				wp_enqueue_script( 'lsvr-pressville-main-scripts', get_template_directory_uri() . '/assets/js/pressville-scripts' . $suffix . '.js', array( 'jquery' ), $version, true );

				// Load additional assets
				do_action( 'lsvr_pressville_load_assets' );

			}
		}

		// Load editor assets
		add_action( 'enqueue_block_editor_assets', 'lsvr_pressville_load_editor_assets' );
		if ( ! function_exists( 'lsvr_pressville_load_editor_assets' ) ) {
			function lsvr_pressville_load_editor_assets() {

				$version = wp_get_theme( 'pressville' );
				$version = $version->Version;

				// Editor style
				wp_enqueue_style( 'lsvr-pressville-editor-style', get_template_directory_uri() . '/assets/css/editor-style.css', false, $version );

				// Editor RTL style
				if ( is_rtl() ) {
					wp_enqueue_style( 'lsvr-pressville-editor-rtl-style', get_template_directory_uri() . '/assets/css/editor-style.rtl.css', false, $version );
				}

				// Load additional editor assets
				do_action( 'lsvr_pressville_load_editor_assets' );

			}
		}

    	// Register menus
		register_nav_menu( 'lsvr-pressville-header-menu-primary', esc_html__( 'Primary Header Menu', 'pressville' ) );
		register_nav_menu( 'lsvr-pressville-header-menu-secondary', esc_html__( 'Secondary Header Menu', 'pressville' ) );

	    // Register sidebars
	    add_action( 'widgets_init', 'lsvr_pressville_register_sidebars' );
		if ( ! function_exists( 'lsvr_pressville_register_sidebars' ) ) {
			function lsvr_pressville_register_sidebars() {

				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

				// Default sidebar
				register_sidebar( array(
					'name' => esc_html__( 'Default Sidebar', 'pressville' ),
					'id' => 'lsvr-pressville-default-sidebar',
					'class' => '',
					'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget__inner">',
					'after_widget' => '</div></div>',
					'before_title' => '<h3 class="widget__title"><span>',
					'after_title' => '</span></h3>',
				));

				// Footer widgets
				register_sidebar( array(
					'name' => esc_html__( 'Footer Widgets', 'pressville' ),
					'id' => 'lsvr-pressville-footer-widgets',
					'description' => esc_html__( 'Widget area located in the footer of the site. You can change the number of columns under Customizer / Footer with Widget Columns option', 'pressville' ),
					'class' => '',
					'before_widget' => lsvr_pressville_get_footer_widgets_before_widget(),
					'after_widget' => lsvr_pressville_get_footer_widgets_after_widget(),
					'before_title' => '<h3 class="footer-widget__title"><span>',
					'after_title' => '</span></h3>',
				));

				// Custom sidebars
				$custom_sidebars = lsvr_pressville_get_custom_sidebars();
				if ( ! empty( $custom_sidebars ) ) {
					foreach ( $custom_sidebars as $sidebar_id => $sidebar_label ) {

						register_sidebar( array(
							'name' => $sidebar_label,
							'id' => $sidebar_id,
							'description' => esc_html__( 'To assign this sidebar to a page, set page template to "Sidebar on the Left" or "Sidebar on the Right" and then choose the sidebar under Sidebar Settings of that page. Custom Sidebars can be managed under Customizer / Custom Sidebars.', 'pressville' ),
							'class' => '',
							'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget__inner">',
							'after_widget' => '</div></div>',
							'before_title' => '<h3 class="widget__title"><span>',
							'after_title' => '</span></h3>',
						));

					}
				}

			}
		}

        function mostrar_eventos_lsvr() {
            $current_lang = pll_current_language();
            // Obtener eventos con WP_Query, filtrados automáticamente por idioma actual
            $args = [
                'post_type'      => 'lsvr_event',
                'post_status'    => 'publish',
                'posts_per_page' => 9,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'lang'           => $current_lang, // idioma actual (Polylang lo interpreta)
            ];
        
            $query = new WP_Query($args);
            $eventos = $query->posts;
        
            ob_start();
            ?>
           <style>
    .contenedor-eventos {
        text-align: center;
        padding: 40px 20px;
        font-family: Arial, sans-serif;
    }

    .contenedor-eventos h2 {
        font-size: 3.5rem;
        color: #444;
        margin-bottom: 20px;
    }

    .eventos-slider-container {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .eventos-slider {
        display: flex;
        gap: 30px; /* Espacio entre tarjetas */
        transition: transform 0.5s ease-in-out;
    }

    .evento {
        position: relative;
        background-size: cover;
        background-position: center;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        flex: 0 0 auto; /* Permite un ancho fijo para cada tarjeta */
        width: 450px; /* Ancho deseado */
        height: 320px; /* Altura deseada */
        transition: transform 0.3s ease-in-out;
    }

    .evento::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3); /* Ajusta la opacidad aquí */
        z-index: 1;
        transition: background 0.3s ease-in-out;
    }

    .evento:hover::before {
        background: rgba(0, 0, 0, 0.5); /* Más oscura al pasar el mouse */
    }

    .evento .info-evento {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        color: white;
        padding: 20px;
        z-index: 2; /* Asegúrate de que esté encima del overlay */
        text-align: left;
    }

    .evento .info-evento h3 {
        font-size: 1.2rem;
        margin: 0 0 5px;
        color: white;
    }

    .evento .info-evento p {
        font-size: 0.9rem;
        margin: 0;
    }

    .ver-todos {
        margin-top: 20px;
    }

    .ver-todos a {
        text-decoration: none;
        font-weight: bold;
        color: #359e8e;
        font-size: 1rem;
    }

    .ver-todos a:hover {
        text-decoration: underline;
    }

    .prev-btn, .next-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        cursor: pointer;
        padding: 15px;
        z-index: 10;
        border-radius: 50%;
    }

    .prev-btn { left: 15px; }
    .next-btn { right: 15px; }

    .prev-btn:hover, .next-btn:hover {
        background: rgba(0, 0, 0, 0.8);
    }
    </style>

        
            <?php
            $idioma = function_exists('pll_current_language') ? pll_current_language() : 'es';
        
            $titulo = [
                'es' => 'Eventos',
                'en' => 'Events',
            ];
            $inicio = [
                'es' => 'Inicio',
                'en' => 'Start',
            ];
            $ver_mas = [
                'es' => 'Ver todos los eventos →',
                'en' => 'See all events →',
            ];
            ?>
        
            <div class="contenedor-eventos">
                <h2><?php echo $titulo[$idioma];?></h2>
                <div class="eventos-slider-container">
                    <div class="eventos-slider">
                        <?php if (!$eventos): ?>
                            <p>No hay eventos disponibles.</p>
                        <?php else: ?>
                            <?php foreach ($eventos as $evento): ?>
                                <?php
                                    $start_date = get_post_meta($evento->ID, 'lsvr_event_start_date_utc', true);
                                    $imagen_destacada_url = get_the_post_thumbnail_url($evento->ID, 'medium');
                                    if (!$imagen_destacada_url) {
                                        $imagen_destacada_url = get_template_directory_uri() . '/images/default-event.jpg';
                                    }
                                    $start_date_formatted = $start_date ? date("d M", strtotime($start_date)) : "No disponible";
                                    $evento_url = get_permalink($evento->ID);
                                ?>
                                <a href="<?php echo esc_url($evento_url); ?>" class="evento-link" target="_blank">
                                    <div class="evento" style="background-image: url('<?php echo esc_url($imagen_destacada_url); ?>');">
                                        <div class="info-evento">
                                            <h3><?php echo esc_html($evento->post_title); ?></h3>
                                            <p><strong><?php echo $inicio[$idioma]; ?>:</strong> <?php echo esc_html($start_date_formatted); ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button class="prev-btn">&#10094;</button>
                    <button class="next-btn">&#10095;</button>
                </div>
                <div class="ver-todos">
                    <a href="/index.php/historial-de-eventos/" target="_blank"><?php echo $ver_mas[$idioma]; ?></a>
                </div>
            </div>
        
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    let slider = document.querySelector(".eventos-slider");
                    let prev = document.querySelector(".prev-btn");
                    let next = document.querySelector(".next-btn");
                    let index = 0;
        
                    if (!slider || slider.children.length === 0) return;
        
                    const cardWidth = slider.children[0].offsetWidth + 30;
                    const totalWidth = slider.scrollWidth;
                    const visibleWidth = slider.parentElement.offsetWidth;
                    const maxIndex = Math.ceil((totalWidth - visibleWidth) / cardWidth);
        
                    next.addEventListener("click", function () {
                        if (index < maxIndex) {
                            index++;
                            slider.style.transform = `translateX(-${index * cardWidth}px)`;
                        }
                    });
        
                    prev.addEventListener("click", function () {
                        if (index > 0) {
                            index--;
                            slider.style.transform = `translateX(-${index * cardWidth}px)`;
                        }
                    });
                });
            </script>
            <?php
            return ob_get_clean();
        }
        
        add_shortcode('eventos_lsvr', 'mostrar_eventos_lsvr');
        
    }
    }

    add_action('wp_ajax_buscar_eventos_ajax', 'buscar_eventos_ajax');
add_action('wp_ajax_nopriv_buscar_eventos_ajax', 'buscar_eventos_ajax');

function buscar_eventos_ajax() {
    global $wpdb;

    $term = sanitize_text_field($_GET['term']);

    // Consulta directa a la base de datos para buscar solo en títulos
    $results = $wpdb->get_results(
        $wpdb->prepare("
            SELECT ID, post_title 
            FROM $wpdb->posts 
            WHERE post_type = %s 
                AND post_status = 'publish'
                AND post_title LIKE %s
            ORDER BY post_title ASC
            LIMIT 10
        ", 'lsvr_event', '%' . $wpdb->esc_like($term) . '%')
    );

    $output = [];

    foreach ($results as $row) {
        $output[] = [
            'id' => $row->ID,
            'title' => $row->post_title,
        ];
    }

    wp_send_json($output);
}

    
    
    
    

    