<?php
/**
 * Displays header site branding
 *
 * @package Business_Capital
 */

$business_capital_enable = business_capital_gtm( 'business_capital_header_image_visibility' );

if ( business_capital_display_section( $business_capital_enable ) ) : ?>
<div id="custom-header">
	<?php is_header_video_active() && has_header_video() ? the_custom_header_markup() : ''; ?>

	<div class="custom-header-content">
		<div class="container">
			<?php business_capital_header_title(); ?>
		</div> <!-- .container -->
	</div>  <!-- .custom-header-content -->
</div>
<?php
endif;
