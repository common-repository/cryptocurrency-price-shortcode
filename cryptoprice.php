<?php
/**
 * Plugin Name: Cryptocurrency Price Shortcode
 * Plugin URI: http://megacrypto.online
 * Description: This plugin allows users to show bitcoin info using shortcode.
 * Version: 1.1
 * Author: Mahdi Maymandi-Nejad
 * License: MIT
 */

function cryptops_the_currency( $atts ) {
    extract( shortcode_atts( array(
        'id' => '',
'fiat' => '',
    ), $atts, 'price' ) );

    $demolph_output = cryptops_the_price( $id,$fiat );  
    return $demolph_output;
}
add_shortcode( "price", "cryptops_the_currency" );

function cryptops_the_price( $id,$fiat ) { 
    $response = wp_remote_get( "https://api.coinmarketcap.com/v1/ticker/$id/?convert=$fiat" );
    $body = wp_remote_retrieve_body( $response );
$data = json_decode($body, TRUE);
$price = $data[0]["price_$fiat"];
return "$price $fiat";
} ?>