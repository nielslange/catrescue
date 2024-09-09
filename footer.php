<?php
/**
 * The footer template file
 *
 * This is the template file that displays the site's footer including
 * the footer navigation menu and copyright information.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Catrescue
 * @since 1.0
 * @author Niels Lange
 * @license GPL v2 or later
 */


?>
<footer id="site-footer">
	<div class="footer-inner">
		<div class="footer-copyright">
			&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?> &bull;
			<?php pll_e( 'All rights reserved' ); ?> &bull;
			<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
				<nav class="footer-menu">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'footer-menu',
						'menu_id'        => 'footer-menu',
						'container'      => 'span',
						'items_wrap'     => '<ul class="footer-menu">%3$s</ul>',
					));
					?>
				</nav>
			<?php endif; ?>
			<?php pll_e( 'Developed with' ); ?>
			<acronym title="September 5, 2024 • Jakarta, Indonesia"><span class="icon-heart"></span></acronym>
			<?php pll_e( 'by' ); ?> <a href="https://nielslange.de" target="_blank" rel="noopener">Niels Lange</a>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
