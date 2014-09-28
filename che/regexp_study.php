<?php

$pattern = "/^([A-Za-z0-9]){6,}$/";
//$pattern = "/.*/";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    var_dump($_POST);
    $password = $_POST['password'];
    if ($res = preg_match($pattern, $password)) {
        echo $password . "is a good password";
    } else {
        echo $passwrod . "is a bad password";
    }
    var_dump($res);
}
?>

<form method="POST" action="regexp_study.php">
    <input type="password" name="password">
    <input type="submit">
</form>

<?php

$s = "This is a kar kar very bikarkarg sting, sister";
$r = "/ ([[:alnum:]]+) /";

$r = "/([\w]+)/";
$r = "/(kar) \\1/";
preg_match_all($r, $s, $matches);
echo $s . "<br>\n";
var_dump($matches);

$new = preg_replace('/fuck|shit/', 'dazy', 'fucking shitting shit', 1);
var_dump($new);





//var_dump($matches);




