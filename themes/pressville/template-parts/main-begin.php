<!-- COLUMNS : begin -->
<div id="columns">
	<div class="columns__inner">

	<?php if(is_front_page()): ?>
		<div class="lsvr-container" >
		bbbb
	<?php else: ?>
		<div class="lsvr-container" style="overflow-x: hidden;">
			<?php if ( 'left' === apply_filters( 'lsvr_pressville_sidebar_position', 'right' ) ) : ?>

				<div class="lsvr-grid">
					<div class="columns__main lsvr-grid__col lsvr-grid__col--span-8 lsvr-grid__col--push-4">

			<?php elseif ( 'right' === apply_filters( 'lsvr_pressville_sidebar_position', 'right' ) ) : ?>

				<div class="lsvr-grid">
					<div class="columns__main lsvr-grid__col lsvr-grid__col--span-8">

			<?php endif; ?>

			<?php if ( true === apply_filters( 'lsvr_pressville_narrow_content_enable', false ) ) : ?>

				<div class="lsvr-grid">
					<div class="lsvr-grid__col lsvr-grid__col--xlg-span-8 lsvr-grid__col--xlg-push-2">

			<?php endif; ?>

			<!-- MAIN : begin -->
			<main id="main">
				<div class="main__inner">
	<?php endif; ?>