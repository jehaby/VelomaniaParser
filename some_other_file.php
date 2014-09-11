<?php
#Настройки
# скрипт написан tooby93 (skype: tooby93)
$rssurl = "http://forum.x-mu.net/ipb.html?act=rssout&id=1"; #ссылка рсс ленты
$cachetime = "3600"; #время кеша, через которое обновиться в секундах
$cachefile = "temp.dat"; #Файл кеша
$linkx = "50"; #макс. кол-во символов заголовка
$descrx = "150"; #макс.кол-во символов описания
$countitem = 10; #макс. кол-во ссылок
$maxwords = 3;
#Настройки

header("Content-type:text/html; Charset=UTF-8");

if(file_exists($cachefile)){
    if((time()-filemtime($cachefile)) < $cachetime){
        $data = file_get_contents($cachefile);
        if($data != ''){
            $data = json_decode($data,true);
            echo template($data,$countitem);
            die();
        }
    }
}

$data = curl($rssurl);
if($data != ''){
    $xml = simplexml_load_string($data);
    $items = $xml->channel->item;
    $items_list = array();
    if(count($items) > 0){
        foreach($items as $item){
            $desc = remove_whitespace(strip_tags(htmlspecialchars_decode($item->description)));
            $desc = getPrewText($desc,$maxwords,$descrx);
            $title = getPrewText((string)$item->title,$maxwords,$linkx);
            $items_list[] = array('title'=>$title,'link'=>(string)$item->link,'desc'=>$desc);
        }

#Запись в кеш
        if(file_exists($cachefile)){
            file_put_contents($cachefile, json_encode($items_list));
        }

        echo template($items_list,$countitem);


    }
}else{
    echo 'временно недоступно';
}




function curl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($httpCode == 200){
        return $result;
    }

}

function template($arr,$countitem){
    $i = 0;
    ?>
    <ul>
        <?php foreach($arr as $item):?>
            <?php $i++; if($i == $countitem+1){die();} ?>
            <li class="des"><a href="<?=$item['link'];?>"><?=$item['title'];?></a><?=$item['desc'];?></li>
        <?php endforeach;?>
    </ul>

<?
}


function remove_whitespace($string) {
    $string = preg_replace ('/s+/', ' ', $string) ;
    $string = trim($string) ;
    return $string;
}

function getPrewText($text,$maxwords=60,$maxchar=500) {
//$text=strip_tags($text);
    $words=split(' ',$text);
    $text='';
    foreach ($words as $word) {
        if (mb_strlen($text.' '.$word)<$maxchar) {
            $text.=' '.$word;
        }
        else {
            $text.='...';
            break;
        }
    }
    return $text;
}

?>