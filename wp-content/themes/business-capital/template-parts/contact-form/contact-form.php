<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Business_Capital
 */

$business_capital_visibility = business_capital_gtm( 'business_capital_contact_form_visibility' );

if ( ! business_capital_display_section( $business_capital_visibility ) ) {
	return;
}

get_template_part( 'template-parts/contact-form/content-contact' );
