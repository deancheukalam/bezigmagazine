<?php
/**
 * Template for displaying search forms in Business_Capital
 *
 * @package Business_Capital
 */
?>

<?php $search_text = business_capital_gtm( 'business_capital_search_text' ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'business-capital' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( $search_text ); ?>" value="<?php the_search_query(); ?>" name="s" />
	</label>
	<input type="submit" class="search-submit" value="&#xf002;" />

</form>
