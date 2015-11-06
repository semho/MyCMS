<?php
require_once "config.php";

mysql_connect($dbhost, $dbuser, $dbpasswd);
mysql_select_db($dbname);
mysql_query("SET NAMES 'utf8'");

$uname = $_POST['uname'];
$t = $_POST['t'];

$uname = strip_tags($uname);
$uname = HtmlSpecialChars($uname);

$t = strip_tags($t);
$t = HtmlSpecialChars($t);

//имя делаем НЕ обязательным для заполнения.
//текс обязательным для заполнения.
if (strlen($uname)==0) $uname = "Гость";
if (strlen($t)==0) die("Вы не указали текст сообщения");
if (strlen($t)>1024) die("Сообщение слишком большое");

$q = "insert into gb value(0, '$uname', '$t', 0)";
mysql_query($q) or die('Ошибка добавления записи в базу данных!');
$id = mysql_insert_id(); //идентификатор последней вставленной записи

echo "<p>Ваще сообщение успешно добавлено в базу данных. После одобрения администратором
сообщение появиться в гостевой книге";

//сообщение для админа:
$msg = "В гостевой книге добавленно сообщение:
$t
Вы можите одобрить его: " . $site . "/gb_service.php?a=approve&id=$id" . "или удалить: "
. $site . "/gb_service.php?a=del&id=$id";

//отправляем сообщение на почту:
mail($email_admin, "Новое сообщение в гостевой книге", $msg);