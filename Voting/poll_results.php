<?php
require $_SERVER["DOCUMENT_ROOT"]."/config.php";
mysql_connect($dbhost, $dbuser, $dbpasswd);
mysql_select_db($dbname);
mysql_query("SET NAMES 'utf8'");

$poll = $_GET['poll'];
if (!is_numeric($poll)) die("Номер голосования указан неверно");

$q = "select question
        from polls
        where id =$poll";
$r = @mysql_query($q);

if(mysql_num_rows($r) != 1) die ("Ошибка");
$row = mysql_fetch_array($r);
$question = $row["question"];

//общее количество проголосовавших
$q = "select count(*) as total_votes
        from votes
        where votes.id  =$poll";
$r = @mysql_query($q);
$row = mysql_fetch_array($r);

$total_votes = $row["total_votes"];

//счетчик каждого голоса
$q = "select answers.answer, answers.answer_id, count(votes.answer_id) as num_votes
        from answers
        left join votes
        on votes.id = answers.id
        and votes.answer_id = answers.answer_id
        where answers.id = $poll
        group by answers.answer_id
        order by num_votes desc, answers.answer asc";
$r = @mysql_query($q);
//вывод результата
echo "<html><head><title>$question</title></head><body>";
echo "<ul style='list-style-type: none; font-size: 12px;'>";
echo "<li style='font-weight: bold; padding-bottom: 10px;'>";
echo "$question";
echo "</li>";
while ($row = mysql_fetch_array($r)) {
    if($total_votes != 0){
        //формат. процентное соотношение между вариантами ответов
        $p = sprintf("%.2f", 100.0*$row["num_votes"]/$total_votes);
    } else {
        $p = 0;
    }
    $width = strval(1+intval($p)) . "px";
    echo "<li style='clear: left'>";
    echo $row["answer"];
    echo "</li>";
    echo "<li style='clear: left; padding-bottom: 7px;'>";
    echo '<div style="width: '.$width.'; height: 15px;' .
        '; background:black; margin-right:5px;float:left;">'.
    "</div>$p%";
    echo '</li>';
}
echo '<li style="clear: left">';
echo "Всего проголосовала: $total_votes";
echo '</li>';
echo '</ul>';
echo '</body></html>';