<?php

/*********************************************************************************************************
* Woocommerce
**********************************************************************************************************/


	function dark_remove_loop_button(){
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	}
	add_action('init','dark_remove_loop_button');



	add_action('woocommerce_after_shop_loop_item','dark_replace_add_to_cart');
	function dark_replace_add_to_cart() {
		global $product;
		$link = esc_url($product->get_permalink());
		echo do_shortcode('<a href="'.$link.'" class="button addtocartbutton">'. __('View Product', 'dark' ).'</a>');
	}