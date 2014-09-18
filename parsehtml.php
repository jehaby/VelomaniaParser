<?php

header('Content-Type: text/html; charset=utf-8');

$dom = new domDocument;

$link = "http://forum.velomania.ru/forumdisplay.php?f=13";

echo $dom -> loadHTMLFile($link);

$xpath = new DOMXPath($dom);

$query = "//h2[@class='forumtitle']/a";
//$links = $dom -> getElementsByTagName('h2'); stupid way
$links = $xpath -> query($query);

var_dump($links);

echo $links -> length;

var_dump([1, 2, 3]);

foreach ($links as $link) {
    echo $link -> nodeValue;
    echo $link -> C14N() . "<br>\n";

    //echo $dom -> saveHTML($link) . "<br>\n";
}