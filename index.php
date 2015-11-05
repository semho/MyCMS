<?php
require "config.php";
//подключение к серверу БД
mysql_connect($dbhost, $dbuser, $dbpasswd);
mysql_select_db($dbname);
//подключение шаблонизатора

require __DIR__."/Classes/Template.php";
//открытие шаблона
$tpl->get_tpl('page.tpl');

//установка переменных шаблона
$tpl->set_value('TITLE', $title);
$tpl->set_value('DESCRIPTION', $description);
$tpl->set_value('INFO', $info);

//подключение верхнего меню
include __DIR__."/Scripts/top_menu.php";
$tpl->set_value('TOP_MENU', $top_menu);

//подключение левого меню
include __DIR__."/Scripts/menu.php";
$tpl->set_value('MENU', $menu);

//подключение вывода страниц
include __DIR__."/Scripts/page.php";
$tpl->set_value('PAGE', $page);

//echo file_get_contents($_SERVER["DOCUMENT_ROOT"].'/gallery_show.php');

//парсинг шаблона
$tpl->tpl_parse();
//вывод html
echo $tpl->html;
