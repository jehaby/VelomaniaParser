<?php

header('Content-Type: text/html; charset=utf-8');

//require_once 'erron.php';

require_once 'VPDB.php';
require_once 'Theme.php';
require_once 'Parser.php';
$db = new VPDB();

//$dom = new domDocument;
//
//$link = "http://forum.velomania.ru/forumdisplay.php?f=13";
//
//$dom -> loadHTMLFile($link);
//
//$xpath = new DOMXPath($dom);
//
//$query = "//h2[@class='forumtitle']/a";
//$links = $dom -> getElementsByTagName('h2'); stupid way
//$links = $xpath -> query($query);

//var_dump($links);

//echo $links -> length;


//
//foreach ($links as $link) {
//    echo $link -> nodeValue;
//    $s =  $link -> C14N();
//    $position = strpos($s, ".php?f=") + 7 ;
//
//    $section_id = substr($s, $position, 2) . "\t";
//
//    echo $s;
//    echo "<br>\n";



    //echo $dom -> saveHTML($link) . "<br>\n";


//$db -> addThemes("рюкзак", [new Theme('рюкзак', 'Врунгель'), new Theme('Куплю нож', 'Сява')]);

//var_dump($db -> getThemes("рюкзак"));


Parser :: newPatternInSection("", 73);