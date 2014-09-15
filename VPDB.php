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
        $query = "SELECT username, password FROM User WHERE username='$username';";
        $res = $this -> querySingle($query, true);

        if ($res && $res['password'] == $password) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;

            echo "Hi, $username";


        } else {
            echo "Wrong username or password";
        }

    }

    function registerUser($username, $password) {

        if ($this -> querySingle("SELECT * FROM User WHERE username='$username'")) {
            die("The username has been taken.");
        }
        $query = "INSERT INTO User(username, password) VALUES ('$username', '$password')";

        $this -> exec($query);

        return true;
    }

    private function isUserExists($username) {

    }




} 