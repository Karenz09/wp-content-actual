<?php
// Elementor class fix
// Remove the "elementor" class from the content wrapper and move it to each non-LSVR element wrapper instead
add_action( 'wp_footer', 'lsvr_3rd_party_toolkit_elementor_js_fix', 100 );
if ( ! function_exists( 'lsvr_3rd_party_toolkit_elementor_js_fix' ) ) {
	function lsvr_3rd_party_toolkit_elementor_js_fix() {

		if ( class_exists( 'Elementor\Plugin' ) && ( is_page() || is_singular() )
			&& ( true === apply_filters( 'lsvr_3rd_party_toolkit_elementor_js_fix_enable', true )
				|| true === apply_filters( 'lsvr_3rd_party_toolkit_elementor_js_fix_enable_post_' . get_the_ID(), false ) ) ) { ?>

    		<script type="text/javascript">
    			(function($){
    				$(document).ready( function() {

    					if ( $( 'body' ).hasClass( 'elementor-page' ) ) {
    						$( '#main .elementor' ).removeClass( 'elementor' );
    						$( '#main .elementor-element' ).each( function() {
    							if ( $(this).hasClass( 'elementor-widget' ) && $(this).prop( 'class' ).indexOf( 'lsvr_' ) < 0 ) {
									$(this).addClass( 'elementor' );
								}
							});
						}

					});
				})(jQuery);
    		</script>

    	<?php }

	}
}

// Register custom category
add_action( 'elementor/elements/categories_registered', 'lsvr_3rd_party_toolkit_register_elementor_category' );
if ( ! function_exists( 'lsvr_3rd_party_toolkit_register_elementor_category' ) ) {
	function lsvr_3rd_party_toolkit_register_elementor_category( $elements_manager ) {

		$elements_manager->add_category(
			'lsvr-elements', array(
				'title' => esc_html__( 'LSVR Elements', 'lsvr-3rd-party-toolkit' ),
			)
		);

		$elements_manager->add_category(
			'lsvr-widgets', array(
				'title' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
			)
		);

		$elements_manager->add_category(
			'lsvr-beautyspot', array(
				'title' => esc_html__( 'BeautySpot', 'lsvr-3rd-party-toolkit' ),
			)
		);

		$elements_manager->add_category(
			'lsvr-bluecollar', array(
				'title' => esc_html__( 'BlueCollar', 'lsvr-3rd-party-toolkit' ),
			)
		);

		$elements_manager->add_category(
			'lsvr-lore', array(
				'title' => esc_html__( 'Lore', 'lsvr-3rd-party-toolkit' ),
			)
		);

		$elements_manager->add_category(
			'lsvr-pressville', array(
				'title' => esc_html__( 'Pressville', 'lsvr-3rd-party-toolkit' ),
			)
		);

		$elements_manager->add_category(
			'lsvr-townpress', array(
				'title' => esc_html__( 'TownPress', 'lsvr-3rd-party-toolkit' ),
			)
		);

		$elements_manager->add_category(
			'lsvr-wordbench', array(
				'title' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
			)
		);

	}
}

// Register basic LSVR elements as Elementor widgets
add_action( 'elementor/widgets/widgets_registered', 'lsvr_3rd_party_toolkit_elementor_config' );
if ( ! function_exists( 'lsvr_3rd_party_toolkit_elementor_config' ) ) {
	function lsvr_3rd_party_toolkit_elementor_config( $widgets_manager ) {

		// LSVR Elements
		if ( function_exists( 'lsvr_elements_register_shortcodes' ) ) {

			// LSVR Alert Message
			if ( class_exists( 'Lsvr_Shortcode_Alert_Message' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-alert-message.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Alert_Message' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Alert_Message );
				}
			}

			// LSVR Button
			if ( class_exists( 'Lsvr_Shortcode_Button' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-button.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Button' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Button );
				}
			}

			// LSVR Counter
			if ( class_exists( 'Lsvr_Shortcode_Counter' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-counter.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Counter' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Counter );
				}
			}

			// LSVR CTA
			if ( class_exists( 'Lsvr_Shortcode_CTA' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-cta.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_CTA' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_CTA );
				}
			}

			// LSVR Definition List Widget
			if ( class_exists( 'Lsvr_Shortcode_Definition_List_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-definition-list-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Definition_List_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Definition_List_Widget );
				}
			}

			// LSVR Feature
			if ( class_exists( 'Lsvr_Shortcode_Feature' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-feature.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Feature' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Feature );
				}
			}

			// LSVR Featured Post Widget
			if ( class_exists( 'Lsvr_Shortcode_Post_Featured_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-post-featured-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Post_Featured_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Post_Featured_Widget );
				}
			}

			// LSVR Posts Widget
			if ( class_exists( 'Lsvr_Shortcode_Post_List_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-post-list-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Post_List_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Post_List_Widget );
				}
			}

			// LSVR Pricing Table
			if ( class_exists( 'Lsvr_Shortcode_Pricing_Table' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-pricing-table.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Pricing_Table' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Pricing_Table );
				}
			}

			// LSVR Progress Bar
			if ( class_exists( 'Lsvr_Shortcode_Progress_Bar' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-progress-bar.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Progress_Bar' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Progress_Bar );
				}
			}

		}

		// LSVR Directory
		if ( function_exists( 'lsvr_directory_register_shortcodes' ) ) {

			// LSVR Listing List Widget
			if ( class_exists( 'Lsvr_Shortcode_Listing_List_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-listing-list-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Listing_List_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Listing_List_Widget );
				}
			}

			// LSVR Featured Listing Widget
			if ( class_exists( 'Lsvr_Shortcode_Listing_Featured_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-listing-featured-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Listing_Featured_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Listing_Featured_Widget );
				}
			}

		}

	 	// LSVR Documents
		if ( function_exists( 'lsvr_documents_register_shortcodes' ) ) {

			// LSVR Documents Widget
			if ( class_exists( 'Lsvr_Shortcode_Document_List_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-document-list-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Document_List_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Document_List_Widget );
				}
			}

			// LSVR Featured Document Widget
			if ( class_exists( 'Lsvr_Shortcode_Document_Featured_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-document-featured-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Document_Featured_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Document_Featured_Widget );
				}
			}

			// LSVR Document Attachments Widget
			if ( class_exists( 'Lsvr_Shortcode_Document_Attachments_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-document-attachments-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Document_Attachments_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Document_Attachments_Widget );
				}
			}

		}

	 	// LSVR Events
		if ( function_exists( 'lsvr_events_register_shortcodes' ) ) {

			// LSVR Event Calendar Widget
			if ( class_exists( 'Lsvr_Shortcode_Event_Calendar_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-event-calendar-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Event_Calendar_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Event_Calendar_Widget );
				}
			}

			// LSVR Event List Widget
			if ( class_exists( 'Lsvr_Shortcode_Event_List_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-event-list-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Event_List_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Event_List_Widget );
				}
			}

			// LSVR Featured Event Widget
			if ( class_exists( 'Lsvr_Shortcode_Event_Featured_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-event-featured-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Event_Featured_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Event_Featured_Widget );
				}
			}

		}

	 	// LSVR FAQ
		if ( function_exists( 'lsvr_faq_register_shortcodes' ) ) {

			// LSVR FAQ List Widget
			if ( class_exists( 'Lsvr_Shortcode_FAQ_List_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-faq-list-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_FAQ_List_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_FAQ_List_Widget );
				}
			}

			// LSVR Featured FAQ Widget
			if ( class_exists( 'Lsvr_Shortcode_FAQ_Featured_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-faq-featured-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_FAQ_Featured_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_FAQ_Featured_Widget );
				}
			}

		}

		// LSVR Galleries
		if ( function_exists( 'lsvr_galleries_register_shortcodes' ) ) {

			// LSVR Gallery List Widget
			if ( class_exists( 'Lsvr_Shortcode_Gallery_List_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-gallery-list-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Gallery_List_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Gallery_List_Widget );
				}
			}

			// LSVR Featured Gallery Widget
			if ( class_exists( 'Lsvr_Shortcode_Gallery_Featured_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-gallery-featured-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Gallery_Featured_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Gallery_Featured_Widget );
				}
			}

		}

		// LSVR Knowledge Base
		if ( function_exists( 'lsvr_knowledge_base_register_shortcodes' ) ) {

			// LSVR KB Articles Widget
			if ( class_exists( 'Lsvr_Shortcode_KBA_List_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-kba-list-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_KBA_List_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_KBA_List_Widget );
				}
			}

			// LSVR Featured KB Article Widget
			if ( class_exists( 'Lsvr_Shortcode_KBA_Featured_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-kba-featured-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_KBA_Featured_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_KBA_Featured_Widget );
				}
			}

		}

		// LSVR Notices
		if ( function_exists( 'lsvr_notices_register_shortcodes' ) ) {

			// LSVR Notices Widget
			if ( class_exists( 'Lsvr_Shortcode_Notice_List_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-notice-list-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Notice_List_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Notice_List_Widget );
				}
			}

		}

		// LSVR People
		if ( function_exists( 'lsvr_people_register_shortcodes' ) ) {

			// LSVR People Widget
			if ( class_exists( 'Lsvr_Shortcode_Person_List_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-person-list-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Person_List_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Person_List_Widget );
				}
			}

			// LSVR Featured Person Widget
			if ( class_exists( 'Lsvr_Shortcode_Person_Featured_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-person-featured-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Person_Featured_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Person_Featured_Widget );
				}
			}

		}

		// LSVR Portfolio
		if ( function_exists( 'lsvr_portfolio_register_shortcodes' ) ) {

			// LSVR Portfolio Widget
			if ( class_exists( 'Lsvr_Shortcode_Project_List_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-project-list-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Project_List_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Project_List_Widget );
				}
			}

			// LSVR Featured Project Widget
			if ( class_exists( 'Lsvr_Shortcode_Project_Featured_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-project-featured-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Project_Featured_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Project_Featured_Widget );
				}
			}

		}

		// LSVR Services
		if ( function_exists( 'lsvr_services_register_shortcodes' ) ) {

			// LSVR Services Widget
			if ( class_exists( 'Lsvr_Shortcode_Service_List_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-service-list-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Service_List_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Service_List_Widget );
				}
			}

			// LSVR Featured Service Widget
			if ( class_exists( 'Lsvr_Shortcode_Service_Featured_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-service-featured-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Service_Featured_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Service_Featured_Widget );
				}
			}

		}

		// LSVR Slides
		if ( function_exists( 'lsvr_slides_register_shortcodes' ) ) {

			// LSVR Slides
			if ( class_exists( 'Lsvr_Shortcode_Slide_List' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-slide-list.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Slide_List' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Slide_List );
				}
			}

		}

		// LSVR Testimonials
		if ( function_exists( 'lsvr_testimonials_register_shortcodes' ) ) {

			// LSVR Testimonials Widget
			if ( class_exists( 'Lsvr_Shortcode_Testimonial_List_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-testimonial-list-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Testimonial_List_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Testimonial_List_Widget );
				}
			}

			// LSVR Featured Testimonial Widget
			if ( class_exists( 'Lsvr_Shortcode_Testimonial_Featured_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-testimonial-featured-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Testimonial_Featured_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Testimonial_Featured_Widget );
				}
			}

		}

	 	// LSVR BeautySpot Toolkit
		if ( function_exists( 'lsvr_beautyspot_toolkit_register_shortcodes' ) ) {

			// BeautySpot CTA
			if ( class_exists( 'Lsvr_Shortcode_Beautyspot_CTA' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-beautyspot-cta.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Beautyspot_CTA' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Beautyspot_CTA );
				}
			}

			// BeautySpot FAQ
			if ( class_exists( 'Lsvr_Shortcode_Beautyspot_FAQ' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-beautyspot-faq.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Beautyspot_FAQ' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Beautyspot_FAQ );
				}
			}

			// BeautySpot Galleries
			if ( class_exists( 'Lsvr_Shortcode_Beautyspot_Galleries' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-beautyspot-galleries.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Beautyspot_Galleries' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Beautyspot_Galleries );
				}
			}

			// BeautySpot Gallery
			if ( class_exists( 'Lsvr_Shortcode_Beautyspot_Gallery' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-beautyspot-gallery.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Beautyspot_Gallery' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Beautyspot_Gallery );
				}
			}

			// BeautySpot Intro
			if ( class_exists( 'Lsvr_Shortcode_Beautyspot_Intro' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-beautyspot-intro.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Beautyspot_Intro' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Beautyspot_Intro );
				}
			}

			// BeautySpot Posts
			if ( class_exists( 'Lsvr_Shortcode_Beautyspot_Posts' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-beautyspot-posts.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Beautyspot_Posts' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Beautyspot_Posts );
				}
			}

			// BeautySpot Services
			if ( class_exists( 'Lsvr_Shortcode_Beautyspot_Services' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-beautyspot-services.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Beautyspot_Services' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Beautyspot_Services );
				}
			}

			// BeautySpot Sidebar
			if ( class_exists( 'Lsvr_Shortcode_Beautyspot_Sidebar' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-beautyspot-sidebar.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Beautyspot_Sidebar' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Beautyspot_Sidebar );
				}
			}

			// BeautySpot Testimonials
			if ( class_exists( 'Lsvr_Shortcode_Beautyspot_Testimonials' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-beautyspot-testimonials.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Beautyspot_Testimonials' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Beautyspot_Testimonials );
				}
			}

		}

	 	// LSVR BlueCollar Toolkit
		if ( function_exists( 'lsvr_bluecollar_toolkit_register_shortcodes' ) ) {

			// BlueCollar CTA
			if ( class_exists( 'Lsvr_Shortcode_Bluecollar_CTA' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-bluecollar-cta.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Bluecollar_CTA' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Bluecollar_CTA );
				}
			}

			// BlueCollar FAQ
			if ( class_exists( 'Lsvr_Shortcode_Bluecollar_FAQ' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-bluecollar-faq.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Bluecollar_FAQ' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Bluecollar_FAQ );
				}
			}

			// BlueCollar Features
			if ( class_exists( 'Lsvr_Shortcode_Bluecollar_Features' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-bluecollar-features.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Bluecollar_Features' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Bluecollar_Features );
				}
			}

			// BlueCollar Galleries
			if ( class_exists( 'Lsvr_Shortcode_Bluecollar_Galleries' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-bluecollar-galleries.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Bluecollar_Galleries' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Bluecollar_Galleries );
				}
			}

			// BlueCollar Intro
			if ( class_exists( 'Lsvr_Shortcode_Bluecollar_Intro' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-bluecollar-intro.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Bluecollar_Intro' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Bluecollar_Intro );
				}
			}

			// BlueCollar Posts
			if ( class_exists( 'Lsvr_Shortcode_Bluecollar_Posts' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-bluecollar-posts.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Bluecollar_Posts' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Bluecollar_Posts );
				}
			}

			// BlueCollar Projects
			if ( class_exists( 'Lsvr_Shortcode_Bluecollar_Projects' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-bluecollar-projects.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Bluecollar_Projects' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Bluecollar_Projects );
				}
			}

			// BlueCollar Services
			if ( class_exists( 'Lsvr_Shortcode_Bluecollar_Services' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-bluecollar-services.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Bluecollar_Services' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Bluecollar_Services );
				}
			}

			// BlueCollar Sidebar
			if ( class_exists( 'Lsvr_Shortcode_Bluecollar_Sidebar' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-bluecollar-sidebar.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Bluecollar_Sidebar' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Bluecollar_Sidebar );
				}
			}

			// BlueCollar Testimonials
			if ( class_exists( 'Lsvr_Shortcode_Bluecollar_Testimonials' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-bluecollar-testimonials.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Bluecollar_Testimonials' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Bluecollar_Testimonials );
				}
			}

		}

	 	// LSVR Lore Toolkit
		if ( function_exists( 'lsvr_lore_toolkit_register_shortcodes' ) ) {

			// Lore CTA Widget
			if ( class_exists( 'Lsvr_Shortcode_Lore_CTA_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-lore-cta-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Lore_CTA_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Lore_CTA_Widget );
				}
			}

			// Lore FAQ
			if ( class_exists( 'Lsvr_Shortcode_Lore_FAQ' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-lore-faq.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Lore_FAQ' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Lore_FAQ );
				}
			}

			// Lore KB Category Widget
			if ( class_exists( 'Lsvr_Shortcode_Lore_KBA_Category_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-lore-kba-category-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Lore_KBA_Category_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Lore_KBA_Category_Widget );
				}
			}


			// Lore Knowledge Base
			if ( class_exists( 'Lsvr_Shortcode_Lore_Knowledge_Base' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-lore-knowledge-base.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Lore_Knowledge_Base' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Lore_Knowledge_Base );
				}
			}

			// Lore Posts
			if ( class_exists( 'Lsvr_Shortcode_Lore_Posts' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-lore-posts.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Lore_Posts' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Lore_Posts );
				}
			}

			// Lore Sidebar
			if ( class_exists( 'Lsvr_Shortcode_Lore_Sidebar' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-lore-sidebar.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Lore_Sidebar' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Lore_Sidebar );
				}
			}

			// Lore Sitemap
			if ( class_exists( 'Lsvr_Shortcode_Lore_Sitemap' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-lore-sitemap.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Lore_Sitemap' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Lore_Sitemap );
				}
			}

			// Lore Table of Contents
			if ( class_exists( 'Lsvr_Shortcode_Lore_TOC' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-lore-toc.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Lore_TOC' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Lore_TOC );
				}
			}

		}

	 	// LSVR Pressville Toolkit
		if ( function_exists( 'lsvr_pressville_toolkit_register_shortcodes' ) ) {

			// Pressville Directory
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Directory' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-pressville-directory.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Pressville_Directory' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Pressville_Directory );
				}
			}

			// Pressville Events
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Events' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-pressville-events.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Pressville_Events' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Pressville_Events );
				}
			}

			// Pressville Galleries
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Galleries' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-pressville-galleries.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Pressville_Galleries' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Pressville_Galleries );
				}
			}

			// Pressville Posts
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Posts' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-pressville-posts.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Pressville_Posts' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Pressville_Posts );
				}
			}

			// Pressville Sidebar
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Sidebar' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-pressville-sidebar.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Pressville_Sidebar' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Pressville_Sidebar );
				}
			}

			// Pressville Sitemap
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Sitemap' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-pressville-sitemap.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Pressville_Sitemap' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Pressville_Sitemap );
				}
			}

			// Pressville Weather Widget
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Weather_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-pressville-weather-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Pressville_Weather_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Pressville_Weather_Widget );
				}
			}

		}

	 	// LSVR TownPress Toolkit
		if ( function_exists( 'lsvr_townpress_toolkit_register_shortcodes' ) ) {

			// TownPress Post Slider
			if ( class_exists( 'Lsvr_Shortcode_Townpress_Post_Slider' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-townpress-post-slider.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Townpress_Post_Slider' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Townpress_Post_Slider );
				}
			}

			// TownPress Posts
			if ( class_exists( 'Lsvr_Shortcode_Townpress_Posts' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-townpress-posts.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Townpress_Posts' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Townpress_Posts );
				}
			}

			// TownPress Sidebar
			if ( class_exists( 'Lsvr_Shortcode_Townpress_Sidebar' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-townpress-sidebar.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Townpress_Sidebar' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Townpress_Sidebar );
				}
			}

			// TownPress Sitemap
			if ( class_exists( 'Lsvr_Shortcode_Townpress_Sitemap' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-townpress-sitemap.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Townpress_Sitemap' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Townpress_Sitemap );
				}
			}

			// TownPress Weather Widget
			if ( class_exists( 'Lsvr_Shortcode_Townpress_Weather_Widget' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-townpress-weather-widget.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Townpress_Weather_Widget' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Townpress_Weather_Widget );
				}
			}

		}

	 	// LSVR Wordbench Toolkit
		if ( function_exists( 'lsvr_wordbench_toolkit_register_shortcodes' ) ) {

			// Wordbench Contact
			if ( class_exists( 'Lsvr_Shortcode_Wordbench_Contact' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-wordbench-contact.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Wordbench_Contact' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Wordbench_Contact );
				}
			}

			// Wordbench Container
			if ( class_exists( 'Lsvr_Shortcode_Wordbench_Container' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-wordbench-container.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Wordbench_Container' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Wordbench_Container );
				}
			}

			// Wordbench Directory
			if ( class_exists( 'Lsvr_Shortcode_Wordbench_Directory' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-wordbench-directory.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Wordbench_Directory' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Wordbench_Directory );
				}
			}

			// Wordbench Documents
			if ( class_exists( 'Lsvr_Shortcode_Wordbench_Documents' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-wordbench-documents.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Wordbench_Documents' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Wordbench_Documents );
				}
			}

			// Wordbench Events
			if ( class_exists( 'Lsvr_Shortcode_Wordbench_Events' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-wordbench-events.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Wordbench_Events' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Wordbench_Events );
				}
			}

			// Wordbench FAQ
			if ( class_exists( 'Lsvr_Shortcode_Wordbench_FAQ' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-wordbench-faq.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Wordbench_FAQ' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Wordbench_FAQ );
				}
			}

			// Wordbench Hero
			if ( class_exists( 'Lsvr_Shortcode_Wordbench_Hero' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-wordbench-hero.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Wordbench_Hero' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Wordbench_Hero );
				}
			}

			// Wordbench People
			if ( class_exists( 'Lsvr_Shortcode_Wordbench_People' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-wordbench-people.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Wordbench_People' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Wordbench_People );
				}
			}

			// Wordbench Portfolio
			if ( class_exists( 'Lsvr_Shortcode_Wordbench_Portfolio' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-wordbench-portfolio.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Wordbench_Portfolio' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Wordbench_Portfolio );
				}
			}

			// Wordbench Posts
			if ( class_exists( 'Lsvr_Shortcode_Wordbench_Posts' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-wordbench-posts.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Wordbench_Posts' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Wordbench_Posts );
				}
			}

			// Wordbench Services
			if ( class_exists( 'Lsvr_Shortcode_Wordbench_Services' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-wordbench-services.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Wordbench_Services' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Wordbench_Services );
				}
			}

			// Wordbench Sidebar
			if ( class_exists( 'Lsvr_Shortcode_Wordbench_Sidebar' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-wordbench-sidebar.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Wordbench_Sidebar' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Wordbench_Sidebar );
				}
			}

			// Wordbench Sitemap
			if ( class_exists( 'Lsvr_Shortcode_Wordbench_Sitemap' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-wordbench-sitemap.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Wordbench_Sitemap' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Wordbench_Sitemap );
				}
			}

			// Wordbench Slider
			if ( class_exists( 'Lsvr_Shortcode_Wordbench_Slider' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-wordbench-slider.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Wordbench_Slider' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Wordbench_Slider );
				}
			}

			// Wordbench Split Screen
			if ( class_exists( 'Lsvr_Shortcode_Wordbench_Splitscreen' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-wordbench-splitscreen.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Wordbench_Splitscreen' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Wordbench_Splitscreen );
				}
			}

			// Wordbench Testimonials
			if ( class_exists( 'Lsvr_Shortcode_Wordbench_Testimonials' ) ) {
				require_once( 'classes/elementor-widgets/lsvr-elementor-widget-wordbench-testimonials.php' );
			 	if ( class_exists( 'Lsvr_Elementor_Widget_Wordbench_Testimonials' ) ) {
					$widgets_manager->register_widget_type( new Lsvr_Elementor_Widget_Wordbench_Testimonials );
				}
			}

		}

	}
}

?>