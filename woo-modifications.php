<?php
/**
 * Plugin Name: woo-modifications
 * Plugin URI: https://github.com/ChristopherGaney
 * Description: Adds a tab in WooCommerce Settings for My Personal Woo Mods
 * Author: Christopher Ganey
 * Author URI: https://github.com/ChristopherGaney
 * Version: 1.0.0
 *
 * Thanks to Patrick Rauland for the woocommerce-settings-tab-demo at:
 * https://gist.github.com/BFTrick/b5e3afa6f4f83ba2e54a
 */

namespace woo_modifications;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// add tab to settings and create fields 
require_once plugin_dir_path( __FILE__ ) . 'add_settings.php';

/**********************************************\
		Add Mod Functions Below
\**********************************************/

// add the excerpt (description) to product archive
 function add_excerpt_to_product_archive() {
   global $product;
	if ( ! $product->get_short_description() ) return; ?>
	<div itemprop="description">
		<?php echo apply_filters( 'woocommerce_short_description', $product->get_short_description() ) ?>
	</div>
	<?php
}


// remove the sidebar from the shop page
function remove_sidebar()
{
    if ( is_shop() ) { 
     remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
   }
}


// Change Text to Add To Cart on button
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Add To Cart', 'woocommerce' ); 
}
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Add To Cart', 'woocommerce' );
}

// display View Cart button after Add To Cart button
function button_view_cart() {
    global $product;
    // Ignore for Variable and Group products
    if( $product->is_type('variable') || $product->is_type('grouped') ) return;
    // Display the custom button
    echo '<a style="margin-right:5px" class="view-cart-btn" href="' . esc_url( home_url() ) . '/cart/">' . __('View Cart') . '</a>';
}

/**********************************************\
		Add Mod Functions Above
\**********************************************/


/**********************************************\
		Add actions and filters for 
		modifications enabled in settings
\**********************************************/

if(get_option('add_excerpt_shop') == 'yes') {
	add_action('woocommerce_after_shop_loop_item_title', 'woo_modifications\add_excerpt_to_product_archive', 5);
}

if(get_option('remove_shop_sidebar') == 'yes') {
	add_action('woocommerce_before_main_content', 'woo_modifications\remove_sidebar' );
}

if(get_option('cart_btn_text') == 'yes') {
	add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
	add_filter( 'woocommerce_product_add_to_cart_text', 'woo_modifications\woocommerce_custom_product_add_to_cart_text' );
}

if(get_option('add_view_cart') == 'yes') {
	add_action('woocommerce_after_shop_loop_item', 'woo_modifications\button_view_cart', 20 );
}

/**********************************************\
		Don't forget to add your setting
		to add_settings.php
\**********************************************/


////