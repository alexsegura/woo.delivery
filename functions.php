<?php
/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );
/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}
/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */

//Text on cart button

 add_filter('woocommerce_product_add_to_cart_text', 'wh_archive_custom_cart_button_text'); // 2.1 +

 function wh_archive_custom_cart_button_text()
 {
 return __('Ajouter au panier', 'woocommerce');
 }

//Attributes on products

add_action('woocommerce_after_shop_loop_item_title', 'show_attr');

function show_attr()
{
    global $product;
	$product_attributes = $product->list_attributes();
}

//Remove catalog ordering field

add_action('init','delay_remove');
function delay_remove() {
    remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
}

// Remove-storefront-search-box-header.php

function remove_sf_actions() {

	remove_action( 'storefront_header', 'storefront_product_search', 40 );

}
add_action( 'init', 'remove_sf_actions' );

// Change the placeholder image

add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');

function custom_woocommerce_placeholder_img_src( $src ) {
	$upload_dir = wp_upload_dir();
	$uploads = untrailingslashit( $upload_dir['baseurl'] );
	// replace with path to your image
	$src = $uploads . '/2018/placeholder.png';

	return $src;
}

// Go back button on product single page 

add_action( 'woocommerce_after_add_to_cart_button', 'my_function_sample', 10 );
function my_function_sample() {
  global $product;
  echo ' <button type="button" onclick="history.back();"> Retourner en arrière </button> ';
}
