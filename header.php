<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
if (!$username = $_SESSION['username']) {
    die("You must be <a href='login.php'>logged in</a> to view this page.");
}
