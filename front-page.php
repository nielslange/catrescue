<?php
/**
 * The template for displaying the static homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

get_header();
$banner_images   = get_field( 'banner_image' );
$banner_headline = get_field( 'banner_headline' );
$banner_subline  = get_field( 'banner_subline' );
?>

<style>
#banner {
	background: url(<?php print( $banner_images[ array_rand( $banner_images ) ] ); ?>) no-repeat center center/cover;
	color: white;
	height: 500px;
	position: relative;
}

.overlay {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background-color: rgba(0, 0, 0, 0.5);
	z-index: 1;
}

.content {
	position: relative;
	z-index: 2;
	top: 50%;
	transform: translateY(-50%);
	max-width: 1000px;
	margin: auto;
}

h1 {
	text-wrap: pretty;
	padding-right: 40%;
	font-size: 60px;
	font-weight: 900;
	letter-spacing: -1px;
	line-height: 1;
	text-transform: uppercase;
}

</style>

<main>

<?php
// Get all post meta
// $meta = get_post_meta( get_the_ID() );
// print( '<pre>' );
// print_r( $meta );
// print( '</pre>' );
?>

	<section id="banner">
		<div class="overlay"></div>
		<div class="main-inner">
			<div class="main-content">
				<h1><?php echo $banner_headline; ?></h1>
				<h2><?php echo $banner_subline; ?></h2>
			</div>
		</div>
	</section>


	<div id="program">
		<section class="main-inner">
			<div class="main-content">
				program
			</div>
		</section>
	</div>

</main>

<?php get_footer(); ?>
