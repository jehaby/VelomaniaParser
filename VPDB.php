<?php
/**
 * Created by PhpStorm.
 * User: urf
 * Date: 9/14/14
 * Time: 2:28 PM
 */

require_once "Theme.php";

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

    function getPatterns($username, $abc_order = false) {
        $query = "SELECT pattern FROM Pattern JOIN UserPattern USING (pattern_id) " .
            "JOIN User USING (user_id) WHERE username='$username';";
        $res = $this -> query($query);
        while ($pattern = $res -> fetchArray(SQLITE3_ASSOC)) {
            $result[] = $pattern['pattern'];
        }
        if ($abc_order) {
            sort($result);
        }
        return $result;
    }

    function addPattern($username, $pattern) { //it may be possible to make this function much more effective and well-written

        $user_id = $this -> querySingle("SELECT user_id FROM User WHERE username='$username'");

        if (!$pattern_id = $this -> querySingle("SELECT pattern_id FROM Pattern WHERE pattern='{$pattern}'")) {
//            $query = "INSERT INTO Pattern(pattern) VALUES ($pattern); SELECT last_insert_rowid() FROM Pattern"; why doesn't work???
            $this -> exec("INSERT INTO Pattern(pattern) VALUES ('$pattern');");
            $pattern_id = $this -> querySingle("SELECT pattern_id FROM Pattern WHERE pattern='{$pattern}'");
        }
        $this -> exec("INSERT INTO UserPattern(user_id, pattern_id) VALUES ($user_id, $pattern_id);");
    }

    function deletePattern($pattern, $username) {
        // first check if others users don't use this pattern;
        $q = "DELETE FROM UserPattern WHERE " .
            "pattern_id = (SELECT pattern_id FROM Pattern WHERE pattern = '{$pattern}') AND" .
            "user_id = (SELECT user_id FROM User WHERE username = '{$username}')";  // delete join sqlite???
    }

    function getThemes($pattern) {
        $query_text = "SELECT title, author FROM Theme JOIN PatternTheme USING (theme_id) JOIN " .
            "Pattern USING (pattern_id) WHERE pattern = '{$pattern}'; ";
        $res = [];
        $query = $this -> query($query_text);
        while ($theme = $query -> fetchArray(SQLITE3_ASSOC)) {
            $res[] = new Theme($theme['title'], $theme['author']);
        }
        return $res;
    }

    function addThemes($pattern, $themes) {
        $pattern_id = $this -> querySingle("SELECT pattern_id FROM Pattern WHERE pattern = '$pattern';");
        $query = "";
        foreach($themes as $theme){
            $query .= "INSERT INTO Theme(title, author) VALUES ('{$theme -> title}', '{$theme -> author}'); \n";
            $query .= "INSERT INTO PatternTheme(pattern_id, theme_id) " .
                "VALUES ({$pattern_id}, (SELECT last_insert_rowid() FROM Theme)); \n ";
        }
        $this -> exec($query);
    }

    function deleteTheme($pattern, $theme) {

    }

    private function isUserExists($username) {

    }




} 