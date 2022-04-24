<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business_Capital
 */

$business_capital_visibility = business_capital_gtm( 'business_capital_featured_grid_visibility' );

if ( ! business_capital_display_section( $business_capital_visibility ) ) {
	return;
}

$business_capital_classes[] = 'featured-grid-section section page style-one';
?>
<div id="featured-grid-section" class="featured-grid-section section page style-one">
	<div class="container">
		<?php business_capital_section_title( 'featured_grid' ); ?>

		<?php get_template_part( 'template-parts/featured-grid/post-type' ); ?>

		<?php
		$business_capital_button_text   = business_capital_gtm( 'business_capital_featured_grid_button_text' );
		$business_capital_button_link   = business_capital_gtm( 'business_capital_featured_grid_button_link' );
		$business_capital_button_target = business_capital_gtm( 'business_capital_featured_grid_button_target' ) ? '_blank' : '_self';

		if ( $business_capital_button_text ) : ?>
			<div class="more-wrapper clear-fix">
				<a href="<?php echo esc_url($business_capital_button_link); ?>" class="ff-button" target="<?php echo esc_attr( $business_capital_button_target ); ?>"><?php echo esc_html($business_capital_button_text); ?></a>
			</div><!-- .more-wrapper -->
		<?php endif; ?>
	</div><!-- .container -->
</div><!-- .latest-posts-section -->

