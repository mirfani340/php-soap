<?php
require_once 'vendor/autoload.php';

// Create a NuSOAP client
$client = new nusoap_client('http://localhost:32786/server.php?wsdl&debug=1', 'wsdl');

// Check for errors in the client creation
$err = $client->getError();
if ($err) {
    echo 'Error creating NuSOAP client: ' . $err;
    exit();
}

// CRUD operations

// Create
$params = array('name' => 'John Doe', 'email' => 'john.doe@example.com');
$response = $client->call('createUser', $params);

echo "Create User Response: ";
print_r($response);
echo "\n";

// Read
$params = array('id' => 1);
$response = $client->call('getUser', $params);

echo "Get User Response: ";
print_r($response);
echo "\n";

// Update
$params = array('id' => 1, 'name' => 'Updated John Doe', 'email' => 'updated.john.doe@example.com');
$response = $client->call('updateUser', $params);

echo "Update User Response: ";
print_r($response);
echo "\n";

// Delete
$params = array('id' => 1);
$response = $client->call('deleteUser', $params);

echo "Delete User Response: ";
print_r($response);
echo "\n";
?>