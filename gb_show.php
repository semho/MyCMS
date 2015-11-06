<?php
require_once "config.php";

mysql_connect($dbhost, $dbuser, $dbpasswd);
mysql_select_db($dbname);
mysql_query("SET NAMES 'utf8'");

//количество объявлений на странице
$N = 5;
echo "<h1>Добро пожаловать в гостевую книгу!</h1>";

echo "<a href = '/'>На главную</a>". "<br>";

$r1 = mysql_query("select count(*) as res from gb where apr=1");
$f = mysql_fetch_row($r1);
$res = $f[0];

//если страница не найдена, выводим первую
if (!isset($_GET['page'])) $page = 0;
else $page = $_GET['page'];

//записи, которые нужно вывести
$records = $page * $N;

$q = "select * from gb where apr=1 limit $records, $N"; //$records - с какой записи начать, $N - сколько записей выводить
echo "Всего записей $res <br>";

$r = mysql_query($q);
$n = mysql_num_rows($r);//количество записей
//если страница не первая, выводим ссылку "Назад"
if ($page > 0) {
    $p = $page-1;
    echo "<a href=gb_show.php?page=$p>Назад</a>";
}

//вывод количества страниц записей
$num_pages=ceil($res/$N);
for($i=1;$i<=$num_pages;$i++) {
    if ($i-1 == $page) {
        echo " ".$i." ";
    } else {
        echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.($i-1).'"> '.$i." </a> ";
    }
}

$page++; //увеличение страницы
//вывод ссылки на следующую страницу с новыми $N записями,
//если новый вывод записей не превышает общее количество записей
if ($records+$N < $res)
    echo "<a href=gb_show.php?page=$page>Далее</a>";

//вывод объявлений
for ($i=0; $i<$n; $i++) {
    $f = mysql_fetch_array($r);
    echo "<p><table width='100%'>
            <tr><td bgcolor='navy' width='10%' style='font: Tahoma; color: wheat;'>
                $f[uname]
            </td>";
    echo "<td colspan='2' bgcolor='gray' style='font: Tahoma; color: wheat;'>
                $f[t]
            </td></tr></table>";
}

//форма добавления сообщения
echo "<p>Новое сообщение:
    <p><form action='gb_add.php' method='post'>
        Ваше имя: <input type='text' name='uname'>
        <p><textarea cols='50' rows='10' name='t'></textarea></p>
        <p><input type='submit' value='Добавить'></p>
    </form></p>";