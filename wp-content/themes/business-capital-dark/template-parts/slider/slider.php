<?php
/**
 * Template part for displaying Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business_Capital
 */

$business_capital_visibility = business_capital_gtm( 'business_capital_slider_visibility' );

if ( ! business_capital_display_section( $business_capital_visibility ) ) {
	return;
}

?>
<div id="slider-section" class="section slider-section no-padding overlay-enabled style-one zoom-disabled">
	<div class="swiper-wrapper">
		<?php get_template_part( 'template-parts/slider/post', 'type' ); ?>
	</div><!-- .swiper-wrapper -->


	<?php
	// Pagination.
	if ( business_capital_gtm( 'business_capital_slider_pagination' ) ) : ?>
    <div class="swiper-pagination"></div>
	<?php endif; ?>

    <?php
	// Navigation.
	if ( business_capital_gtm( 'business_capital_slider_navigation' ) ) : ?>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <?php endif; ?>
</div><!-- .main-slider -->
