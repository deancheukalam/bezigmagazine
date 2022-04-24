<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Business_Capital
 */

$business_capital_enable = business_capital_gtm( 'business_capital_hero_content_visibility' );

if ( ! business_capital_display_section( $business_capital_enable ) ) {
	return;
}

get_template_part( 'template-parts/hero-content/content-hero' );
