<?php


class Parser {

    public function checkTheme($theme_id, $pattern) {


    }

    private function check () {

    }

    public function addPattern($pattern, $sections) {

    }

    private static function tooOldThemes($days_from_last_message) {
        if (!isset($days_from_last_message) || $days_from_last_message > 10) return false;
        return true;
    }

    private static function stringContainsPattern ($pattern, $string) {

    }

    static function newPatternInSection($pattern, $section_id) {
        $dom = new domDocument;
        $page = 1;

        while (!isset($days_from_last_message) || self :: tooOldThemes($days_from_last_message)) {
            $link = "http://forum.velomania.ru/forumdisplay.php?f=" . $section_id . "&page=" . $page++;
            $dom -> loadHTMLFile($link);
            $xpath = new DOMXPath($dom);
            $query_xpath = "//h3[@class='threadtitle']/a";

            foreach ($xpath -> query($query_xpath) as $theme) {
                $str = $theme -> C14N();
                var_dump($str);
                $s = sscanf($str, "%[^(php?t=)].php?f=%d&amp%[^[]]");
                var_dump($s);
                // It should be possible to parse $theme_id much more elegant, probably with regex.
                $pos1 = strpos($str, ".php?t=") + 7;
                $pos2 = strpos($str, "&amp");
                $theme_id = substr($str, $pos1, $pos2 - $pos1);
                $theme_title = $theme -> nodeValue;
                $themes[$theme_id] = $theme_title;

                // main logic, think about methods names
//                if (self :: stringContainsPattern($pattern, $theme_title))  {   // if $theme_title has the $pattern
//
//
//                } else {
//                    if (self :: themeContainsPattern($pattern, $theme_id) ){
//
//                    } else {
//
//                    }
//                }

            }

//            var_dump($themes);

            // Looking for time of last posting in theme. I suspect it's terribly ugly.
            $query_time = "(//dl[@class='threadlastpost td' and last()]/dd[span])[last()]";
            $last_date = explode(',', $t = $xpath -> query($query_time) -> item(0) -> textContent)[0];

            $days_from_last_message = (new DateTime()) -> diff(DateTime :: createFromFormat("d.m.Y", $last_date)) -> d;
            var_dump($days_from_last_message);
        }

    }



}