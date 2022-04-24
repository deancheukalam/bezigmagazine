<?php
/**
 * Header One Style Template
 *
 * @package Business_Capital
 */
$business_capital_phone      = business_capital_gtm( 'business_capital_header_phone' );
$business_capital_email      = business_capital_gtm( 'business_capital_header_email' );
$business_capital_address    = business_capital_gtm( 'business_capital_header_address' );
$business_capital_open_hours = business_capital_gtm( 'business_capital_header_open_hours' );

$business_capital_button_text   = business_capital_gtm( 'business_capital_header_button_text' );
$business_capital_button_link   = business_capital_gtm( 'business_capital_header_button_link' );
$business_capital_button_target = business_capital_gtm( 'business_capital_header_button_target' ) ? '_blank' : '_self';
?>
<div class="header-wrapper main-header-two <?php echo ! $business_capital_button_text ? ' button-disabled' : ''; ?>">
	<?php if ( $business_capital_phone || $business_capital_email || $business_capital_address || $business_capital_open_hours || has_nav_menu( 'social' ) ) : ?>
	<div id="top-header" class="main-top-header-two <?php echo esc_attr( business_capital_gtm( 'business_capital_header_top_color_scheme' ) ); ?>">
		<div class="site-top-header-mobile">
			<div class="container">
				<button id="header-top-toggle" class="header-top-toggle" aria-controls="header-top" aria-expanded="false">
					<i class="fas fa-bars"></i>
					<?php $business_capital_top_bar_mobile_label = business_capital_gtm( 'business_capital_top_bar_mobile_label' );

					if ( $business_capital_top_bar_mobile_label ) : ?>
					<span class="menu-label"><?php echo esc_html( $business_capital_top_bar_mobile_label ); ?></span>
					<?php endif; ?>
				</button><!-- #header-top-toggle -->
				<div id="site-top-header-mobile-container">
					<?php if ( $business_capital_phone || $business_capital_email || $business_capital_address || $business_capital_open_hours ) : ?>
						<div id="quick-contact">
							<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( has_nav_menu( 'social' ) ): ?>
						<div id="top-social" class="pull-left">
							<div class="social-nav no-border">
								<nav id="social-primary-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'business-capital-dark' ); ?>">
									<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
									) );
									?>
								</nav><!-- .social-navigation -->
							</div>
						</div><!-- #top-social -->
					<?php endif; ?>
					
					<?php get_template_part( 'template-parts/header/header-mobile-search' ); ?>
				</div><!-- #site-top-header-mobile-container-->
			</div><!-- .container -->
		</div><!-- .site-top-header-mobile -->
	</div>
	<?php endif; ?>

	<header id="masthead" class="site-header clear-fix">
		<div class="container">
			<div class="site-header-main">
				<div class="site-branding">
					<?php get_template_part( 'template-parts/header/site-branding' ); ?>
				</div><!-- .site-branding -->
				
				<div class="right-head pull-right">
					<div id="quick-contact" class="layout-two mobile-off pull-left">
						<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
					</div><!-- #quick-contact -->
					
					<?php if ( $business_capital_button_text ) : ?>
					<a target="<?php echo esc_attr( $business_capital_button_target );?>" href="<?php echo esc_url( $business_capital_button_link );?>" class="ff-button header-button  mobile-off pull-left"><?php echo esc_html( $business_capital_button_text );?></a>
					<?php endif; ?>
				</div><!-- .right-head -->
			</div><!-- .site-header-main -->
		</div><!-- .container -->
	</header><!-- #masthead -->

	<div id="main-nav" class="clear-fix <?php echo business_capital_gtm( 'business_capital_header_sticky' ) ? ' sticky-enabled' : ''; ?>">
		<div class="nav-inner-wrapper nav-box-shadow clear-fix">
			<div class="container">
				<div class="pull-left">
					<?php get_template_part( 'template-parts/navigation/navigation-primary' ); ?>
				</div>

				<?php if ( $business_capital_button_text ) : ?>
				<a target="<?php echo esc_attr( $business_capital_button_target );?>" href="<?php echo esc_url( $business_capital_button_link );?>" class="ff-button header-button  mobile-on pull-right"><?php echo esc_html( $business_capital_button_text );?></a>
				<?php endif; ?>
				
				<div class="main-nav-right pull-right mobile-off">
					<?php if ( has_nav_menu( 'social' ) ): ?>
					<div id="top-social" class="pull-left">
						<div class="social-nav no-border">
							<nav id="social-primary-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'business-capital-dark' ); ?>">
								<?php
								wp_nav_menu( array(
									'theme_location' => 'social',
									'menu_class'     => 'social-links-menu',
									'depth'          => 1,
									'link_before'    => '<span class="screen-reader-text">',
								) );
								?>
							</nav><!-- .social-navigation -->
						</div>
					</div><!-- #top-social -->
					<?php endif; ?>
					
					<div class="header-search  mobile-off pull-left">
						<?php get_template_part( 'template-parts/header/header-search' ); ?>
					</div><!-- .header-search -->
				</div><!-- .main-nav-right -->
			</div><!-- .container -->
		</div><!-- .nav-inner-wrapper -->
	</div><!-- .main-nav -->
</div><!-- .header-wrapper -->
