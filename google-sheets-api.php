<?php

require_once __DIR__ . '/vendor/autoload.php';
$client = new Google_Client();
$client->setAuthConfig( __DIR__ . '/tapacode-customer-survey-e5bb3ef21d23.json');
$client->setScopes(['https://www.googleapis.com/auth/spreadsheets']);
$service = new Google_Service_Sheets($client);
$spreadsheet_id = '15Mzar6OtUH7kYTtVxbwFosXSETIiVe4POZfoCzTRlFQ';
$range = 'Sheet1!A2:Z'; //the whole sheet A to Z

// Call the spreadsheets.values.get method to retrieve the values in the sheet
$response = $service->spreadsheets_values->get($spreadsheet_id, $range);

// Get the values from the response
$currentValues = $response->getValues();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    parse_str($_POST['form_data'], $formData);

    // Get the form data from the $formData superglobal array
    $easeOfUse = $formData['ease-of-use'];
    $easeOfUseFeedback = $formData['ease-of-use-feedback'];
    $qualityOfInfo = $formData['quality-of-info'];
    $qualityOfInfoFeedback = $formData['quality-of-info-feedback'];
    $considerationOfCompetition = $formData['consideration-of-competition'];
    $consideredProducts = $formData['considered-products'];
    $purchaseDecision = $formData['purchase-decision'];
    $recommendation = $formData['recommendation'];
    $timestamp = $_SERVER['REQUEST_TIME'];

    
    // Search for the row that matches the order ID
    $order_key = $formData['order-key']; // Replace with the actual order ID
    $row_index = -1;
    foreach ($currentValues as $index => $row) {
        if ($row[1] == $order_key) {
            $row_index = $index + 1; // Add 1 to account for the header row
            break;
        }
    }


    $values = [
        [$easeOfUse, 
        $easeOfUseFeedback, 
        $qualityOfInfo, 
        $qualityOfInfoFeedback, 
        $considerationOfCompetition, 
        $consideredProducts,
        $purchaseDecision,
        $recommendation, 
        $timestamp],
    ];


        // If the row was found, update the values in the row
    if ($row_index != -1) {
        $row_index = $row_index + 1; // Add 1 to account for the header row
        $range = 'Sheet1!L' . $row_index . ':T' . $row_index; // Update the range to include only the row
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        try {
            $result = $service->spreadsheets_values->update($spreadsheet_id, $range, $body, $params);
            // Handle successful update
        } catch (Google_Service_Exception $e) {
            // Handle API exception
            $error = $e->getMessage();
            error_log($error);
            // Log or display the error message
        } catch (Google_Exception $e) {
            // Handle client exception
            $error = $e->getMessage();
            // Log or display the error message
            error_log($error);
        }
    } else {
        // If the row was not found, add a new row with the order ID and the values
        printf("Could not find order key %s in the spreadsheet", $order_key);
    }
    
}

?>