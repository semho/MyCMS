<?php
require $_SERVER["DOCUMENT_ROOT"]."/config.php";
mysql_connect($dbhost, $dbuser, $dbpasswd);
mysql_select_db($dbname);
mysql_query("SET NAMES 'utf8'");

//номер голосования:
$poll = $_GET['poll'];
if(!is_numeric($poll)) die ("Номер голосования указан неверно!");

$q = "select polls.question, answers.answer, answers.answer_id
        from polls, answers
        where polls.id = $poll
        and answers.id = polls.id";
$r = mysql_query($q);

if (mysql_num_rows($r) == 0) {
    die("Ошибка!");
}
//пользователь уже голосовал
if($_COOKIE["vote_".$poll]) {
    header("Location: poll_results.php?poll=$poll");
    exit;
}
//пользователь не голосовал, поэтому выводим форму
$questions = "";
while($row = mysql_fetch_array($r)) {
    $question = $row['question'];
    $questions .= '<li><input name="answer" type="radio" value="'.$row['answer_id'].'">'
        . $row['answer'] . '</li>';
}

echo "<h1>$question</h1>";
echo "<form action='poll_process.php' method='post'>";
echo "<p><ul style='list-style-type: none;'>
        $questions</ul>";
echo "<input name='poll' type='hidden' value='$poll'>
    <input type='submit' value='Голосовать'>
    </form>";
