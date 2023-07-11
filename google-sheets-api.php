<?php
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