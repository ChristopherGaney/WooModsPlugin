<?php 

namespace woo_modifications;

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

class My_Woo_Mods {

    
    public static function init() {
        add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
        add_action( 'woocommerce_settings_tabs_my_woo_mods', __CLASS__ . '::settings_tab' );
        add_action( 'woocommerce_update_options_my_woo_mods', __CLASS__ . '::update_settings' );
    }

    
    public static function add_settings_tab( $settings_tabs ) {
        $settings_tabs['my_woo_mods'] = __( 'My Woo Mods', 'woocommerce-my-woo-mods' );
        return $settings_tabs;
    }


    public static function settings_tab() {
        woocommerce_admin_fields( self::get_settings() );
    }


    public static function update_settings() {
        woocommerce_update_options( self::get_settings() );
    }


    public static function get_settings() {
        
        $settings = array(
            'section_title' => array(
                'name'     => __( 'My Personal Woo Mods:', 'woocommerce-my-woo-mods' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'my_woo_mods_section_title'
            ),

        /*********************************************************************\
                            ADD MODS BELOW!!!!!!!!
        \*********************************************************************/

            // Add the excerpt (description) to products on archive pages
            'add_excerpt_shop' => array(
                'name' => __( 'Add Excerpt', 'woocommerce-my-woo-mods' ),
                'type' => 'checkbox',
                'desc' => __( 'Add the excerpt (description) to product archive', 'woocommerce-my-woo-mods' ),
                'id'   => 'add_excerpt_shop'
            ),

            // Remove the sidebar from the shop page
            'remove_shop_sidebar' => array(
                'name' => __( 'Remove Sidebar', 'woocommerce-my-woo-mods' ),
                'type' => 'checkbox',
                'desc' => __( 'Remove the sidebar from the shop page', 'woocommerce-my-woo-mods' ),
                'id'   => 'remove_shop_sidebar'
            ),

            // Change text to Add To Cart on button
            'change_btn_text' => array(
                'name' => __( 'Change Cart Text', 'woocommerce-my-woo-mods' ),
                'type' => 'checkbox',
                'desc' => __( 'Change text to Add To Cart on button', 'woocommerce-my-woo-mods' ),
                'id'   => 'cart_btn_text'
            ),

            // Display View Cart button after Add To Cart button
            'add_view_cart' => array(
                'name' => __( 'Add View Cart', 'woocommerce-my-woo-mods' ),
                'type' => 'checkbox',
                'desc' => __( 'Display View Cart button after Add To Cart button on archive pages', 'woocommerce-my-woo-mods' ),
                'id'   => 'add_view_cart'
            ),

        /*********************************************************************\
                        ADD MODS ABOVE!!!!!!!!
        \*********************************************************************/

            'section_end' => array(
                 'type' => 'sectionend',
                 'id' => 'my_woo_mods_section_end'
            )
        );

        return apply_filters( 'my_woo_mods_settings', $settings );
    }

}

My_Woo_Mods::init();


////