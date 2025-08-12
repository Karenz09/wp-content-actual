<?php
/**
 * Lore CTA Widget Elementor Widget
 */
if ( ! class_exists( 'Lsvr_Elementor_Widget_Lore_CTA_Widget' ) ) {
    class Lsvr_Elementor_Widget_Lore_CTA_Widget extends \Elementor\Widget_Base {

		public function get_name() {
			return 'lsvr_lore_cta_widget';
		}

		public function get_title() {
			return esc_html__( 'Lore CTA Widget', 'lsvr-3rd-party-toolkit' );
		}

		public function get_icon() {
			return 'fa fa-hand-pointer-o';
		}

		public function get_categories() {
			return [ 'lsvr-lore' ];
		}

		protected function _register_controls() {

			$this->start_controls_section(
				'content_section', array(
					'label' => esc_html__( 'Lore CTA Widget', 'lsvr-3rd-party-toolkit' ),
				)
			);

			lsvr_3rd_party_toolkit_shortcode_atts_to_elementor_settings( $this, Lsvr_Shortcode_Lore_CTA_Widget::lsvr_shortcode_atts() );

			$this->end_controls_section();

		}

		protected function render() {

			lsvr_3rd_party_toolkit_elementor_settings_to_shortcode(
				new Lsvr_Shortcode_Lore_CTA_Widget,
				Lsvr_Shortcode_Lore_CTA_Widget::lsvr_shortcode_atts(),
				$this->get_settings_for_display()
			);

		}

    }
}
?>