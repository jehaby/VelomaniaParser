<?php
/**
 * Created by PhpStorm.
 * User: urf
 * Date: 9/16/14
 * Time: 12:47 PM
 */
require_once'VPDB.php';

session_start();

if (!$username = $_SESSION['username']) {
    die('You must be logged in to view this page.');
}
$db = new VPDB();


if (isset($_POST['keyword'])) {  // adding keyword
    $db -> addKeyword($username, $_POST['keyword']);
}

?>
<div id="keywords">
    <?php foreach($db -> getKeywords($username) as $keyword):  ?>
        <?php
        echo "<p><a href='themes.php?keyword={$keyword}'>{$keyword}</a></p>\n";
        ?>
    <?php endforeach; ?>
    <div><form action="keywords.php" method="POST">
            <input type="text" name="keyword">
            <input type="submit" value="Add keyword">
    </form>
    </div>
</div>