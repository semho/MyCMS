<?php
$q = "select * from static";
$r = mysql_query($q);

while ($row = mysql_fetch_array($r)) {
    $top_menu = $top_menu . "<a href=index.php?p=static&id=$row[id]>$row[content]</a>";
}