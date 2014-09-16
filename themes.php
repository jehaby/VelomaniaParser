<?php
/**
 * Created by PhpStorm.
 * User: urf
 * Date: 9/16/14
 * Time: 12:48 PM
 */

require_once'VPDB.php';

session_start();

if (!$username = isset($_SESSION['username'])) {
    die('You must be logged in to view this page.');
}

$keyword = $_GET['keyword'];