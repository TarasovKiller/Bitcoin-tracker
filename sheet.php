<?php

require_once __DIR__ . '/vendor/autoload.php';


date_default_timezone_set('Europe/Moscow');

$email = "sheetsphp@btcproject-345219.iam.gserviceaccount.com";
$url = "https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD,EUR,RUB";
$info = file_get_contents("$url");
$info = json_decode($info,true);


$spreadsheetId = "1O1Ws-LG68NrJ6NNxdIsvCvnFEi5WihZPL2gT9fmnogg";
$sheetid = "0";
$googleAccountKeyFilePath = __DIR__ . '/service_key.json';
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $googleAccountKeyFilePath);


$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->addScope('https://www.googleapis.com/auth/spreadsheets');
$service = new Google_Service_Sheets($client);
$response = $service->spreadsheets->get($spreadsheetId);
$sheetProperties = $response->getSheets()[0]->getProperties();


$time_now = date('d.m.Y H:i:s');
$range = "List 1";
$values = [
    [$time_now,$info["RUB"],$info["USD"],$info["EUR"]],
];
$body = new Google_Service_Sheets_ValueRange([
    'values' => $values
]);
$params = [
    'valueInputOption' => 'RAW'
];
$insert = [
    "insertDataOption" => "INSERT_ROWS"
];
$result = $service->spreadsheets_values->append(
    $spreadsheetId,
    $range,
    $body,
    $params,
    $insert
);

?>
