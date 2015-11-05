<?php
require 'config.php';

mysql_connect($dbhost, $dbuser, $dbpasswd);
mysql_select_db($dbname);
$id = @htmlspecialchars($_GET['id']);
$id = @strip_tags($id);

$q = "select * from pages where id='$id' limit 1";
$r = mysql_query($q);

if (mysql_num_rows($r) > 0) {
    $row = mysql_fetch_array($r);
    $page = $page . "<h1>$row[header]</h1>";
    $page = $page . "<p><br><br>$row[content]</h1>";
    $page = $page . "&copy $SERVER_NAME";
} else $page = "<h1>Нет такой страницы</h1>";
echo $page;