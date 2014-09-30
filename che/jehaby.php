<?php
/**
 * Simple example of extending the SQLite3 class and changing the __construct
 * parameters, then using the open method to initialize the DB.
 */

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);


session_start();

if (isset($_SESSION['username'])) {
    echo "Hola, {$_SESSION['username']}";
}


$r = "/\.php\?t=([0-9]+)/";
//$r = "/.*(title).*/";
//$d = "19 - 48";

$s = '<a class="title" href="showthread.php?t=109128&amp;s=9cc4743278267683da25d0bc146208c4" id="thread_title_109128">КОММЕРСАНТАМ и все, кто продает</a>';

preg_match($r, $s, $matches);
var_dump($s);
var_dump($matches);


?>
