<?php

// Get custom colors template
if ( ! function_exists( 'lsvr_pressville_get_custom_colors_template' ) ) {
	function lsvr_pressville_get_custom_colors_template() {

			return '
body { color: $body-font; }
a { color: $body-link; }
abbr { border-color: $body-font; }
input, select, textarea { color: $body-font; }

.c-alert-message { background-color: rgba( $accent2, 0.25 ); }
.c-alert-message:before { color: $accent2; }
.c-arrow-button__icon { color: $accent1; }
.c-button { color: $accent2; border-color: rgba( $accent2, 0.6 ); }
.c-button:hover { border-color: $accent2; }
.c-button:active { border-color: rgba( $accent2, 0.5 ); }
.c-search-form__button { color: $accent1; }

.header-topbar { background-color: $accent1; }

@media ( min-width: 992px ) {

	.header-menu-primary__item-link--level-0 { color: $body-font; }
	.current-menu-ancestor .header-menu-primary__item-link--level-0,
	.current-menu-item .header-menu-primary__item-link--level-0 { color: $accent2; }
	.current-menu-ancestor .header-menu-primary__item-link--level-0:before,
	.current-menu-item .header-menu-primary__item-link--level-0:before { background-color: $accent2; }

	.header-menu-primary__item--dropdown .header-menu-primary__item-link { color: $body-font; }
	.header-menu-primary__item--dropdown .header-menu-primary__item-link:hover { color: $accent2; }
	.header-menu-primary__item--dropdown .header-menu-primary__item--level-1.current-menu-ancestor > .header-menu-primary__item-link,
	.header-menu-primary__item--dropdown .current-menu-item > .header-menu-primary__item-link { background-color: rgba( $accent2, 0.2 ); }

	.header-menu-primary__item--megamenu .header-menu-primary__item-link { color: $body-font; }
	.header-menu-primary__item--megamenu .header-menu-primary__item-link:hover { color: $accent2; }
	.header-menu-primary__item--megamenu .header-menu-primary__item-link--level-1 { color: $accent1; }
	.header-menu-primary__item--megamenu .header-menu-primary__submenu--level-1 .current-menu-item > .header-menu-primary__item-link { background-color: rgba( $accent2, 0.2 ); }

}

.header-search__toggle { background-color: $accent2; }
.header-search__submit { color: $accent1; }
.header-search__filter-label--active { background-color: $accent2; }

.header-languages-mobile__item--active .header-languages-mobile__item-link { color: $accent2; }
.header-languages-mobile__toggle { background-color: $accent2; }
.header-languages-mobile__toggle:before { border-bottom-color: $accent2; }

.header-mobile-toggle { background-color: $accent1; }

.post-archive-categories__icon { color: $accent2; }
.post-archive-categories__item:before { background-color: $body-font; }
.post-archive-categories__item-link { color: $accent1; }

.post-archive-filter__option--datepicker:after { color: $accent1; }
.post-archive-filter__submit-button { background-color: $accent2; }
.post-archive-filter__reset-button { color: $accent1; }

.post__category-link,
.post__meta-author-link,
.post__meta-location .post__location-link { color: $accent2; }

.post-password-form input[type="submit"] { background-color: $accent1; }

.post__tags .post__term-link { color: $accent1; border-color: rgba( $accent1, 0.4 ); }
.post__tags .post__term-link:hover { background-color: $accent1; }

.post-comments__list .comment-reply-link { color: $accent2; border-color: rgba( $accent2, 0.6 ); }
.post-comments__list .comment-reply-link:hover { border-color: $accent2; }
.post-comments__list .comment-reply-link:active { border-color: rgba( $accent2, 0.5 ); }
.comment-form .submit { background-color: $accent1; }

.post-pagination__item-link,
.post-pagination__number-link { color: $accent1; }
.post-pagination__number-link:hover { background-color: $accent2;  }
.navigation.pagination a { color: $accent1; }
.navigation.pagination .page-numbers.current,
.navigation.pagination .page-numbers:not( .next ):not( .prev ):not( .dots ):hover { background-color: $accent2; }

.blog-post-archive .post__title-link { color: $accent1; }
.blog-post-archive--grid .post__categories-link { color: rgba( $accent1, 0.8 ); }
.blog-post-archive--grid .has-post-thumbnail:hover .post__bg { background-color: rgba( $accent2, 0.65 ); }

.lsvr_listing-map__infobox-title-link { color: $accent1; }
.lsvr_listing-map__marker-inner { background-color: $accent1; border-color: $accent1; }
.lsvr_listing-map__marker-inner:before { border-top-color: $accent1; }
.lsvr_listing-post-archive--default .post__title-link { color: $accent1; }
.lsvr_listing-post-archive--grid  .post__meta { background-color: rgba( $accent2, 0.9 ); }
.lsvr_listing-post-single .post__social-link:hover { background-color: $accent2; }
.lsvr_listing-post-single .post__contact-item-icon:before { color: $accent2; }
.lsvr_listing-post-single .post__contact-item a { color: $accent1; }
.lsvr_listing-post-single .post__addressmap { background-color: $accent2; }
.lsvr_listing-post-single .post__address:before { color: $accent2; }

.lsvr_event-post-archive--default .post__title-link { color: $accent1; }
.lsvr_event-post-archive--grid .post__date { background-color: rgba( $accent2, 0.9 ); }
.lsvr_event-post-archive--grid .post.has-post-thumbnail:hover .post__bg { background-color: rgba( $accent2, 0.4 ); }
.lsvr_event-post-archive--timeline .post__inner:before { background-color: $accent2; }
.lsvr_event-post-archive--timeline .post__title-link { color: $accent1; }

.lsvr_event-post-single .post__status { background-color: rgba( $accent2, 0.2 ); }
.lsvr_event-post-single .post__status:before { color: rgba( $accent2, 0.4 ); }
.lsvr_event-post-single .post__info-item-icon:before { color: $accent2; }

.lsvr_gallery-post-archive--default .post__title-link { color: $accent1; }
.lsvr_gallery-post-archive--grid .post:hover .post__bg { background-color: rgba( $accent2, 0.4 ); }

.lsvr_document-post-archive--default .post__title-link { color: $accent1; }
.lsvr_document-post-archive--categorized-attachments .post-tree__item-icon--folder { color: $accent1; }
.lsvr_document-post-archive--categorized-attachments .post-tree__item-toggle-icon { color: $accent1; }
.lsvr_document-post-single .post__meta-item:before { color: $accent2; }

.lsvr_person-post-page .post__social-link:hover { background-color: $accent2; }
.lsvr_person-post-page .post__contact-item-icon { color: $accent2; }
.lsvr_person-post-page .post__contact-item > a { color: $accent1; }
.lsvr_person-post-archive .post__title-link { color: $accent1; }
.lsvr_person-post-archive .post__subtitle { color: $accent2; }
.lsvr_person-post-single .post__subtitle { color: $accent2; }

.search-results-page__item-title-link { color: $accent1; }

.back-to-top__link { background-color: $accent2; }

.widget__title { color: $body-font; }
.widget__more-link { color: $accent2; border-color: rgba( $accent2, 0.6 ); }
.widget__more-link:hover { border-color: rgba( $accent2, 1 ); }
.widget__more-link:active { border-color: rgba( $accent2, 0.5 ); }

.lsvr-pressville-weather-widget__time-title,
.lsvr-pressville-weather-widget__weather-item-title { color: $accent1; }
.lsvr-pressville-weather-widget__weather-item-icon { color: $accent2; }
.lsvr-post-featured-widget__title-link { color: $accent1; }
.lsvr-post-featured-widget__category-link { color: $accent2; }
.lsvr_notice-list-widget__item-title-link { color: $accent1; }
.lsvr_notice-list-widget__item-category-link { color: $accent2; }
.lsvr_listing-list-widget__item-title-link { color: $accent1; }
.lsvr_listing-featured-widget__title-link { color: $accent1; }
.lsvr_event-list-widget__item-title-link { color: $accent1; }
.lsvr_event-list-widget__item-date-month { background-color: $accent1; }
.lsvr_event-calendar-widget__nav-btn { color: $accent1; }
.lsvr_event-calendar-widget__day--has-events > .lsvr_event-calendar-widget__day-cell:after { background-color: $accent2; }
.lsvr_event-calendar-widget__day--current > .lsvr_event-calendar-widget__day-cell { color: $accent1; }
.lsvr_event-featured-widget__title-link { color: $accent1; }
.lsvr_event-filter-widget__option--datepicker:after { color: $accent1; }
.lsvr_event-filter-widget__submit-button { background-color: $accent2; }
.lsvr_gallery-list-widget__item-title-link { color: $accent1; }
.lsvr_gallery-featured-widget__title-link { color: $accent1; }
.lsvr_document-list-widget__item-title-link { color: $accent1; }
.lsvr_document-featured-widget__title-link { color: $accent1; }
.lsvr_person-list-widget__item-title-link { color: $accent1; }
.lsvr_person-list-widget__item-subtitle { color: $accent2; }
.lsvr_person-list-widget__item-social-link:hover { background-color: $accent2; }
.lsvr_person-featured-widget__title-link { color: $accent1; }
.lsvr_person-featured-widget__subtitle { color: $accent2; }
.lsvr_person-featured-widget__social-link:hover { background-color: $accent2; }

.widget_display_search .button { color: $accent2; border-color: rgba( $accent2, 0.6 ); }
.widget_display_search .button:hover { border-color: $accent2; }
.widget_display_search .button:active { border-color: rgba( $accent2, 0.5 ); }
.bbp_widget_login .bbp-submit-wrapper .button { color: $accent2; border-color: rgba( $accent2, 0.6 ); }
.bbp_widget_login .bbp-submit-wrapper .button:hover { border-color: $accent2; }
.bbp_widget_login .bbp-submit-wrapper .button:active { border-color: rgba( $accent2, 0.5 ); }

.lsvr-pressville-post-grid__post-event-date { background-color: rgba( $accent2, 0.9 ); }
.lsvr-pressville-post-grid__post-badge { background-color: rgba( $accent2, 0.9 ); }
.lsvr-pressville-post-grid__post.has-post-thumbnail:hover .lsvr-pressville-post-grid__post-bg { background-color: rgba( $accent2, 0.5 ); }
.lsvr-pressville-sitemap__item-link--level-0 { color: $accent1; }
.lsvr-pressville-sitemap__toggle { color: $accent2; }

.lsvr-button { color: $accent2; border-color: rgba( $accent2, 0.6 ); }
.lsvr-button:hover { border-color: $accent2; }
.lsvr-button:active { border-color: rgba( $accent2, 0.5 ); }
.lsvr-cta__button-link { color: $accent2; border-color: rgba( $accent2, 0.6 ); }
.lsvr-cta__button-link:hover { border-color: $accent2; }
.lsvr-cta__button-link:active { border-color: rgba( $accent2, 0.5 ); }
.lsvr-pricing-table__title { background-color: $accent2; }
.lsvr-pricing-table__price-value { color: $accent1; }
.lsvr-pricing-table__button-link { color: $accent2; border-color: rgba( $accent2, 0.6 ); }
.lsvr-pricing-table__button-link:hover { border-color: $accent2; }
.lsvr-pricing-table__button-link:active { border-color: rgba( $accent2, 0.5 ); }

.lsvr-counter__number { color: $accent1; }
.lsvr-feature__icon { color: $accent1; }
.lsvr-progress-bar__bar-inner { background-color: $accent1; }

.bbp-submit-wrapper button { border-color: $accent1; background-color: $accent1; }
div.bbp-template-notice,
div.bbp-template-notice.info { background-color: rgba( $accent2, 0.25 ); }
div.bbp-template-notice:before,
div.bbp-template-notice.info:before { color: $accent2; }
div.bbp-template-notice p { color: $body-font; }
div.bbp-template-notice a { color: $body-link; }
div.bbp-template-notice a:hover { color: $body-link; }
#bbpress-forums .bbp-reply-content #subscription-toggle a { color: $accent1; }
#bbpress-forums .bbp-pagination-links .page-numbers.current { background-color: $accent1; }
#bbpress-forums #bbp-your-profile fieldset input,
#bbpress-forums #bbp-your-profile fieldset textarea { color: $body-font; }
#bbpress-forums #bbp-your-profile #bbp_user_edit_submit { border-color: $accent1; background-color: $accent1; }

.lsvr-datepicker .ui-datepicker-prev,
.lsvr-datepicker .ui-datepicker-next { color: $accent1; }
.lsvr-datepicker th { color: $accent2; }
.lsvr-datepicker td a { color: $body-font; }
.lsvr-datepicker .ui-state-active { color: $accent1; }

@media ( max-width: 991px ) {
	.header-topbar { background-color: #f6f5f5; }
	.header-menu-secondary__list a { color: $accent1; }
	.header-menu-primary__item-link { color: $body-font; }
	.header-menu-primary__item-link--level-0 { color: $body-font; }
	.header-menu-primary__submenu-toggle-icon--active { color: $accent2; }
}
';

	}
}
?>