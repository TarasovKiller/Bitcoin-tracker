<?php

require_once __DIR__ . '/vendor/autoload.php';


date_default_timezone_set('Europe/Moscow');

$email = "sheetsphp@btcproject-345219.iam.gserviceaccount.com";
$api_key = "9907c9ea7638c45e2eea395813b8b1ed5a89340c085b21a4a1a10cdb11e78220";
$url = "https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD,EUR,RUB&api_key=$api_key";
$info = file_get_contents("$url");
print(gettype($info));
print("\n");
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
