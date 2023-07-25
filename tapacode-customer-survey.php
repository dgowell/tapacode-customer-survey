<?php
/**
 * Plugin Name: Tapacode Customer Survey
 * Description: A plugin to add a customer survey to the checkout complete page.
 * Version: 1.0.0
 * Author: Tapacode
 * Author URI: https://tapacode.com
 * Text Domain: tapacode-customer-survey
 * Domain Path: /i18n/languages/
 * 
 */

defined( 'ABSPATH' ) || exit;


// Include the file that connects to the Google Sheets API
include( plugin_dir_path( __FILE__ ) . 'add-questions-to-order-form.php' );

include( plugin_dir_path( __FILE__ ) . 'handle-order-submit.php' );

// Enqueue necessary scripts and styles for the popup form
function custom_popup_form_enqueue_scripts() {
    // Enqueue your custom scripts and styles here
    wp_enqueue_style( 'custom-popup-form', plugin_dir_url( __FILE__ ) . 'css/custom-popup-form.css' );
}
add_action('wp_enqueue_scripts', 'custom_popup_form_enqueue_scripts');

// Display the popup form on the order completion page
function custom_popup_form_display( $order_id ) {
    if ( ! $order_id ) {
        return;
    }
    
    // Allow code execution only once 
    if( ! get_post_meta( $order_id, '_thankyou_action_done', true ) ) {

        // Get an instance of the WC_Order object
        $order = wc_get_order( $order_id );

        // Get the order key
        $order_key = $order->get_order_key();

        // Get the order number
        $order_number = $order->get_order_number();

        // Include the survey form HTML from the survey-form.php file
        include( plugin_dir_path( __FILE__ ) . 'survey-form.php' );

        // Set the flag to indicate that the action has been done
        update_post_meta( $order_id, '_thankyou_action_done', true );

        // Include the file that connects to the Google Sheets API
        include( plugin_dir_path( __FILE__ ) . 'google-sheets-api.php' );
    } else {
        echo '<p>Couldnt get order id</p>';
    }
}
add_action('woocommerce_thankyou', 'custom_popup_form_display');