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
            return true;
        }
        return false;
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

        if (!$pattern_id = $this -> getPatternID($pattern)) {
//            $query = "INSERT INTO Pattern(pattern) VALUES ($pattern); SELECT last_insert_rowid() FROM Pattern"; why doesn't work???
            $this -> exec("INSERT INTO Pattern(pattern) VALUES ('$pattern');");
            $pattern_id = $this -> getPatternID($pattern);
        }
        $this -> exec("INSERT INTO UserPattern(user_id, pattern_id) VALUES ($user_id, $pattern_id);");
    }

    function deletePattern($pattern, $username) {

        $pattern_id = $this -> getPatternID($pattern);

        if ($this -> querySingle("SELECT * FROM UserPattern WHERE pattern_id = {$pattern_id} AND" .
            "user_id != (SELECT user_id FROM User WHERE username = '$username')"))
        {
            // If other user(s) use this pattern then leave it be.
            return;
        }
        $q = "DELETE FROM UserPattern WHERE pattern_id = {$pattern_id} AND" .
            "user_id = (SELECT user_id FROM User WHERE username = '{$username}')";  // delete join sqlite???

        // find all themes related with this pattern and delete them
        // check if theme related to other pattern

        $q = "SELECT * FROM PatternTheme WHERE pattern_id = {$pattern_id} AND " .
            "";
        

    }

    function getThemes($pattern) {
        $query_text = "SELECT title, author, theme_id FROM Theme JOIN PatternTheme USING (theme_id) JOIN " .
            "Pattern USING (pattern_id) WHERE pattern = '{$pattern}'; ";
        $query = $this -> query($query_text);
        while ($theme = $query -> fetchArray(SQLITE3_ASSOC)) {
            $res[] = new Theme($theme['theme_id'], $theme['title'], $theme['author']);
        }
        return $res;
    }

    function addThemes($pattern, $themes) {
        $pattern_id = $this -> getPatternID($pattern);
        $query = "";
        foreach($themes as $theme){  // TODO: theme_id!
            $query .= "INSERT INTO Theme(theme_id, title, author) " .
                "VALUES ({$theme -> id}, '{$theme -> title}', '{$theme -> author}'); \n";
            $query .= "INSERT INTO PatternTheme(pattern_id, theme_id) " .
                "VALUES ({$pattern_id}, {$theme -> id}); \n ";  // TODO: may be bug with last_insert_rowid()
        }

        $this -> exec($query);
    }

    function addCheckedThemes($pattern, $themes) {
        $pattern_id = $this -> getPatternID($pattern);
        $query = "INSERT INTO PatternCheckedTheme(pattern_id, theme_id) VALUES ";
        foreach($themes as $theme) {
            $query .= " ({$pattern_id}, {$theme -> id}),";
        }
        $query = rtrim($query, ',') . ';';
        $this -> exec($query);
    }

    function deleteTheme($pattern, $theme) {

    }

    function getCheckedThemes($pattern, $keys_from_ids = True) {
        $query_text = "SELECT theme_id FROM PatternCheckedTheme " .
            "WHERE pattern_id=(SELECT pattern_id FROM Pattern WHERE pattern = '$pattern')";
        $res = [];
        $query = $this -> query($query_text);
        while ($theme = $query -> fetchArray(SQLITE3_ASSOC)) {
            if ($keys_from_ids) {
                $res[$theme['theme_id']] = new Theme($theme['theme_id']);
            } else {
                $res[] = new Theme($theme['theme_id']);
            }
        }
        return $res;
    }

    private function isUserExists($username) {

    }

    private function getPatternID($pattern) {
        return $this -> querySingle("SELECT pattern_id FROM Pattern WHERE pattern = '$pattern';");
    }




} 