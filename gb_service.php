<?php
require_once "config.php";

mysql_connect($dbhost, $dbuser, $dbpasswd);
mysql_select_db($dbname);

$action = $_GET['a'];
$id = $_GET['id'];

if (!is_numeric($id)) die ("Номер записи указан неверно");

if ($action === "approve") {
    $q = "update gb set apr = 1 where id = '$id'";
    @mysql_query($q) or die('Ошибка базы данных!');
    echo "Сообщение $id одобренно";
}
if ($action === "del") {
    $q = "delete from gb where id = '$id'";
    @mysql_query($q) or die('Ошибка базы данных!');
    echo "Сообщение $id удаленно";
}