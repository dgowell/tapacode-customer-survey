<?php

require_once __DIR__ . '/vendor/autoload.php';

//putenv('GOOGLE_APPLICATION_CREDENTIALS=./tapacode-customer-survey-e5bb3ef21d23.json'); // Service account key file

//$credentialsPath = getenv('GOOGLE_APPLICATION_CREDENTIALS');

$client = new Google_Client();
//$client->useApplicationDefaultCredentials();
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
    // Get the form data from the $_POST superglobal array
    $easeOfUse = $_POST['ease-of-use'];
    $easeOfUseFeedback = $_POST['ease-of-use-feedback'];
    $qualityOfInfo = $_POST['quality-of-info'];
    $qualityOfInfoFeedback = $_POST['quality-of-info-feedback'];
    $considerationOfCompetition = $_POST['consideration-of-competition'];
    $consideredProducts = $_POST['considered-products'];
    $purchaseDecision = $_POST['purchase-decision'];
    $recommendation = $_POST['recommendation'];

    // Search for the row that matches the order ID
    $order_id = $_POST['order-number']; // Replace with the actual order ID
    $row_index = -1;
    foreach ($currentValues as $index => $row) {
        if ($row[0] == $order_id) {
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
        $recommendation],
    ];


        // If the row was found, update the values in the row
    if ($row_index != -1) {
        $row_index = $row_index + 1; // Add 1 to account for the header row
        $range = 'Sheet1!L' . $row_index . ':S' . $row_index; // Update the range to include only the row
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $result = $service->spreadsheets_values->update($spreadsheet_id, $range, $body, $params);
    } else {
        // If the row was not found, add a new row with the order ID and the values
        printf("Could not find order ID %s in the spreadsheet", $order_id);
    }
        printf("Your response has been saved, thank you!");
}
?>