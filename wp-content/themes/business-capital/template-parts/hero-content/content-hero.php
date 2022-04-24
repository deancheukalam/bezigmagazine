<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Business_Capital
 */
if ( ! business_capital_gtm( 'business_capital_hero_content_page' ) ) {
	return;
}

$business_capital_args = array(
	'page_id'        => absint( business_capital_gtm( 'business_capital_hero_content_page' ) ),
	'posts_per_page' => 1,
	'post_type'      => 'page',
);

$business_capital_loop = new WP_Query( $business_capital_args );

while ( $business_capital_loop->have_posts() ) :
	$business_capital_loop->the_post();

	$business_capital_content_align = business_capital_gtm( 'business_capital_hero_content_position' );
	$business_capital_text_align    = business_capital_gtm( 'business_capital_hero_content_text_align' );
	$business_capital_subtitle      = business_capital_gtm( 'business_capital_hero_content_custom_subtitle' );

	$classes[] = 'hero-content-section section';
	$classes[] = business_capital_gtm( 'business_capital_hero_content_position' );
	$classes[] = business_capital_gtm( 'business_capital_hero_content_text_align' );

	if ( ! has_post_thumbnail() ) {
		$classes[] = 'thumbnail-disable';
	}
	?>

	<div id="hero-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="section-featured-page">
			<div class="container">
				<div class="row">
					<div class="hero-content-wrapper">
						<?php if ( has_post_thumbnail() ) : ?>
						<div class="ff-grid-6 featured-page-thumb">
							<div class=" featured-page-thumb-wrapper"><?php the_post_thumbnail( 'business-capital-hero', array( 'class' => 'alignnone' ) );?>
						</div>
						</div>
						<?php endif; ?>

						<!-- .ff-grid-6 -->
						<div class="ff-grid-6 featured-page-content">
							<div class="featured-page-section">
								<div class="section-title-wrap text-alignleft">
									<?php if ( $business_capital_subtitle ) : ?>
									<p class="section-top-subtitle"><?php echo esc_html( $business_capital_subtitle ); ?></p>
									<?php endif; ?>

									<?php the_title( '<h2 class="section-title">', '</h2>' ); ?>

									<span class="divider"></span>
								</div>

								<?php business_capital_display_content( 'hero_content' ); ?>
							</div><!-- .featured-page-section -->
						</div><!-- .ff-grid-6 -->
					</div><!-- .hero-content-wrapper -->

				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .section-featured-page -->
	</div><!-- .section -->
<?php
endwhile;

wp_reset_postdata();
