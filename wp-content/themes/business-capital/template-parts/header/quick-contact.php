<?php
/**
 * Header Search
 *
 * @package Business_Capital
 */

$business_capital_phone      = business_capital_gtm( 'business_capital_header_phone' );
$business_capital_email      = business_capital_gtm( 'business_capital_header_email' );
$business_capital_address    = business_capital_gtm( 'business_capital_header_address' );
$business_capital_open_hours = business_capital_gtm( 'business_capital_header_open_hours' );

if ( $business_capital_phone || $business_capital_email || $business_capital_address || $business_capital_open_hours ) : ?>
	<div class="inner-quick-contact">
		<ul>
			<?php if ( $business_capital_phone ) : ?>
				<li class="quick-call">
					<span><?php esc_html_e( 'Phone', 'business-capital' ); ?></span><a href="tel:<?php echo preg_replace( '/\s+/', '', esc_attr( $business_capital_phone ) ); ?>"><?php echo esc_html( $business_capital_phone ); ?></a> </li>
			<?php endif; ?>

			<?php if ( $business_capital_email ) : ?>
				<li class="quick-email"><span><?php esc_html_e( 'Email', 'business-capital' ); ?></span><a href="<?php echo esc_url( 'mailto:' . esc_attr( antispambot( $business_capital_email ) ) ); ?>"><?php echo esc_html( antispambot( $business_capital_email ) ); ?></a> </li>
			<?php endif; ?>

			<?php if ( $business_capital_address ) : ?>
				<li class="quick-address"><span><?php esc_html_e( 'Address', 'business-capital' ); ?></span><?php echo esc_html( $business_capital_address ); ?></li>
			<?php endif; ?>

			<?php if ( $business_capital_open_hours ) : ?>
				<li class="quick-open-hours"><span><?php esc_html_e( 'Open Hours', 'business-capital' ); ?></span><?php echo esc_html( $business_capital_open_hours ); ?></li>
			<?php endif; ?>
		</ul>
	</div><!-- .inner-quick-contact -->
<?php endif; ?>

