<?php
require_once 'lib/Braintree.php';
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('jm9jkfschbbmbhjj');
Braintree_Configuration::publicKey('ntnkm9xhpddycwbz');
Braintree_Configuration::privateKey('6bd559c2cf1519eca65e82af52799d6b');
$aCustomerId ='89278163'; // can be generated from braintreegateway.com vault->New Customer
$clientToken = Braintree_ClientToken::generate(array(
    "customerId" => $aCustomerId
)); //89278163

echo $clientToken; exit;
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://js.braintreegateway.com/v2/braintree.js"></script> <!------- VISA CARD:: 4012888888881881 ----->
</head>
<html>
<body>
<form id="checkout" method="post" action="checkout.php">
  <div id="dropin"></div>
  Amount:<input type="text" name="amount"><br>
  First Name:<input type="text" name="firstname"><br>
  Last Name:<input type="text" name="lastname"><br>
  Email:<input type="text" name="email"><br>
  <input type="submit" value="Pay Now">
</form>
<script language='javascript'>
braintree.setup("<?php echo $clientToken; ?>", 'dropin', {
  container: 'dropin'
});
</script>
</body>
</html>