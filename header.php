<?php
/**
 * The header template file
 *
 * This is the template file that displays the <head> section and the site's
 * header including the logo and navigation menu.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Catrescue
 * @since 1.0
 * @author Niels Lange
 * @license GPL v2 or later
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page-container">
		<header id="site-header">
			<div class="header-inner">
				<div class="site-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><strong>CAT</strong>RESCUE.<strong>ID</strong></a>
				</div>
				<?php if ( has_nav_menu( 'header-menu' ) ) : ?>
					<nav id="header-menu">
						<?php
						wp_nav_menu(array(
							'theme_location' => 'header-menu',
							'menu_id'        => 'header-menu',
							'container'      => '',
							'items_wrap'     => '<ul>%3$s</ul>',
						));
						?>
					</nav>
				<?php endif; ?>
				<div class="hamburger-menu" id="hamburger-menu" aria-label="Menu"></div>
				<?php if ( has_nav_menu( 'mobile-menu' ) ) : ?>
					<nav id="mobile-menu">
					<?php
						wp_nav_menu(array(
							'theme_location' => 'mobile-menu',
							'menu_id'        => 'mobile-menu',
							'container'      => '',
							'items_wrap'     => '<ul>%3$s</ul>',
						));
					?>
					</nav>
				<?php endif; ?>
			</div>
		</header>
