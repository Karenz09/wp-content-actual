<?php

// Get editor custom colors template
if ( ! function_exists( 'lsvr_pressville_get_editor_custom_colors_template' ) ) {
	function lsvr_pressville_get_editor_custom_colors_template() {

			return '
body .editor-styles-wrapper { color: $body-font; }
body .editor-styles-wrapper a { color: $body-link; }
body .editor-styles-wrapper abbr { border-color: $body-font; }

body .editor-styles-wrapper .c-alert-message { background-color: rgba( $accent2, 0.25 ); }
body .editor-styles-wrapper .c-alert-message:before { color: $accent2; }
body .editor-styles-wrapper .c-arrow-button__icon { color: $accent1; }
body .editor-styles-wrapper .c-button { color: $accent2; border-color: rgba( $accent2, 0.6 ); }
body .editor-styles-wrapper .c-button:hover { border-color: $accent2; }
body .editor-styles-wrapper .c-button:active { border-color: rgba( $accent2, 0.5 ); }
body .editor-styles-wrapper .c-search-form__button { color: $accent1; }

body .editor-styles-wrapper .widget__title { color: $body-font; }
body .editor-styles-wrapper .widget__more-link { color: $accent2; border-color: rgba( $accent2, 0.6 ); }
body .editor-styles-wrapper .widget__more-link:hover { border-color: rgba( $accent2, 1 ); }
body .editor-styles-wrapper .widget__more-link:active { border-color: rgba( $accent2, 0.5 ); }

body .editor-styles-wrapper .lsvr-pressville-weather-widget__time-title,
body .editor-styles-wrapper .lsvr-pressville-weather-widget__weather-item-title { color: $accent1; }
body .editor-styles-wrapper .lsvr-pressville-weather-widget__weather-item-icon { color: $accent2; }
body .editor-styles-wrapper .lsvr-post-featured-widget__title-link { color: $accent1; }
body .editor-styles-wrapper .lsvr-post-featured-widget__category-link { color: $accent2; }
body .editor-styles-wrapper .lsvr_notice-list-widget__item-title-link { color: $accent1; }
body .editor-styles-wrapper .lsvr_notice-list-widget__item-category-link { color: $accent2; }
body .editor-styles-wrapper .lsvr_listing-list-widget__item-title-link { color: $accent1; }
body .editor-styles-wrapper .lsvr_listing-featured-widget__title-link { color: $accent1; }
body .editor-styles-wrapper .lsvr_event-list-widget__item-title-link { color: $accent1; }
body .editor-styles-wrapper .lsvr_event-list-widget__item-date-month { background-color: $accent1; }
body .editor-styles-wrapper .lsvr_event-calendar-widget__nav-btn { color: $accent1; }
body .editor-styles-wrapper .lsvr_event-calendar-widget__day--has-events > .lsvr_event-calendar-widget__day-cell:after { background-color: $accent2; }
body .editor-styles-wrapper .lsvr_event-calendar-widget__day--current > .lsvr_event-calendar-widget__day-cell { color: $accent1; }
body .editor-styles-wrapper .lsvr_event-featured-widget__title-link { color: $accent1; }
body .editor-styles-wrapper .lsvr_event-filter-widget__option--datepicker:after { color: $accent1; }
body .editor-styles-wrapper .lsvr_event-filter-widget__submit-button { background-color: $accent2; }
body .editor-styles-wrapper .lsvr_gallery-list-widget__item-title-link { color: $accent1; }
body .editor-styles-wrapper .lsvr_gallery-featured-widget__title-link { color: $accent1; }
body .editor-styles-wrapper .lsvr_document-list-widget__item-title-link { color: $accent1; }
body .editor-styles-wrapper .lsvr_document-featured-widget__title-link { color: $accent1; }
body .editor-styles-wrapper .lsvr_person-list-widget__item-title-link { color: $accent1; }
body .editor-styles-wrapper .lsvr_person-list-widget__item-subtitle { color: $accent2; }
body .editor-styles-wrapper .lsvr_person-list-widget__item-social-link:hover { background-color: $accent2; }
body .editor-styles-wrapper .lsvr_person-featured-widget__title-link { color: $accent1; }
body .editor-styles-wrapper .lsvr_person-featured-widget__subtitle { color: $accent2; }
body .editor-styles-wrapper .lsvr_person-featured-widget__social-link:hover { background-color: $accent2; }

body .editor-styles-wrapper .lsvr-pressville-post-grid__post-event-date { background-color: rgba( $accent2, 0.9 ); }
body .editor-styles-wrapper .lsvr-pressville-post-grid__post-badge { background-color: rgba( $accent2, 0.9 ); }
body .editor-styles-wrapper .lsvr-pressville-post-grid__post.has-post-thumbnail:hover .lsvr-pressville-post-grid__post-bg { background-color: rgba( $accent2, 0.5 ); }
body .editor-styles-wrapper .lsvr-pressville-sitemap__item-link--level-0 { color: $accent1; }
body .editor-styles-wrapper .lsvr-pressville-sitemap__toggle { color: $accent2; }

body .editor-styles-wrapper .lsvr-button { color: $accent2; border-color: rgba( $accent2, 0.6 ); }
body .editor-styles-wrapper .lsvr-button:hover { border-color: $accent2; }
body .editor-styles-wrapper .lsvr-button:active { border-color: rgba( $accent2, 0.5 ); }
body .editor-styles-wrapper .lsvr-cta__button-link { color: $accent2; border-color: rgba( $accent2, 0.6 ); }
body .editor-styles-wrapper .lsvr-cta__button-link:hover { border-color: $accent2; }
body .editor-styles-wrapper .lsvr-cta__button-link:active { border-color: rgba( $accent2, 0.5 ); }
body .editor-styles-wrapper .lsvr-pricing-table__title { background-color: $accent2; }
body .editor-styles-wrapper .lsvr-pricing-table__price-value { color: $accent1; }
body .editor-styles-wrapper .lsvr-pricing-table__button-link { color: $accent2; border-color: rgba( $accent2, 0.6 ); }
body .editor-styles-wrapper .lsvr-pricing-table__button-link:hover { border-color: $accent2; }
body .editor-styles-wrapper .lsvr-pricing-table__button-link:active { border-color: rgba( $accent2, 0.5 ); }

body .editor-styles-wrapper .lsvr-counter__number { color: $accent1; }
body .editor-styles-wrapper .lsvr-feature__icon { color: $accent1; }
body .editor-styles-wrapper .lsvr-progress-bar__bar-inner { background-color: $accent1; }
';

	}
}
?>