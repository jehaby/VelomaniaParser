<?php


class Theme {
    public $title, $author;

    function __construct($title, $author){
        $this -> title = $title;
        $this -> author = $author;
    }
}