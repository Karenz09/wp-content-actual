<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="google-site-verification" content="ruA6TD6SiLXfU4V5kHTrSXAuCkJFDPjF8Gw0w8PCVlY" />
    <meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!--  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> -->
	<!-- Font Awesome 6 local -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/fontawesome/css/all.min.css"> <!-- de manera local -->

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<!-- WRAPPER : begin -->
	<div id="wrapper">

		<?php // Add custom code at the top of wrapper
		do_action( 'lsvr_pressville_wrapper_top' ); ?>

		<?php // Accessibility links
		get_template_part( 'template-parts/accessibility-links' ); ?>

		<?php // Add custom code before header
		do_action( 'lsvr_pressville_header_before' ); ?>

		<!-- HEADER : begin -->
		<header id="header">
			<div class="header__inner">

				<?php // Add custom code at the top of header
				do_action( 'lsvr_pressville_header_top' ); ?>

				<?php // Header languages mobile
				get_template_part( 'template-parts/header/languages-mobile' ); ?>

				<?php // Add custom code before header titlebar
				do_action( 'lsvr_pressville_header_titlebar_before' ); ?>

				<?php // Header titlebar
				get_template_part( 'template-parts/header/titlebar' ); ?>

				<?php // Add custom code after header titlebar
				do_action( 'lsvr_pressville_header_titlebar_after' ); ?>

				<?php // Header mobile toggle
				get_template_part( 'template-parts/header/mobile-toggle' ); ?>

				<?php // Add custom code at before the navgroup
				do_action( 'lsvr_pressville_header_navgroup_before' ); ?>

				<!-- HEADER NAV GROUP : begin -->
				<?php if ( is_page() || is_front_page()) : ?>
				<div id="header__navgroup" class="header__navgroup"
					data-aria-labelledby="header-mobile-toggle">

					<?php // Add custom code at the top of the navgroup
					do_action( 'lsvr_pressville_header_navgroup_top' ); ?>

					<?php // Header topbar
					get_template_part( 'template-parts/header/topbar' ); ?>

					<?php // Add custom code before header navbar before
					do_action( 'lsvr_pressville_header_navbar_before' ); ?>

					<?php // Header navbar
					get_template_part( 'template-parts/header/navbar' ); ?>

					<?php // Add custom code at the bottom of the navgroup
					do_action( 'lsvr_pressville_header_navgroup_bottom' ); ?>

				</div>
				<?php endif; ?>
				<!-- HEADER NAV GROUP : end -->

				<?php // Add custom code at the bottom of header
				do_action( 'lsvr_pressville_header_bottom' ); ?>

			</div>
		</header>
		<!-- HEADER : end -->

		<?php // Add custom code after Header
		do_action( 'lsvr_pressville_header_after' ); ?>

		<!-- CORE : begin -->
		<div id="core">
			<div class="core__inner">
