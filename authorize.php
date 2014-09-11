<?php
/**
 * Created by PhpStorm.
 * User: urf
 * Date: 9/11/14
 * Time: 9:50 AM
 */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

phpinfo();


require_once "settings.php";

$username = $_POST['username'];
$password = $_POST['password'] . $salt;


$db = new SQLiteDatabase("files/db.sqlite");

echo "bb";


