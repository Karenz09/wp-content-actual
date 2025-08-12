<?php $form_id = rand( 0, 1000 ); ?>
<!-- SEARCH FORM : begin -->
<form class="c-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
	<div class="c-search-form__inner">
		<div class="c-search-form__input-holder">

			<label class="c-search-form__input-label" for="c-search-form__input-<?php echo esc_attr( $form_id ); ?>"><?php esc_html_e( 'Search:', 'pressville' ); ?></label>
			<input id="c-search-form__input-<?php echo esc_attr( $form_id ); ?>" class="c-search-form__input" type="text" name="s"
				value="<?php echo esc_attr( get_search_query() ); ?>"
				placeholder="<?php esc_html_e( 'Search this site', 'pressville' ); ?>"
				aria-label="<?php esc_html_e( 'Search field', 'pressville' ); ?>">

			<button class="c-search-form__button" type="submit" title="<?php esc_html_e( 'Submit search', 'pressville' ); ?>">
				<span class="c-search-form__button-icon" aria-hidden="true"></span></button>

		</div>
	</div>
</form>
<!-- SEARCH FORM : end -->