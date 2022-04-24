<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Business_Capital
 */

if ( ! business_capital_gtm( 'business_capital_contact_form_page' ) ) {
	return;
}

$business_capital_args = array(
	'page_id'        => absint( business_capital_gtm( 'business_capital_contact_form_page' ) ),
	'posts_per_page' => 1,
	'post_type'      => 'page',
);

$business_capital_loop = new WP_Query( $business_capital_args );

while ( $business_capital_loop->have_posts() ) :
	$business_capital_loop->the_post();

	$subtitle = business_capital_gtm( 'business_capital_contact_form_custom_subtitle' );
	?>
	<div id="contact-form-section" class="section no-map">
		<div class="section-contact clear-fix">
			<div class="container">

				<div class="custom-contact-form row">
				<div class="form-section ff-grid-6">
					<div class="section-title-wrap text-alignleft">
						<?php if ( $subtitle ) : ?>
							<p class="section-top-subtitle"><?php echo esc_html( $subtitle ); ?></p>
						<?php endif; ?>

							<?php the_title( '<h2 class="section-title">', '</h2>' ); ?>

							<span class="divider"></span>
					</div><!-- .section-title-wrap -->

					<?php the_content(); ?>
				</div>
				<div class="ff-grid-6  no-padding contact-thumb">
					<?php business_capital_post_thumbnail(); ?>
				</div>
	
			</div><!-- .custom-contact-form -->
			</div>
			<!-- .container -->
		</div><!-- .section-contact -->
	</div><!-- .section -->
<?php
endwhile;

wp_reset_postdata();
