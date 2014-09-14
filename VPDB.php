<?php
/**
 * Created by PhpStorm.
 * User: urf
 * Date: 9/14/14
 * Time: 2:28 PM
 */

class VPDB extends SQLite3{ // Velomania Parser DB

    function __construct($filename = 'files/VPDB.db') {
        $this -> open($filename);
    }

    function createDB() {
        $query = file_get_contents("files/create_tables.sql");
        $this -> exec($query);
    }

    function authorizeUser($username, $password) {
        $query = "SELECT username, password FROM User WHERE name='$username';";
        $res = $this -> querySingle($query);

        var_dump($res);
    }

    function registerUser($username, $password) {
        $query = "INSERT INTO User(username, password) VALUES $username, $$password";

        $this > exec($query);


    }

    private function isUserExists($username) {

    }




} 