<?php
require $_SERVER["DOCUMENT_ROOT"]."/config.php";

mysql_connect($dbhost, $dbuser, $dbpasswd);
mysql_select_db($dbname);
mysql_query("SET NAMES 'utf8'");

//текущее значение счетчиков
$q = "select * from counter";
$r = mysql_query($q);
$row = mysql_fetch_array($r);

$daily = $row['daily'];
$total = $row['total'];
//IP адрес пользователя
$IP = $_SERVER["REMOTE_ADDR"];
$unique = true;
//есть ли ip в таблице?
$q = "select * from ipaddr where ip = '$IP'";
$r = mysql_query($q);
//IP есть в таблице?
if (mysql_num_rows($r)>0) $unique = false;
//если IP нет в таблице(уникален), то увеличиваем счетчик и заносим в таблицу IP
if($unique) {
    $daily++; $total++;
    //обновление таблицы счетчиков
    $q = "update counter set daily=$daily, total=$total";
    mysql_query($q);
    //добавление IP
    $q = "insert into ipaddr values('$IP')";
    mysql_query($q);
}
//указываем путь к картинке
$img = imagecreatefrompng($_SERVER["DOCUMENT_ROOT"].'/Upload/img/counter.png');
//цвет шрифта
$color = imagecolorallocate($img, 255, 255, 255);
//вывод строки
ImageString($img, 10, 60, 3, "$daily/$total", $color);
//вывод картинки
Header("Content-type: image/png");
ImagePng($img);

