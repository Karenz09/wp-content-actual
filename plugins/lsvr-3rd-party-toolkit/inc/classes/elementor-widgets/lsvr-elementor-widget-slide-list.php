<?php
/**
 * LSVR Slides Elementor Widget
 */
if ( ! class_exists( 'Lsvr_Elementor_Widget_Slide_List' ) ) {
    class Lsvr_Elementor_Widget_Slide_List extends \Elementor\Widget_Base {

		public function get_name() {
			return 'lsvr_slide_list';
		}

		public function get_title() {
			return esc_html__( 'LSVR Slides', 'lsvr-3rd-party-toolkit' );
		}

		public function get_icon() {
			return 'fa fa-window-maximize';
		}

		public function get_categories() {
			return [ 'lsvr-elements' ];
		}

		protected function _register_controls() {

			$this->start_controls_section(
				'content_section', array(
					'label' => esc_html__( 'LSVR Slides', 'lsvr-3rd-party-toolkit' ),
				)
			);

			lsvr_3rd_party_toolkit_shortcode_atts_to_elementor_settings( $this, Lsvr_Shortcode_Slide_List::lsvr_shortcode_atts() );

			$this->end_controls_section();

		}

		protected function render() {

			lsvr_3rd_party_toolkit_elementor_settings_to_shortcode(
				new Lsvr_Shortcode_Slide_List,
				Lsvr_Shortcode_Slide_List::lsvr_shortcode_atts(),
				$this->get_settings_for_display()
			);

		}

    }
}
?>