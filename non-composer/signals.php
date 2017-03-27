<?php

const CERT_FILE_NAME = 'my-api-key-private-cert.pem';
const API_KEY = '0a00017c-5aa7-1b40-815a-aa75d5f8001b';
const API_BASE = 'https://api.commercesignals.com/';

require_once(__DIR__ . '/../csapi-php/src/CommerceSignals/API.php');

$cert = file_get_contents(__DIR__ . '/' . CERT_FILE_NAME);

$api = new CommerceSignals\API(API_BASE, [
  'apiKey' => API_KEY,
  'cert' => $cert
]);

$signalId = '0a000367-564f-144e-8156-4f3a97e707a1';

// Get a list of all signal requests
$requests = $api->signals($signalId)
              ->requests()
              ->get();



$requestId = '0a00017c-5aac-1195-815a-ae99350700b9';

// Get the results from a signal request (raw results from the data source)
$results = $api->signals($signalId)
              ->requests($requestId)
              ->results()
              ->get();


// Get the results and include the summary details (data shown on dashboard results)
$results = $api->signals($signalId)
              ->requests($requestId)
              ->results()
              ->get(['summarize' => true]);


// Get the merchants that are approved for a given signal
$merchants = $api->signals($signalId)
              ->merchants()
              ->get();


