<?php
require $_SERVER["DOCUMENT_ROOT"]."/config.php";
mysql_connect($dbhost, $dbuser, $dbpasswd);
mysql_select_db($dbname);
mysql_query("SET NAMES 'utf8'");

$poll = $_POST['poll'];
if (!is_numeric($poll)) die("Номер голосования указан не верно");
$answer = $_POST['answer'];
if (!is_numeric($answer)) die("Номер ответа указан не верно");

$q = "select answers.answer_id
    from polls, answers
        where polls.id = answers.id
        and polls.id = $poll
        and answers.answer_id = $answer";

$r = @mysql_query($q) or die(mysql_error());
if (mysql_num_rows($r) == 0) {
    die ('неправильный номер вопроса или ответа');
}
//добавляем ответ БД и устанавливаем куки
if (!$_COOKIE["vote_".$poll]) {
    $q = "insert into votes (answer_id, id)
          value ($answer, $poll)";
    $r = mysql_query($q);
        setcookie("vote_".$poll, "1", time()+(3600*24*7));
}
header("Location:poll_results.php?poll=$poll");