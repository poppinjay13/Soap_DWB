<?php
if (isset($_POST['user'])) {
    require_once('lib/nusoap.php');
    $c = new nusoap_client('http://127.0.0.1/Soap%20Implementation/Web%20Portal/server.php');
    $user = $c->call(
        'getUser',
        array('userId' => $_POST['user'])
    );
    echo '<pre>' . json_encode($user) . '</pre>';
} else {
    echo "<center><b>Unauthorized Access!!<b></center>";
}
