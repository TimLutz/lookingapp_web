<?php

return array(

    'appNameIOS'     => array(
        'environment' =>'development',
        'certificate' =>base_path()."/public/apns_cert/pushcert.pem",
        'passPhrase'  =>'123456',
        'service'     =>'apns'
    ),
    'appNameAndroid' => array(
        'environment' =>'production',
        'apiKey'      =>'yourAPIKey',
        'service'     =>'gcm'
    )

);