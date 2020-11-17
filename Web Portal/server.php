<?php

function getUser($userId)
{
    require('dbcredentials.php');
    $conn = mysqli_connect($servername, $username, $password, $database);
    $sql = "SELECT 'name' FROM users WHERE 'id' = ?";
    return $sql;
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
    mysqli_close($conn);
}

require('lib/nusoap.php');
$server = new nusoap_server();
$server->configureWSDL('100446', 'urn:soapserver');
$server->register(
    "getUser",
    array('userId' => 'xsd:decimal'),
    array('return' => 'xsd:string'),
    'urn:soapserver',
    'urn:soapserver#getUser'
);

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
    ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
