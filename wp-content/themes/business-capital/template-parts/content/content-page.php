<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business_Capital
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-content-wraper">
		<?php business_capital_post_thumbnail(); ?>

		<div class="entry-content-wrapper">
			<?php
			$business_capital_enable = business_capital_gtm( 'business_capital_header_image_visibility' );

			if ( ! business_capital_display_section( $business_capital_enable ) ) : ?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			<?php endif; ?>

			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-capital' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->


		</div><!-- .entry-content-wrapper -->
	</div><!-- .single-content-wraper -->
</article><!-- #post-<?php the_ID(); ?> -->
