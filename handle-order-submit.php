<?php

add_action( 'woocommerce_checkout_update_order_meta', 'process_order_form_inputs' );

function process_order_form_inputs( $order_id ) {
    require_once __DIR__ . '/vendor/autoload.php'; // Replace with the path to your autoload.php fil
    require_once 'config.php';
    // Get an instance of the WC_Order object
    $order = wc_get_order( $order_id );
    $client = new Google_Client();
    $client->setAuthConfig( __DIR__ . '/tapacode-customer-survey-e5bb3ef21d23.json');
    $client->setScopes(['https://www.googleapis.com/auth/spreadsheets']);
    $service = new Google_Service_Sheets($client);
    $spreadsheet_id = SPREADSHEET_ID;
    $range = 'Sheet1!A2:N2'; // Replace with the range of cells you want to insert data into
    
    // Get the value of the source of awareness field
    $sourceOfAwareness = $_POST['source-of-awareness'];
    $otherSourceOfAwareness = $_POST['other-source-of-awareness'];

    // Get the value of the customer category field
    $customerCategory = $_POST['where-will-product-be-used'];
    $otherCustomerCategory = $_POST['other-where-will-product-be-used'];

    // Add the source of awareness and customer category as order meta data
   $order->update_meta_data( 'source_of_awareness', $sourceOfAwareness );
   $order->update_meta_data( 'customer_category', $customerCategory );

    $orderNumber = $order->get_id();
    $orderKey = $order->get_order_key();
    $amount = $order->get_total();
    $postcode = $order->get_shipping_postcode();
    //get the product names
    // Get and Loop Over Order Items
    $products = array();
    foreach ( $order->get_items() as $item_id => $item ) {
    $items = $order->get_items();
        //get name for each item and add to priducts array
        $products[] = $item->get_name();
    }    
    //get the current date and time in format 03/08/2023 14:46:57
    $timestamp = date("d/m/Y H:i:s");

    //add the orderNumber, amount ,postcode, each product (checking if the product exists if not just printing and empty string) sources of awareness and customer category to the google sheet
    
    $values = [
        [
            $timestamp,
            $orderNumber,
            $orderKey,
            $amount,
            $postcode,
            $products[0] ?? '',
            $products[1] ?? '',
            $products[2] ?? '',
            $products[3] ?? '',
            $products[4] ?? '',
            $sourceOfAwareness,
            $otherSourceOfAwareness,
            $customerCategory,
            $otherCustomerCategory,
        ],
    ];

    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);

    $params = [
        'valueInputOption' => 'RAW'
    ];

    $result = $service->spreadsheets_values->append($spreadsheet_id, $range, $body, $params);
    $order->save();
    return $order;
}

?>