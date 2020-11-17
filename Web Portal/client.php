<?php
require_once('lib/nusoap.php');
$c = new soapclient('http://127.0.0.1/Soap Implementation/Web Portal/server.php');
$user = $c->call('getUser',
array('userId' => 1));
echo '<pre>'. json_encode($user). '</pre>';
