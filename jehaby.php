<?php
/**
 * Simple example of extending the SQLite3 class and changing the __construct
 * parameters, then using the open method to initialize the DB.
 */

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


session_start();

if (isset($_SESSION['username'])) {
    echo "Hola, {$_SESSION['username']}";
}


?>
