<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'pawhaven' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container container-header">
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <span class="brand-icon">🐾</span>
                    <span class="brand-name">PawHaven</span>
                </a>
			</div>

			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => 'pawhaven_default_menu',
				) );
				?>
			</nav>

            <div class="header-right">
                <form role="search" method="get" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'pawhaven' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                    <button type="submit" class="search-submit">🔍</button>
                </form>
                <a href="<?php echo esc_url( home_url( '/donate' ) ); ?>" class="btn-donate"><?php _e( 'Donate Now', 'pawhaven' ); ?></a>
            </div>
		</div>
	</header><!-- #masthead -->

	<main id="primary" class="site-main">
