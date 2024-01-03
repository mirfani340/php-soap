<?php

require_once 'vendor/autoload.php';

// Create a new NuSOAP client
$client = new nusoap_client('http://localhost/php-soap/server.php?wsdl', true);

// Check for errors
$err = $client->getError();
if ($err) {
    echo 'Error: ' . $err;
    exit();
}

// Call the 'hello' method on the server
$result = $client->call('hello', array('name' => 'Irfani'));

// Check for faults
if ($client->fault) {
    echo 'Fault: ';
    print_r($result);
} else {
    // Check for errors
    $err = $client->getError();
    if ($err) {
        echo 'Error: ' . $err;
    } else {
        // Display the result
        echo 'Result: ' . $result;
    }
}

?>
