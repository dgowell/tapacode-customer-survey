<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the values of the form fields
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

    // Print out the values of the form fields
    echo "Ease of Use: $easeOfUse\n";
    echo "Ease of Use Feedback: $easeOfUseFeedback\n";
    echo "Quality of Information: $qualityOfInfo\n";
    echo "Quality of Information Feedback: $qualityOfInfoFeedback\n";
    echo "Source of Awareness: $sourceOfAwareness\n";
    echo "Customer Category: $customerCategory\n";
    echo "Consideration of Competition: $considerationOfCompetition\n";
    echo "Considered Products: $consideredProducts\n";
    echo "Purchase Decision: $purchaseDecision\n";
    echo "Recommendation: $recommendation\n";
}

/*
require_once __DIR__ . '/vendor/autoload.php'; // Replace with the path to your autoload.php file

putenv('GOOGLE_APPLICATION_CREDENTIALS=/path/to/service-account-key.json'); // Replace with the path to your service account key file

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->setScopes(['https://www.googleapis.com/auth/spreadsheets']);

$service = new Google_Service_Sheets($client);

$spreadsheet_id = 'your-spreadsheet-id'; // Replace with the ID of your Google Sheets spreadsheet
$range = 'Sheet1!A1:B2'; // Replace with the range of cells you want to insert data into

// Get the form data from the $_POST superglobal array
$name = $_POST['name'];
$email = $_POST['email'];

$values = [
    [$name, $email],
];

$body = new Google_Service_Sheets_ValueRange([
    'values' => $values
]);

$params = [
    'valueInputOption' => 'RAW'
];

$result = $service->spreadsheets_values->update($spreadsheet_id, $range, $body, $params);

printf("%d cells updated.", $result->getUpdatedCells());
*/
?>