<?php 
function add_product_to_cart() {
if ( ! is_admin() ) {
        global $woocommerce;
        $product_id = 64;
        $found = false;
        //check if product already in cart
        if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
                foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
                        $_product = $values['data'];
                        if ( $_product->id == $product_id )
                                $found = true;
                }
                // if product not found, add it
                if ( ! $found )
                        $woocommerce->cart->add_to_cart( $product_id );
        } else {
                // if no products in cart, add it
                $woocommerce->cart->add_to_cart( $product_id );
        }
}
}
add_action( 'init', 'add_product_to_cart' );
 ?>