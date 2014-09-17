<?php
require_once'VPDB.php';
require_once 'header.php';

$db = new VPDB();

if (isset($_POST['keyword'])) {  // adding keyword
    $db -> addKeyword($username, $_POST['keyword']);
}

?>
<div id="keywords">
    <?php foreach($db -> getKeywords($username, true) as $keyword):  ?>
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