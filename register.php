<?php
/**
 * Created by PhpStorm.
 * User: urf
 * Date: 9/11/14
 * Time: 9:50 AM
 */

require_once 'settings.php';
require_once "VPDB.php";
require_once 'erron.php';

if ($_POST["invitation_code"] != $invitation_code) {
    exit("Wrong invitation code!");
}

$username = $_POST['username'];
$password = hash('ripemd128', $_POST['password'] . $salt);

$db = new VPDB();

if ($output = $db -> registerUser($username, $password) === true) {
    echo "Registration successful!";
} else {
    echo $output;
}



