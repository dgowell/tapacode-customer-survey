<?php

require_once __DIR__ . '/vendor/autoload.php'; // Replace with the path to your autoload.php file

putenv('GOOGLE_APPLICATION_CREDENTIALS=./tapacode-customer-survey-e5bb3ef21d23.json'); // Replace with the path to your service account key file

$credentialsPath = getenv('GOOGLE_APPLICATION_CREDENTIALS');

$client = new Google_Client();
$client->useApplicationDefaultCredentials();

$client->setScopes(['https://www.googleapis.com/auth/spreadsheets']);

$service = new Google_Service_Sheets($client);

$spreadsheet_id = '15Mzar6OtUH7kYTtVxbwFosXSETIiVe4POZfoCzTRlFQ'; // Replace with the ID of your Google Sheets spreadsheet
$range = 'Sheet1!A2:J2'; // Replace with the range of cells you want to insert data into

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data from the $_POST superglobal array
    $easeOfUse = $_POST['ease-of-use'];
    $easeOfUseFeedback = $_POST['ease-of-use-feedback'];
    $qualityOfInfo = $_POST['quality-of-info'];
    $qualityOfInfoFeedback = $_POST['quality-of-info-feedback'];
    $sourceOfAwareness = $_POST['source-of-awareness'];
    $customerCategory = $_POST['customer-category'];
    $considerationOfCompetition = $_POST['consideration-of-competition'];
    $consideredProducts = $_POST['considered-products'];
    $purchaseDecision = $_POST['purchase-decision'];
    $recommendation = $_POST['recommendation'];


    $values = [
        [$easeOfUse, 
        $easeOfUseFeedback, 
        $qualityOfInfo, 
        $qualityOfInfoFeedback, 
        $sourceOfAwareness, 
        $customerCategory, 
        $considerationOfCompetition, 
        $consideredProducts,
        $purchaseDecision,
        $recommendation],
    ];

    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);

    $params = [
        'valueInputOption' => 'RAW'
    ];

    $result = $service->spreadsheets_values->update($spreadsheet_id, $range, $body, $params);

        printf("Your response have been saved, thank you!");
}
?>