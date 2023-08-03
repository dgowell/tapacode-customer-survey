<?php 

// Define a custom function to be called when order status changes
function my_custom_order_status_changed($order_id, $old_status, $new_status) {

    // If the order status is "cancelled", remove the row from the Google Spreadsheet
    if ( $new_status === 'cancelled' || $new_status === 'failed') {
        require_once __DIR__ . '/vendor/autoload.php'; // Replace with the path to your autoload.php fil
        require_once 'config.php';
        $client = new Google_Client();
        $client->setAuthConfig( __DIR__ . '/tapacode-customer-survey-e5bb3ef21d23.json');
        $client->setScopes(['https://www.googleapis.com/auth/spreadsheets']);
        $service = new Google_Service_Sheets($client);
        $spreadsheet_id = SPREADSHEET_ID;
        $range = 'Sheet1!A2:Z'; // Replace with the range of cells you want to insert data into

        // Get the values from the sheet
        $response = $service->spreadsheets_values->get( $spreadsheet_id, $range );
        $currentValues = $response->getValues();

        // Search for the row that matches the order ID
        $row_index = -1;
        foreach ($currentValues as $index => $row) {
            if ($row[1] == $order_id) {
                $row_index = $index + 1; // Add 1 to account for the header row
                break;
            }
        }

        if ($row_index != -1) {
            //clear the row in the google sheet
            $row_index = $row_index + 1; // Add 1 to account for the header row
            $range = 'Sheet1!A' . $row_index . ':Z' . $row_index; // Update the range to include only the row
            $body = new Google_Service_Sheets_ClearValuesRequest();
            $params = [
                'valueInputOption' => 'RAW'
            ];
            $result = $service->spreadsheets_values->clear($spreadsheet_id, $range, $body);
        }
    }
}
add_action('woocommerce_order_status_changed', 'my_custom_order_status_changed', 10, 3);

?>