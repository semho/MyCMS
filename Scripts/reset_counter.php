<?php
require $_SERVER["DOCUMENT_ROOT"]."/config.php";

mysql_connect($dbhost, $dbuser, $dbpasswd);
mysql_select_db($dbname);
mysql_query("SET NAMES 'utf8'");

//обнуление дневного счетчика
$q = "update counter set daily = 0";
mysql_query($q);
//обнуление таблицы IP-адресов
$q = "delete from ipaddr";
mysql_query($q);