<?php
require_once 'vendor/autoload.php';

// Database connection parameters
$db_host = 'database';
$db_user = 'lamp';
$db_pass = 'lamp';
$db_name = 'lamp';

// Create database connection
$db = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

// Create NuSOAP server
$server = new soap_server();
$server->configureWSDL('CRUDService', 'urn:crud');

// Define CRUD functions

// Create
$server->register('createUser',
    array('name' => 'xsd:string', 'email' => 'xsd:string'),
    array('return' => 'xsd:int'),
    'urn:crud',
    'urn:crud#createUser'
);

function createUser($name, $email) {
    global $db;
    $query = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    $result = $db->query($query);
    return $result ? $db->insert_id : 0;
}

// Read
$server->register('getUser',
    array('id' => 'xsd:int'),
    array('return' => 'xsd:Array'),
    'urn:crud',
    'urn:crud#getUser'
);

function getUser($id) {
    global $db;
    $query = "SELECT * FROM users WHERE id = $id";
    $result = $db->query($query);
    return $result ? $result->fetch_assoc() : array();
}

// Update
$server->register('updateUser',
    array('id' => 'xsd:int', 'name' => 'xsd:string', 'email' => 'xsd:string'),
    array('return' => 'xsd:boolean'),
    'urn:crud',
    'urn:crud#updateUser'
);

function updateUser($id, $name, $email) {
    global $db;
    $query = "UPDATE users SET name='$name', email='$email' WHERE id = $id";
    return $db->query($query);
}

// Delete
$server->register('deleteUser',
    array('id' => 'xsd:int'),
    array('return' => 'xsd:boolean'),
    'urn:crud',
    'urn:crud#deleteUser'
);

function deleteUser($id) {
    global $db;
    $query = "DELETE FROM users WHERE id = $id";
    return $db->query($query);
}

// Process SOAP request
if (!isset($HTTP_RAW_POST_DATA)) {
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}
$server->service($HTTP_RAW_POST_DATA);
?>
