<?php

require_once 'lib/Braintree.php';

//Braintree_Configuration::environment('sandbox');
//Braintree_Configuration::merchantId('your_merchant_id');
//Braintree_Configuration::publicKey('your_public_key');
//Braintree_Configuration::privateKey('your_private_key');

/*********SUMITRA CREDENTIALS******/
/*Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('jm9jkfschbbmbhjj');
Braintree_Configuration::publicKey('ntnkm9xhpddycwbz');
Braintree_Configuration::privateKey('6bd559c2cf1519eca65e82af52799d6b');*/

/*********ARINDAM CREDENTIALS******/

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('ppzxctfq4527pj56');
Braintree_Configuration::publicKey('dbrqpsq7crqxrpxm');
Braintree_Configuration::privateKey('97e1fe9f103731924ca4413c17eeca2f');

/*********ARINDAM CREDENTIALS******/


echo($clientToken = Braintree_ClientToken::generate());

?>