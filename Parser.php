<?php


class Parser {
    private $db;

    function __construct() {
        $this -> db = new VPDB();
    }

    public function checkTheme($theme_id, $pattern) {


    }

    private function check () {

    }

    public function addPattern($pattern, $sections) {

    }

    private function tooOldThemes($days_from_last_message) {
        if (!isset($days_from_last_message) || $days_from_last_message > 10) return false;
        return true;
    }

    private function stringContainsPattern ($pattern, $string) {

    }

    function newPatternInSection($pattern, $section_id) {
        $dom = new domDocument;
        $page = 1;

        while (!isset($days_from_last_message) || $this -> tooOldThemes($days_from_last_message)) {
            $link = "http://forum.velomania.ru/forumdisplay.php?f=" . $section_id . "&page=" . $page++;
            $dom -> loadHTMLFile($link);
            $xpath = new DOMXPath($dom);
            $query_xpath = "//h3[@class='threadtitle']/a";

            foreach ($xpath -> query($query_xpath) as $theme) {
                $str = $theme -> C14N();
                //preg_match("/\.php\?t=([0-9]+)/", $str, $matches);  //
                preg_match("/(?<=php\?t=)(\d+)/", $str, $matches);

                $theme_id = $matches[1];                    // TODO: think how to do it with sscanf()
                $theme_title = $theme -> nodeValue;
                $themes[$theme_id] = new Theme($theme_id, $theme_title);

                // main logic, think about methods names
                if (self :: stringContainsPattern($pattern, $theme_title))  {   // if $theme_title has the $pattern
                    // add new row in PatternTheme
                    $themes_with_pattern[] = $theme_id;
                } else {
                    if (self :: themeContainsPattern($pattern, $theme_id) ){
                        // add new row in PatternTheme
                        $themes_with_pattern[] = $theme_id;
                    } else {
                        // do something
                        // add record to Theme table!
                        $themes_without_pattern[] = $theme_id;
                    }
                }
            }

            foreach ($themes_with_pattern as $theme_id) {
                $this -> db -> addThemes($pattern, null);  // TODO: continue here!
            }


//            var_dump($themes);

            // Looking for time of last posting in theme. I suspect it's terribly ugly.
            $query_time = "(//dl[@class='threadlastpost td' and last()]/dd[span])[last()]";
            $last_date = explode(',', $t = $xpath -> query($query_time) -> item(0) -> textContent)[0];

            $days_from_last_message = (new DateTime()) -> diff(DateTime :: createFromFormat("d.m.Y", $last_date)) -> d;
//            var_dump($days_from_last_message);
        }
        var_dump($themes);

    }



}