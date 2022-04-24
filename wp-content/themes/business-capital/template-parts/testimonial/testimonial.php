<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business_Capital
 */

$business_capital_visibility = business_capital_gtm( 'business_capital_testimonial_visibility' );

if ( ! business_capital_display_section( $business_capital_visibility ) ) {
	return;
}

$image = business_capital_gtm( 'business_capital_testimonial_bg_image' );
?>
<div id="testimonial-section" class="testimonial-section section dark-background page" <?php echo $image ? 'style="background-image: url( ' .esc_url( $image ) . ' )"' : ''; ?>>
	<div class="section-testimonial testimonial-layout-1">
		<div class="container">
			<?php business_capital_section_title( 'testimonial' ); ?>

			<?php get_template_part( 'template-parts/testimonial/post-type' ); ?>
		</div><!-- .container -->
	</div><!-- .section-testimonial  -->
</div><!-- .section -->
