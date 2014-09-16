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

    function getKeywords($username) {
        return [1, 2, 3];
    }

    function addKeyword($username, $keyword) { //it may be possible to make this function much more effective and well-written

        $user_id = $this -> querySingle("SELECT user_id FROM User WHERE username='$username'");

        if (!$keyword_id = $this -> querySingle("SELECT keyword_id FROM Keyword WHERE keyword={$keyword}")) {
            $query = "INSERT INTO Keyword(keyword) VALUES ($keyword); SELECT last_insert_rowid() FROM Keyword";
            $keyword_id = $this -> querySingle($query);
        }

        echo "$user_id, $keyword_id, $username, $keyword";
        $this -> exec("INSERT INTO UserKeyword(user_id, keyword_id) VALUES ($user_id, $keyword_id);");
    }

    private function isUserExists($username) {

    }




} 