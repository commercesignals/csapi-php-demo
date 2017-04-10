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

// get all campaigns
$campaigns = $api->campaigns()
              ->get();

$campaignId = '0a00017c-5aac-1195-815a-ae8ea3fa000a';

// get a specific campaign
$campaign = $api->campaigns($campaignId)
              ->get();


// create a new campaign
try {
  $campaign = new CommerceSignals\Campaign([
    'name' => 'New Campaign',
    'description' => 'Demo New Campaign',
  ]);

  $newCampaign = $api->campaigns()
                  ->save($campaign);

} catch (CommerceSignals\Exceptions\APIException $e) {
  printf('HTTP Error: %s - %s - %s',
    $e->getStatusCode(),
    $e->getMessage(),
    implode(', ', $e->getErrors())
  );
}

// update an existing campaign
try {
  $properties = [
    'name' => 'Updated Campaign Name',
    'description' => 'Updated Campaign Description',
  ];

  $campaign = $api->campaigns($campaignId)
                        ->update($properties);

} catch (CommerceSignals\Exceptions\APIException $e) {
  printf('HTTP Error: %s - %s - %s',
    $e->getStatusCode(),
    $e->getMessage(),
    implode(', ', $e->getErrors())
  );
}
