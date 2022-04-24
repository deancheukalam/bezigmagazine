<?php if( ! defined( 'ABSPATH' ) ) exit;

function dark_slider() { ?>

	<div class="container-slider animated <?php echo get_option( 'animation_dark_slider' ); ?>">
		
		<div class="autoplay">

			<?php if ( get_theme_mod( 'slider_img1' ) ) : ?>
			<div><a href="<?php  echo esc_url(get_theme_mod( 'slider_url1' )); ?>"><img style=" height: <?php echo esc_attr(get_theme_mod( 'slider_height' )); ?>px;" src="<?php echo esc_url(get_theme_mod( 'slider_img1' )); ?>" alt="slider_img1"/></a><?php if(get_theme_mod( 'slider_text1' )): ?><h3><a href="<?php echo esc_url(get_theme_mod( 'slider_url1' )); ?>"><?php echo esc_html(get_theme_mod( 'slider_text1' )); ?></a></h3><?php endif; ?></div>
			<?php endif; ?>

			<?php if ( get_theme_mod( 'slider_img2' ) ) : ?>
			<div><a href="<?php  echo esc_url(get_theme_mod( 'slider_url2' )); ?>"><img style=" height: <?php echo esc_attr(get_theme_mod( 'slider_height' )); ?>px;" src="<?php echo esc_url(get_theme_mod( 'slider_img2' )); ?>" alt="slider_img2"/></a><?php if(get_theme_mod( 'slider_text2' )): ?><h3><a href="<?php echo esc_url(get_theme_mod( 'slider_url2' )); ?>"><?php echo esc_html(get_theme_mod( 'slider_text2' )); ?></a></h3><?php endif; ?></div>
			<?php endif; ?>

		</div>

	</div>

	<script>
	jQuery('.autoplay').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  autoplay: true,
	  autoplaySpeed: 3000,
	});
	</script>
	
<?php } ?>