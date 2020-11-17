<?php

function getUser($userId)
{
    require('dbcredentials.php');
    $mysqli = new mysqli($servername, $username, $password, $database);
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user = array(
            'id' => intval($row['id']),
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'address' => $row['address'],
            'message' => "Succesfully retrieved the Student"
        );
        return $user;
    } else {
        $user = array(
            'id' => 0,
            'name' => "",
            'email' => "",
            'phone' => "",
            'address' => "",
            'message' => "No Student found with this ID"
        );
        return $user;
    }
}

require('lib/nusoap.php');
$server = new nusoap_server();
$server->configureWSDL("getUser");
$namespace = "http://127.0.0.1/Soap%20Implementation/Web%20Portal/server.php";
$server->wsdl->schemaTargetNamespace = $namespace;

$server->wsdl->addComplexType(
    'User',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'id' => array('name' => 'id', 'type' => 'xsd:int'),
        'name' => array('name' => 'name', 'type' => 'xsd:string'),
        'email' => array('name' => 'email', 'type' => 'xsd:string'),
        'phone' => array('name' => 'phone', 'type' => 'xsd:string'),
        'address' => array('name' => 'address', 'type' => 'xsd:string'),
        'message' => array('name' => 'message', 'type' => 'xsd:string')
    )
);

$server->register(
    'getUser',
    array('userId' => 'xsd:int'),
    array('return' => 'tns:User'),
    $namespace,
    false,
    'rpc',
    'encoded',
    'Method to retrieve user credentials'
);

@$server->service(file_get_contents("php://input"));
