<?php

require_once 'lib/Braintree.php';
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('jm9jkfschbbmbhjj');
Braintree_Configuration::publicKey('ntnkm9xhpddycwbz');
Braintree_Configuration::privateKey('6bd559c2cf1519eca65e82af52799d6b');

$result = Braintree_MerchantAccount::create(
  array(
    'individual' => array(
      'firstName' => 'Jane',
      'lastName' => 'Doe',
      'email' => 'jane@14ladders.com',
      'phone' => '5553334444',
      'dateOfBirth' => '1981-11-19',
      'ssn' => '456-45-4567',
      'address' => array(
        'streetAddress' => '111 Main St',
        'locality' => 'Chicago',
        'region' => 'IL',
        'postalCode' => '60622'
      )
    ),
    'business' => array(
      'legalName' => 'Jane\'s Ladders',
      'dbaName' => 'Jane\'s Ladders',
      'taxId' => '98-7654321',
      'address' => array(
        'streetAddress' => '111 Main St',
        'locality' => 'Chicago',
        'region' => 'IL',
        'postalCode' => '60622'
      )
    ),
    'funding' => array(
      'descriptor' => 'Blue Ladders',
      'destination' => Braintree_MerchantAccount::FUNDING_DESTINATION_BANK,
      'email' => 'funding@blueladders.com',
      'mobilePhone' => '5555555555',
      'accountNumber' => '1123581321',
      'routingNumber' => '071101307'
    ),
    'tosAccepted' => true,
    'masterMerchantAccountId' => "uipl",//14ladders_marketplace
    'id' => "blue_ladders_store"
  )
);

  
echo '<pre>';print_r($result); echo '</pre>';exit;

?>