<?



add_action( 'woocommerce_checkout_create_order', 'process_order_form_inputs' );

function process_order_form_inputs( $order ) {
    require_once __DIR__ . '/vendor/autoload.php'; // Replace with the path to your autoload.php file
    //putenv('GOOGLE_APPLICATION_CREDENTIALS=' . realpath('./tapacode-customer-survey-e5bb3ef21d23.json')); // Replace with the path to your service account key file
    //putenv('GOOGLE_APPLICATION_CREDENTIALS=./tapacode-customer-survey-e5bb3ef21d23.json');
    //$credentialsPath = getenv('GOOGLE_APPLICATION_CREDENTIALS');

    $client = new Google_Client();
    //$client->useApplicationDefaultCredentials();
    $client->setAuthConfig( __DIR__ . '/tapacode-customer-survey-e5bb3ef21d23.json');

    $client->setScopes(['https://www.googleapis.com/auth/spreadsheets']);

    $service = new Google_Service_Sheets($client);

    $spreadsheet_id = '15Mzar6OtUH7kYTtVxbwFosXSETIiVe4POZfoCzTRlFQ'; // Replace with the ID of your Google Sheets spreadsheet
    $range = 'Sheet1!A2:F2'; // Replace with the range of cells you want to insert data into
    
    // Get the value of the source of awareness field
    $sourceOfAwareness = $_POST['source-of-awareness'];

    // Get the value of the customer category field
    $customerCategory = $_POST['customer-category'];

    // Add the source of awareness and customer category as order meta data
   // $order->update_meta_data( 'source_of_awareness', $sourceOfAwareness );
   // $order->update_meta_data( 'customer_category', $customerCategory );

    $orderNumber = $order->get_id();
    $orderKey = $order->get_order_key();
    $amount = $order->get_total();
    $postcode = $order->get_shipping_postcode();
    //get the product names
    // Get and Loop Over Order Items
    $products[] = array();
    foreach ( $order->get_items() as $item_id => $item ) {
    $items = $order->get_items();
        //get name for each item and add to priducts array
        $products[] = $item->get_name();
    }    

    //echo the values
    echo 'order number: ' . $orderNumber . '<br>';
    echo 'amount: ' . $amount . '<br>';
    echo 'postcode: ' . $postcode . '<br>';
    echo 'products: ' . implode(', ', $products) . '<br>';

    //echo 'product two: ' . $products[1] . '<br>';
    //echo 'product three: ' . $products[2] . '<br>';
    //echo 'product four: ' . $products[3] . '<br>';
    //echo 'product five: ' . $products[4] . '<br>';    
    echo 'source of awareness: ' . $sourceOfAwareness . '<br>';
    echo 'customer category: ' . $customerCategory . '<br>';
        

    //add the order number, amount, postcode, product names, source of awareness and customer category to the google sheet

    $values = [
        [
            $orderNumber,
            $amount,
            $postcode,
            'test',
            $sourceOfAwareness,
            $customerCategory
        ],
    ];

    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);

    $params = [
        'valueInputOption' => 'RAW'
    ];

    $result = $service->spreadsheets_values->update($spreadsheet_id, $range, $body, $params);
    return $order;
}


?>