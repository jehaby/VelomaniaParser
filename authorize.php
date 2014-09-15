<?php

require_once "settings.php";
require_once 'erron.php';
require_once 'VPDB.php';

$username = $_POST['username'];
$password = hash('ripemd128', $_POST['password'] . $salt);

$db = new VPDB();

if ($output = $db -> authorizeUser($username, $password) === true) {
    echo "Authorized";
} else {
    echo $output;
}




