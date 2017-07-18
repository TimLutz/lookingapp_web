<?php
/*require_once 'PATH_TO_BRAINTREE/lib/Braintree.php';
Braintree_Configuration::environment('sandbox_or_production');
Braintree_Configuration::merchantId('use_your_merchant_id');
Braintree_Configuration::publicKey('use_your_public_key');
Braintree_Configuration::privateKey('use_your_private_key');*/

require_once 'lib/Braintree.php';
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('jm9jkfschbbmbhjj');
Braintree_Configuration::publicKey('ntnkm9xhpddycwbz');
Braintree_Configuration::privateKey('6bd559c2cf1519eca65e82af52799d6b');

$nonce = $_POST["payment_method_nonce"]; //The nonce is 792ccbb8-068e-44a7-9031-c62a491a6de8

$result = Braintree_Transaction::sale(array(
    "amount" => $_POST["amount"],
    'paymentMethodNonce' => $nonce,
    'customer' => array(
    'firstName' => $_POST["firstname"],
    'lastName' => $_POST["lastname"],
    'email' => $_POST["email"]
  ),
    'options' => array(
    'submitForSettlement' => true
  )
));

?>

<!DOCTYPE html>
<html>
<head>
</head>
</head>
<html>
<body>
<p>The nonce is <?php echo $nonce ?></p>
<br>
<br>
<p>The result object is <?php echo $result ?></p>

</body>

</html>