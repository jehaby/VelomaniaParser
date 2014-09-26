<?php


class Theme {
    public $title, $author, $theme_id;

    function __construct($title, $author, $theme_id){
        $this -> title = $title;
        $this -> author = $author;
        $this -> theme_id = $theme_id;
    }
}