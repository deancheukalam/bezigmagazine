<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business Capital
 */

$business_capital_visibility = business_capital_gtm( 'business_capital_wwd_visibility' );

if ( ! business_capital_display_section( $business_capital_visibility ) ) {
	return;
}

?>
<div id="wwd-section" class="wwd-section section page style-two">
	<div class="section-wwd">
		<div class="container">
			<?php business_capital_section_title( 'wwd' ); ?>

			<?php get_template_part( 'template-parts/wwd/post-type' ); ?>
		</div><!-- .container -->
	</div><!-- .section-wwd  -->
</div><!-- .section -->
