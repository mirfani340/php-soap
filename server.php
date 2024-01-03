<?php

require_once 'vendor/autoload.php';

// Create a new NuSOAP server
$server = new nusoap_server();

// Configure WSDL
$namespace = 'http://localhost/php-soap/server';
$server->configureWSDL('HelloService', $namespace);

// Register the 'hello' method
$server->register(
    'hello',                  // method name
    array('name' => 'xsd:string'), // input parameters
    array('return' => 'xsd:string'), // output parameters
    $namespace,               // namespace
    false,                    // soapaction (use false for automatic)
    'rpc',                    // style
    'encoded',                // use
    'Says hello to the caller' // documentation
);

// Define the 'hello' method
function hello($name)
{
    return 'Hello Comrade, ' . $name;
}

// Process the SOAP request
$rawPostData = file_get_contents("php://input");
$server->service($rawPostData);

?>