<?php
require_once'VPDB.php';
require_once 'header.php';
require_once 'Parser.php';

$db = new VPDB();

if (isset($_POST['pattern'])) {  // adding pattern
    $db -> addPattern($username, $_POST['pattern']);
    $parser = new Parser();
}

?>
<div id="patterns">
    <?php foreach($db -> getPatterns($username, true) as $pattern):  ?>
        <?php
        echo "<p><a href='themes.php?pattern={$pattern}'>{$pattern}</a></p>\n";
        ?>
    <?php endforeach; ?>
    <div>
        <form action="patterns.php" method="POST">
            <input type="text" name="pattern">
            <input type="submit" value="Add pattern">
    </form>
    </div>
</div>