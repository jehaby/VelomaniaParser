<?php
/**
 * Created by PhpStorm.
 * User: urf
 * Date: 9/11/14
 * Time: 9:50 AM
 */

require_once 'settings.php';

$username = $_POST['username'];
$password = hash('ripemd128', $_POST['password'] . $salt);

$db = new VPDB();

if ($output = $db -> registerUser($username, $password) === true) {
    echo "Registration successful!";
} else {
    echo $output;
}



