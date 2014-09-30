<?php
require_once'VPDB.php';
require_once 'header.php';

$pattern = $_GET['pattern'];
$db = new VPDB();

$themes = $db -> getThemes($pattern);

// TODO: new themes?
foreach ($themes as $theme): ?>
    <ul>
        <li>
            <a href="http://forum.velomania.ru/showthread.php?t=<?=$theme->id ?>" > <?=$theme->title?></a>
        </li>
    </ul>
<?php
endforeach;