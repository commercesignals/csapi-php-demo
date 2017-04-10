<?php

// Use Composer's autoload function to require all api namespaces
require_once 'vendor/autoload.php';

const CERT_FILE_NAME = 'my-api-key-private-cert.pem';
const API_KEY = '0a00017c-5b42-1433-815b-449576ab0007';
const API_BASE = 'https://api.commercesignals.com/';

$cert = file_get_contents(__DIR__ . '/' . CERT_FILE_NAME);

$api = new CommerceSignals\API(API_BASE, [
  'apiKey' => API_KEY,
  'cert' => $cert
]);

// Get a list of all available signals
$signals = $api->signals()
              ->get();


// Get a list of all signal requests
$signalId = '0a000367-564f-144e-8156-4f3a97e707a1';

$requests = $api->signals($signalId)
              ->requests()
              ->get();


// Get the results from a signal request (raw results from the data source)
$requestId = '0a00017c-5aac-1195-815a-ae99350700b9';

$results = $api->signals($signalId)
              ->requests($requestId)
              ->results()
              ->get();


// Get the results and include the summary details (data shown on dashboard results)
$results = $api->signals($signalId)
              ->requests($requestId)
              ->results()
              ->get(['summarize' => true]);


// Get the merchants that are available for a given signal.  The isAuthorized flag will
// be set to 1 for merchants that have been approved to be used with a given signal
$merchants = $api->signals($signalId)
              ->merchants()
              ->get();


// Get a specific merchant for a signal
$merchantId = '0a000367-564f-144e-8632-4f349c5a00c9';

$merchants = $api->signals($signalId)
              ->merchants($merchantId)
              ->get();
