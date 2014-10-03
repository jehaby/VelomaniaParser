<html>
<head>
    <meta charset="UTF-8" content="text/html">
<title><?=$data['title']?></title>
</head>
<body>
<div id="header">
    <h1> Velomania Parser </h1>
</div>
<div id="menu">
<!--    if logged in-->
    <ul>
        <li><a href="">Ключевые слова</a></li>
        <li><a href="">Настройки</a></li>
        <li><a href="">Выход</a></li>
    </ul></div>
<div id="content">
    <?= $data['content'] ?>
</div>
<div id="footer">
    <p>made by jehaby</p>
</div>
</body>
</html>
