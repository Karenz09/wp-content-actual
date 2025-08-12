<?php // Config Visual Composer Page Builder
add_action( 'plugins_loaded', 'lsvr_3rd_party_toolkit_vc_config' );
if ( ! function_exists( 'lsvr_3rd_party_toolkit_vc_config' ) ) {
	function lsvr_3rd_party_toolkit_vc_config() {

		if ( function_exists( 'vc_set_as_theme' ) && function_exists( 'lsvr_3rd_party_toolkit_vc_map' ) ) {

			// Set as theme
			add_action( 'vc_before_init', 'lsvr_3rd_party_toolkit_vc_init' );
			if ( ! function_exists( 'lsvr_3rd_party_toolkit_vc_init' ) && function_exists( 'vc_set_as_theme' ) ) {
				function lsvr_3rd_party_toolkit_vc_init() {
					vc_set_as_theme();
				}
			}

			// Register basic LSVR elements as VC elements
			add_action( 'init', 'lsvr_3rd_party_toolkit_register_vc_elements' );
			if ( ! function_exists( 'lsvr_3rd_party_toolkit_register_vc_elements' ) ) {
				function lsvr_3rd_party_toolkit_register_vc_elements() {

				 	// LSVR Elements
				 	if ( function_exists( 'lsvr_elements_register_shortcodes' ) ) {

						// LSVR Alert Message
						if ( class_exists( 'Lsvr_Shortcode_Alert_Message' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_alert_message',
				                'name' => esc_html__( 'LSVR Alert Message', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Block with text', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Elements', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Alert_Message::lsvr_shortcode_atts(),
							));
						}

						// LSVR Button
						if ( class_exists( 'Lsvr_Shortcode_Button' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_button',
				                'name' => esc_html__( 'LSVR Button', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Basic button with link', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Elements', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Button::lsvr_shortcode_atts(),
							));
						}

						// LSVR Counter
						if ( class_exists( 'Lsvr_Shortcode_Counter' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_counter',
				                'name' => esc_html__( 'LSVR Counter', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Block with number and label', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Elements', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Counter::lsvr_shortcode_atts(),
							));
						}

						// LSVR CTA
						if ( class_exists( 'Lsvr_Shortcode_CTA' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_cta',
				                'name' => esc_html__( 'LSVR CTA', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Block with title, text and button', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Elements', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_CTA::lsvr_shortcode_atts(),
							));
						}

						// LSVR Definition List Widget
						if ( class_exists( 'Lsvr_Shortcode_Definition_List_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_definition_list_widget',
				                'name' => esc_html__( 'LSVR Definition List Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of definitions', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Definition_List_Widget::lsvr_shortcode_atts(),
							));
						}

						// LSVR Feature
						if ( class_exists( 'Lsvr_Shortcode_Feature' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_feature',
				                'name' => esc_html__( 'LSVR Feature', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Block with icon, title and text', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Elements', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Feature::lsvr_shortcode_atts(),
							));
						}

						// LSVR Featured Post Widget
						if ( class_exists( 'Lsvr_Shortcode_Post_Featured_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_post_featured_widget',
				                'name' => esc_html__( 'LSVR Featured Post Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Single post', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Post_Featured_Widget::lsvr_shortcode_atts(),
							));
						}

						// LSVR Posts Widget
						if ( class_exists( 'Lsvr_Shortcode_Post_List_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_post_list_widget',
				                'name' => esc_html__( 'LSVR Posts Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Post_List_Widget::lsvr_shortcode_atts(),
							));
						}

						// LSVR Pricing Table
						if ( class_exists( 'Lsvr_Shortcode_Pricing_Table' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_pricing_table',
				                'name' => esc_html__( 'LSVR Pricing Table', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Block with title, price, text and button', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Elements', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Pricing_Table::lsvr_shortcode_atts(),
							));
						}

						// LSVR Progress Bar
						if ( class_exists( 'Lsvr_Shortcode_Progress_bar' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_progress_bar',
				                'name' => esc_html__( 'LSVR Progress Bar', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Block with title and label', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Elements', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Progress_bar::lsvr_shortcode_atts(),
							));
						}

					}

					// LSVR Directory
					if ( function_exists( 'lsvr_directory_register_shortcodes' ) ) {

						// LSVR Listing List Widget
						if ( class_exists( 'Lsvr_Shortcode_Listing_List_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_listing_list_widget',
				                'name' => esc_html__( 'LSVR Directory Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of listing posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Listing_List_Widget::lsvr_shortcode_atts(),
							));
						}

						// LSVR Featured Listing Widget
						if ( class_exists( 'Lsvr_Shortcode_Listing_Featured_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_listing_featured_widget',
				                'name' => esc_html__( 'LSVR Featured Listing Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Single listing post', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Listing_Featured_Widget::lsvr_shortcode_atts(),
							));
						}

					}

				 	// LSVR Documents
					if ( function_exists( 'lsvr_documents_register_shortcodes' ) ) {

						// LSVR Documents Widget
						if ( class_exists( 'Lsvr_Shortcode_Document_List_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_document_list_widget',
				                'name' => esc_html__( 'LSVR Documents Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of document posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Document_List_Widget::lsvr_shortcode_atts(),
							));
						}

						// LSVR Featured Document Widget
						if ( class_exists( 'Lsvr_Shortcode_Document_Featured_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_document_featured_widget',
				                'name' => esc_html__( 'LSVR Featured Document Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Single document post', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Document_Featured_Widget::lsvr_shortcode_atts(),
							));
						}

						// LSVR Document Attachments Widget
						if ( class_exists( 'Lsvr_Shortcode_Document_Attachments_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_document_attachments_widget',
				                'name' => esc_html__( 'LSVR Document Attachments Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of attachments', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Document_Attachments_Widget::lsvr_shortcode_atts(),
							));
						}

					}

				 	// LSVR Events
					if ( function_exists( 'lsvr_events_register_shortcodes' ) ) {

						// LSVR Event Calendar Widget
						if ( class_exists( 'Lsvr_Shortcode_Event_Calendar_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_event_calendar_widget',
				                'name' => esc_html__( 'LSVR Event Calendar', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Calendar view of event posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Event_Calendar_Widget::lsvr_shortcode_atts(),
							));
						}

						// LSVR Event List Widget
						if ( class_exists( 'Lsvr_Shortcode_Event_List_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_event_list_widget',
				                'name' => esc_html__( 'LSVR Events Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of event posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Event_List_Widget::lsvr_shortcode_atts(),
							));
						}

						// LSVR Featured Event Widget
						if ( class_exists( 'Lsvr_Shortcode_Event_Featured_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_event_featured_widget',
				                'name' => esc_html__( 'LSVR Featured Event Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Single event post', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Event_Featured_Widget::lsvr_shortcode_atts(),
							));
						}

					}

				 	// LSVR FAQ
					if ( function_exists( 'lsvr_faq_register_shortcodes' ) ) {

						// LSVR FAQ List Widget
						if ( class_exists( 'Lsvr_Shortcode_FAQ_List_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_faq_list_widget',
				                'name' => esc_html__( 'LSVR FAQ Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of FAQ posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_FAQ_List_Widget::lsvr_shortcode_atts(),
							));
						}

						// LSVR Featured FAQ Widget
						if ( class_exists( 'Lsvr_Shortcode_FAQ_Featured_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_faq_featured_widget',
				                'name' => esc_html__( 'LSVR Featured FAQ Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Single FAQ post', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_FAQ_Featured_Widget::lsvr_shortcode_atts(),
							));
						}

					}

					// LSVR Galleries
					if ( function_exists( 'lsvr_galleries_register_shortcodes' ) ) {

						// LSVR Gallery List Widget
						if ( class_exists( 'Lsvr_Shortcode_Gallery_List_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_gallery_list_widget',
				                'name' => esc_html__( 'LSVR Galleries Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of gallery posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Gallery_List_Widget::lsvr_shortcode_atts(),
							));
						}

						// LSVR Featured Gallery Widget
						if ( class_exists( 'Lsvr_Shortcode_Gallery_Featured_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_gallery_featured_widget',
				                'name' => esc_html__( 'LSVR Featured Gallery Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Single gallery post', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Gallery_Featured_Widget::lsvr_shortcode_atts(),
							));
						}

					}

					// LSVR Knowledge Base
					if ( function_exists( 'lsvr_knowledge_base_register_shortcodes' ) ) {

						// LSVR KB Articles Widget
						if ( class_exists( 'Lsvr_Shortcode_KBA_List_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_kba_list_widget',
				                'name' => esc_html__( 'LSVR KB Articles Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of KB posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_KBA_List_Widget::lsvr_shortcode_atts(),
							));
						}

						// LSVR Featured KB Article Widget
						if ( class_exists( 'Lsvr_Shortcode_KBA_Featured_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_kba_featured_widget',
				                'name' => esc_html__( 'LSVR Featured KB Article Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Single KB article', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_KBA_Featured_Widget::lsvr_shortcode_atts(),
							));
						}

					}

					// LSVR Notices
					if ( function_exists( 'lsvr_notices_register_shortcodes' ) ) {

						// LSVR Notices Widget
						if ( class_exists( 'Lsvr_Shortcode_Notice_List_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_notice_list_widget',
				                'name' => esc_html__( 'LSVR Notices Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of notice posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Notice_List_Widget::lsvr_shortcode_atts(),
							));
						}

					}

					// LSVR People
					if ( function_exists( 'lsvr_people_register_shortcodes' ) ) {

						// LSVR People Widget
						if ( class_exists( 'Lsvr_Shortcode_Person_List_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_person_list_widget',
				                'name' => esc_html__( 'LSVR People Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of person posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Person_List_Widget::lsvr_shortcode_atts(),
							));
						}

						// LSVR Featured Person Widget
						if ( class_exists( 'Lsvr_Shortcode_Person_Featured_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_person_featured_widget',
				                'name' => esc_html__( 'LSVR Featured Person Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Single person post', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Person_Featured_Widget::lsvr_shortcode_atts(),
							));
						}

					}

					// LSVR Portfolio
					if ( function_exists( 'lsvr_portfolio_register_shortcodes' ) ) {

						// LSVR Portfolio Widget
						if ( class_exists( 'Lsvr_Shortcode_Project_List_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_project_list_widget',
				                'name' => esc_html__( 'LSVR Portfolio Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of project posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Project_List_Widget::lsvr_shortcode_atts(),
							));
						}

						// LSVR Featured Project Widget
						if ( class_exists( 'Lsvr_Shortcode_Project_Featured_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_project_featured_widget',
				                'name' => esc_html__( 'LSVR Featured Project Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Single project post', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Project_Featured_Widget::lsvr_shortcode_atts(),
							));
						}

					}

					// LSVR Services
					if ( function_exists( 'lsvr_services_register_shortcodes' ) ) {

						// LSVR Services Widget
						if ( class_exists( 'Lsvr_Shortcode_Service_List_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_service_list_widget',
				                'name' => esc_html__( 'LSVR Services Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of service posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Service_List_Widget::lsvr_shortcode_atts(),
							));
						}

						// LSVR Featured Service Widget
						if ( class_exists( 'Lsvr_Shortcode_Service_Featured_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_service_featured_widget',
				                'name' => esc_html__( 'LSVR Featured Service Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Single service post', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Service_Featured_Widget::lsvr_shortcode_atts(),
							));
						}

					}

					// LSVR Slides
					if ( function_exists( 'lsvr_slides_register_shortcodes' ) ) {

						// LSVR Slides
						if ( class_exists( 'Lsvr_Shortcode_Slide_List' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_slide_list',
				                'name' => esc_html__( 'LSVR Slides', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of slides', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Elements', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Slide_List::lsvr_shortcode_atts(),
							));
						}

					}

					// LSVR Testimonials
					if ( function_exists( 'lsvr_testimonials_register_shortcodes' ) ) {

						// LSVR Testimonials Widget
						if ( class_exists( 'Lsvr_Shortcode_Testimonial_List_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_testimonial_list_widget',
				                'name' => esc_html__( 'LSVR Testimonials Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of testimonial posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Testimonial_List_Widget::lsvr_shortcode_atts(),
							));
						}

						// LSVR Featured Testimonial Widget
						if ( class_exists( 'Lsvr_Shortcode_Testimonial_Featured_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_testimonial_featured_widget',
				                'name' => esc_html__( 'LSVR Featured Testimonial Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Single testimonial post', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'LSVR Widgets', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Testimonial_Featured_Widget::lsvr_shortcode_atts(),
							));
						}

					}

				 	// LSVR BeautySpot Toolkit
					if ( function_exists( 'lsvr_beautyspot_toolkit_register_shortcodes' ) ) {

						// BeautySpot CTA
						if ( class_exists( 'Lsvr_Shortcode_Beautyspot_CTA' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_beautyspot_cta',
				                'name' => esc_html__( 'BeautySpot CTA', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Block with title, text and button', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BeautySpot', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Beautyspot_CTA::lsvr_shortcode_atts(),
							));
						}

						// BeautySpot FAQ
						if ( class_exists( 'Lsvr_Shortcode_Beautyspot_FAQ' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_beautyspot_faq',
				                'name' => esc_html__( 'BeautySpot FAQ', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of FAQ posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BeautySpot', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Beautyspot_FAQ::lsvr_shortcode_atts(),
							));
						}

						// BeautySpot Galleries
						if ( class_exists( 'Lsvr_Shortcode_Beautyspot_Galleries' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_beautyspot_galleries',
				                'name' => esc_html__( 'BeautySpot Galleries', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of galleries', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BeautySpot', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Beautyspot_Galleries::lsvr_shortcode_atts(),
							));
						}

						// BeautySpot Gallery
						if ( class_exists( 'Lsvr_Shortcode_Beautyspot_Gallery' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_beautyspot_gallery',
				                'name' => esc_html__( 'BeautySpot Gallery', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of gallery images', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BeautySpot', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Beautyspot_Gallery::lsvr_shortcode_atts(),
							));
						}

						// BeautySpot Intro
						if ( class_exists( 'Lsvr_Shortcode_Beautyspot_Intro' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_beautyspot_intro',
				                'name' => esc_html__( 'BeautySpot Intro', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Section with image and text', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BeautySpot', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Beautyspot_Intro::lsvr_shortcode_atts(),
							));
						}

						// BeautySpot Posts
						if ( class_exists( 'Lsvr_Shortcode_Beautyspot_Posts' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_beautyspot_posts',
				                'name' => esc_html__( 'BeautySpot Posts', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BeautySpot', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Beautyspot_Posts::lsvr_shortcode_atts(),
							));
						}

						// BeautySpot Services
						if ( class_exists( 'Lsvr_Shortcode_Beautyspot_Services' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_beautyspot_services',
				                'name' => esc_html__( 'BeautySpot Services', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of services', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BeautySpot', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Beautyspot_Services::lsvr_shortcode_atts(),
							));
						}

						// BeautySpot Sidebar
						if ( class_exists( 'Lsvr_Shortcode_Beautyspot_Sidebar' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_beautyspot_sidebar',
				                'name' => esc_html__( 'BeautySpot Sidebar', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Sidebar with widgets', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BeautySpot', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Beautyspot_Sidebar::lsvr_shortcode_atts(),
							));
						}

						// BeautySpot Testimonials
						if ( class_exists( 'Lsvr_Shortcode_Beautyspot_Testimonials' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_beautyspot_testimonials',
				                'name' => esc_html__( 'BeautySpot Testimonials', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of testimonials', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BeautySpot', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Beautyspot_Testimonials::lsvr_shortcode_atts(),
							));
						}

					}

				 	// LSVR BlueCollar Toolkit
					if ( function_exists( 'lsvr_bluecollar_toolkit_register_shortcodes' ) ) {

						// BlueCollar CTA
						if ( class_exists( 'Lsvr_Shortcode_Bluecollar_CTA' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_bluecollar_cta',
				                'name' => esc_html__( 'BlueCollar CTA', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Block with title, text and button', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BlueCollar', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Bluecollar_CTA::lsvr_shortcode_atts(),
							));
						}

						// BlueCollar FAQ
						if ( class_exists( 'Lsvr_Shortcode_Bluecollar_FAQ' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_bluecollar_faq',
				                'name' => esc_html__( 'BlueCollar FAQ', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of FAQ posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BlueCollar', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Bluecollar_FAQ::lsvr_shortcode_atts(),
							));
						}

						// BlueCollar Features
						if ( class_exists( 'Lsvr_Shortcode_Bluecollar_Features' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_bluecollar_features',
				                'name' => esc_html__( 'BlueCollar Features', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Blocks with icon, title and text', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BlueCollar', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Bluecollar_Features::lsvr_shortcode_atts(),
							));
						}

						// BlueCollar Galleries
						if ( class_exists( 'Lsvr_Shortcode_Bluecollar_Galleries' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_bluecollar_galleries',
				                'name' => esc_html__( 'BlueCollar Galleries', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of galleries', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BlueCollar', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Bluecollar_Galleries::lsvr_shortcode_atts(),
							));
						}

						// BlueCollar Intro
						if ( class_exists( 'Lsvr_Shortcode_Bluecollar_Intro' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_bluecollar_intro',
				                'name' => esc_html__( 'BlueCollar Intro', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Section with image and text', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BlueCollar', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Bluecollar_Intro::lsvr_shortcode_atts(),
							));
						}

						// BlueCollar Posts
						if ( class_exists( 'Lsvr_Shortcode_Bluecollar_Posts' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_bluecollar_posts',
				                'name' => esc_html__( 'BlueCollar Posts', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BlueCollar', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Bluecollar_Posts::lsvr_shortcode_atts(),
							));
						}

						// BlueCollar Projects
						if ( class_exists( 'Lsvr_Shortcode_Bluecollar_Projects' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_bluecollar_projects',
				                'name' => esc_html__( 'BlueCollar Portfolio', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of portfolio projects', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BlueCollar', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Bluecollar_Projects::lsvr_shortcode_atts(),
							));
						}

						// BlueCollar Services
						if ( class_exists( 'Lsvr_Shortcode_Bluecollar_Services' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_bluecollar_services',
				                'name' => esc_html__( 'BlueCollar Services', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of services', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BlueCollar', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Bluecollar_Services::lsvr_shortcode_atts(),
							));
						}

						// BlueCollar Sidebar
						if ( class_exists( 'Lsvr_Shortcode_Bluecollar_Sidebar' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_bluecollar_sidebar',
				                'name' => esc_html__( 'BlueCollar Sidebar', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Sidebar with widgets', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BlueCollar', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Bluecollar_Sidebar::lsvr_shortcode_atts(),
							));
						}

						// BlueCollar Testimonials
						if ( class_exists( 'Lsvr_Shortcode_Bluecollar_Testimonials' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_bluecollar_testimonials',
				                'name' => esc_html__( 'BlueCollar Testimonials', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of testimonials', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'BlueCollar', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Bluecollar_Testimonials::lsvr_shortcode_atts(),
							));
						}

					}

				 	// LSVR Lore Toolkit
					if ( function_exists( 'lsvr_lore_toolkit_register_shortcodes' ) ) {

						// Lore CTA Widget
						if ( class_exists( 'Lsvr_Shortcode_Lore_CTA_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_lore_cta_widget',
				                'name' => esc_html__( 'Lore CTA Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Block with title, text and link', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Lore', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Lore_CTA_Widget::lsvr_shortcode_atts(),
							));
						}

						// Lore FAQ
						if ( class_exists( 'Lsvr_Shortcode_Lore_FAQ' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_lore_faq',
				                'name' => esc_html__( 'Lore FAQ', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of FAQ posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Lore', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Lore_FAQ::lsvr_shortcode_atts(),
							));
						}

						// Lore KB Category Widget
						if ( class_exists( 'Lsvr_Shortcode_Lore_KBA_Category_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_lore_kba_category_widget',
				                'name' => esc_html__( 'Lore KB Category Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'KB category with articles', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Lore', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Lore_KBA_Category_Widget::lsvr_shortcode_atts(),
							));
						}

						// Lore Knowledge Base
						if ( class_exists( 'Lsvr_Shortcode_Lore_Knowledge_Base' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_lore_knowledge_base',
				                'name' => esc_html__( 'Lore Knowledge Base', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Grid of categorized KB articles', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Lore', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Lore_Knowledge_Base::lsvr_shortcode_atts(),
							));
						}

						// Lore Posts
						if ( class_exists( 'Lsvr_Shortcode_Lore_Posts' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_lore_posts',
				                'name' => esc_html__( 'Lore Posts', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Lore', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Lore_Posts::lsvr_shortcode_atts(),
							));
						}

						// Lore Sidebar
						if ( class_exists( 'Lsvr_Shortcode_Lore_Sidebar' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_lore_sidebar',
				                'name' => esc_html__( 'Lore Sidebar', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Sidebar with widgets', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Lore', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Lore_Sidebar::lsvr_shortcode_atts(),
							));
						}

						// Lore Sitemap
						if ( class_exists( 'Lsvr_Shortcode_Lore_Sitemap' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_lore_sitemap',
				                'name' => esc_html__( 'Lore Sitemap', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Custom menu', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Lore', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Lore_Sitemap::lsvr_shortcode_atts(),
							));
						}

						// Lore Sitemap
						if ( class_exists( 'Lsvr_Shortcode_Lore_TOC' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_lore_toc',
				                'name' => esc_html__( 'Lore Table of Contents', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of anchored headings', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Lore', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Lore_TOC::lsvr_shortcode_atts(),
							));
						}

					}

				 	// LSVR Pressville Toolkit
					if ( function_exists( 'lsvr_pressville_toolkit_register_shortcodes' ) ) {

						// Pressville Container
						if ( class_exists( 'Lsvr_Shortcode_Pressville_Container' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_pressville_container',
				                'name' => esc_html__( 'Pressville Container', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Container with fixed max width', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Pressville', 'lsvr-3rd-party-toolkit' ),
				                'has_content' => true,
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Pressville_Container::lsvr_shortcode_atts(),
							));
						}

						// Pressville Directory
						if ( class_exists( 'Lsvr_Shortcode_Pressville_Directory' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_pressville_directory',
				                'name' => esc_html__( 'Pressville Directory', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of Listings', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Pressville', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Pressville_Directory::lsvr_shortcode_atts(),
							));
						}

						// Pressville Events
						if ( class_exists( 'Lsvr_Shortcode_Pressville_Events' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_pressville_events',
				                'name' => esc_html__( 'Pressville Events', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of Events', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Pressville', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Pressville_Events::lsvr_shortcode_atts(),
							));
						}

						// Pressville Galleries
						if ( class_exists( 'Lsvr_Shortcode_Pressville_Galleries' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_pressville_galleries',
				                'name' => esc_html__( 'Pressville Galleries', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of Galleries', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Pressville', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Pressville_Galleries::lsvr_shortcode_atts(),
							));
						}

						// Pressville Posts
						if ( class_exists( 'Lsvr_Shortcode_Pressville_Posts' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_pressville_posts',
				                'name' => esc_html__( 'Pressville Posts', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of Posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Pressville', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Pressville_Posts::lsvr_shortcode_atts(),
							));
						}

						// Pressville Sidebar
						if ( class_exists( 'Lsvr_Shortcode_Pressville_Sidebar' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_pressville_sidebar',
				                'name' => esc_html__( 'Pressville Sidebar', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Sidebar with widgets', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Pressville', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Pressville_Sidebar::lsvr_shortcode_atts(),
							));
						}

						// Pressville Sitemap
						if ( class_exists( 'Lsvr_Shortcode_Pressville_Sitemap' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_pressville_sitemap',
				                'name' => esc_html__( 'Pressville Sitemap', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Custom menu', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Pressville', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Pressville_Sitemap::lsvr_shortcode_atts(),
							));
						}

						// Pressville Weather Widget
						if ( class_exists( 'Lsvr_Shortcode_Pressville_Weather_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_pressville_weather_widget',
				                'name' => esc_html__( 'Pressville Weather Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Weather forecast', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Pressville', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Pressville_Weather_Widget::lsvr_shortcode_atts(),
							));
						}

					}

				 	// LSVR TownPress Toolkit
					if ( function_exists( 'lsvr_townpress_toolkit_register_shortcodes' ) ) {

						// TownPress Post Slider
						if ( class_exists( 'Lsvr_Shortcode_Townpress_Post_Slider' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_townpress_post_slider',
				                'name' => esc_html__( 'TownPress Post Slider', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of posts in a slider', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'TownPress', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Townpress_Post_Slider::lsvr_shortcode_atts(),
							));
						}

						// TownPress Posts
						if ( class_exists( 'Lsvr_Shortcode_Townpress_Posts' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_townpress_posts',
				                'name' => esc_html__( 'TownPress Posts', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'List of posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'TownPress', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Townpress_Posts::lsvr_shortcode_atts(),
							));
						}

						// TownPress Sidebar
						if ( class_exists( 'Lsvr_Shortcode_Townpress_Sidebar' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_townpress_sidebar',
				                'name' => esc_html__( 'TownPress Sidebar', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Sidebar with widgets', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'TownPress', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Townpress_Sidebar::lsvr_shortcode_atts(),
							));
						}

						// TownPress Sitemap
						if ( class_exists( 'Lsvr_Shortcode_Townpress_Sitemap' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_townpress_sitemap',
				                'name' => esc_html__( 'TownPress Sitemap', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Custom menu', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'TownPress', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Townpress_Sitemap::lsvr_shortcode_atts(),
							));
						}

						// TownPress Weather Widget
						if ( class_exists( 'Lsvr_Shortcode_Townpress_Weather_Widget' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_townpress_weather_widget',
				                'name' => esc_html__( 'TownPress Weather Widget', 'lsvr-3rd-party-toolkit' ),
				                'description' => esc_html__( 'Weather forecast', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'TownPress', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Townpress_Weather_Widget::lsvr_shortcode_atts(),
							));
						}

					}

				 	// LSVR Wordbench Toolkit
					if ( function_exists( 'lsvr_wordbench_toolkit_register_shortcodes' ) ) {

						// Wordbench Contact
						if ( class_exists( 'Lsvr_Shortcode_Wordbench_Contact' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_wordbench_contact',
				                'name' => esc_html__( 'Wordbench Contact', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Wordbench_Contact::lsvr_shortcode_atts(),
							));
						}

						// Wordbench Container
						if ( class_exists( 'Lsvr_Shortcode_Wordbench_Container' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_wordbench_container',
				                'name' => esc_html__( 'Wordbench Container', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Wordbench_Container::lsvr_shortcode_atts(),
							));
						}

						// Wordbench Directory
						if ( class_exists( 'Lsvr_Shortcode_Wordbench_Directory' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_wordbench_directory',
				                'name' => esc_html__( 'Wordbench Directory', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Wordbench_Directory::lsvr_shortcode_atts(),
							));
						}

						// Wordbench Documents
						if ( class_exists( 'Lsvr_Shortcode_Wordbench_Documents' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_wordbench_documents',
				                'name' => esc_html__( 'Wordbench Documents', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Wordbench_Documents::lsvr_shortcode_atts(),
							));
						}

						// Wordbench Events
						if ( class_exists( 'Lsvr_Shortcode_Wordbench_Events' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_wordbench_events',
				                'name' => esc_html__( 'Wordbench Events', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Wordbench_Events::lsvr_shortcode_atts(),
							));
						}

						// Wordbench FAQ
						if ( class_exists( 'Lsvr_Shortcode_Wordbench_FAQ' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_wordbench_faq',
				                'name' => esc_html__( 'Wordbench FAQ', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Wordbench_FAQ::lsvr_shortcode_atts(),
							));
						}

						// Wordbench Hero
						if ( class_exists( 'Lsvr_Shortcode_Wordbench_Hero' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_wordbench_hero',
				                'name' => esc_html__( 'Wordbench Hero', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Wordbench_Hero::lsvr_shortcode_atts(),
							));
						}

						// Wordbench People
						if ( class_exists( 'Lsvr_Shortcode_Wordbench_People' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_wordbench_people',
				                'name' => esc_html__( 'Wordbench People', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Wordbench_People::lsvr_shortcode_atts(),
							));
						}

						// Wordbench Portfolio
						if ( class_exists( 'Lsvr_Shortcode_Wordbench_Portfolio' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_wordbench_portfolio',
				                'name' => esc_html__( 'Wordbench Portfolio', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Wordbench_Portfolio::lsvr_shortcode_atts(),
							));
						}

						// Wordbench Posts
						if ( class_exists( 'Lsvr_Shortcode_Wordbench_Posts' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_wordbench_posts',
				                'name' => esc_html__( 'Wordbench Posts', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Wordbench_Posts::lsvr_shortcode_atts(),
							));
						}

						// Wordbench Services
						if ( class_exists( 'Lsvr_Shortcode_Wordbench_Services' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_wordbench_services',
				                'name' => esc_html__( 'Wordbench Services', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Wordbench_Services::lsvr_shortcode_atts(),
							));
						}

						// Wordbench Sidebar
						if ( class_exists( 'Lsvr_Shortcode_Wordbench_Sidebar' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_wordbench_sidebar',
				                'name' => esc_html__( 'Wordbench Sidebar', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Wordbench_Sidebar::lsvr_shortcode_atts(),
							));
						}

						// Wordbench Sitemap
						if ( class_exists( 'Lsvr_Shortcode_Wordbench_Sitemap' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_wordbench_sitemap',
				                'name' => esc_html__( 'Wordbench Sitemap', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Wordbench_Sitemap::lsvr_shortcode_atts(),
							));
						}

						// Wordbench Slider
						if ( class_exists( 'Lsvr_Shortcode_Wordbench_Slider' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_wordbench_slider',
				                'name' => esc_html__( 'Wordbench Slider', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Wordbench_Slider::lsvr_shortcode_atts(),
							));
						}

						// Wordbench Split Screen
						if ( class_exists( 'Lsvr_Shortcode_Wordbench_Splitscreen' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_wordbench_splitscreen',
				                'name' => esc_html__( 'Wordbench Split Screen', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Wordbench_Splitscreen::lsvr_shortcode_atts(),
							));
						}

						// Wordbench Testimonials
						if ( class_exists( 'Lsvr_Shortcode_Wordbench_Testimonials' ) ) {
							lsvr_3rd_party_toolkit_vc_map(array(
				                'base' => 'lsvr_wordbench_testimonials',
				                'name' => esc_html__( 'Wordbench Testimonials', 'lsvr-3rd-party-toolkit' ),
				                'category' => esc_html__( 'Wordbench', 'lsvr-3rd-party-toolkit' ),
				                'content_element' => true,
				                'show_settings_on_create' => true,
				                'params' => Lsvr_Shortcode_Wordbench_Testimonials::lsvr_shortcode_atts(),
							));
						}

					}

				}
			}

		}

	}
}
?>