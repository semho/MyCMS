<?php
require "config.php";
//подключение к серверу БД
mysql_connect($dbhost, $dbuser, $dbpasswd);
mysql_select_db($dbname);
//подключение шаблонизатора

require "Classes/Template.php";
//открытие шаблона
$tpl->get_tpl('page.tpl');

//установка переменных шаблона
$tpl->set_value('TITLE', $title);
$tpl->set_value('DESCRIPTION', $description);
$tpl->set_value('INFO', $info);
//меню
$menu = "
    <br>Пункт 1
    <br>Пункт 2
    <br>Пункт 3";
$tpl->set_value('MENU', $menu);
//вывод главной страницы
if (!isset($p)) {
    $page  = "Главная страница";
    $tpl->set_value('PAGE', $page);
}

//парсинг шаблона
$tpl->tpl_parse();

//вывод html
echo $tpl->html;