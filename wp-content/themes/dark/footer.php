<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dark
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'dark' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'dark' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<a title="<?php _e('Wordpress theme', 'dark'); ?>" href="<?php echo esc_url(__('http://minathemes.com/', 'dark')); ?>" target="_blank"><?php _e('Theme by Mina', 'dark'); ?></a>	
		</div><!-- .site-info -->	
		
	</footer><!-- #colophon -->
	
</div><!-- #page -->
	
<?php wp_footer(); ?>

</body>
</html>
