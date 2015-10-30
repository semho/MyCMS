<?

$q = "select * from sections where root=-1";
$r = mysql_query($q);

$is_ext_menu = 0; // расширенное меню


if ($_GET['p']==="showpage") {
// нужно узнать номер раздела выводимой страницы
    $id = $_GET['id'];
    $qur = "select * from pages where id=$id";
    $res = @mysql_query($qur);
    $row = @mysql_fetch_array($res);

    $number = $row["section"];

    $is_ext_menu = 1;

    $sub = 0;
// а если это подраздел?
    $qur2 = "select * from sections where id=$number";
//echo $qur2;
    $res2 = mysql_query($qur2);
    $row2 = mysql_fetch_array($res2);

    $root = $row2["root"];

    if ($root > -1) { $orig=$number; $number=$root; $sub=1; }

}


while ($row = mysql_fetch_array($r)) {

    $menu = $menu . "<p><a href=index.php?p=show&id=$row[id]>$row[title]</a>";

    if ($is_ext_menu == 1) {

        if ($row["id"]==$number) {

            if ($sub==1) {
// выводим имя подраздела
                $qur3 = "select * from sections where id=$orig";
                $res3 = mysql_query($qur3);

                $row3 = mysql_fetch_array($res3);

                $menu = $menu . "<br>&nbsp&nbsp<a href=index.php?p=show&id=$row[id]>$row3[title]</a>";
            }


// получаем и выводим список страниц раздела

            if ($sub==1) $number=$orig;

            $qur = "select * from pages where section=$number";
            $res = mysql_query($qur);

            while ($row = mysql_fetch_array($res))
                $menu = $menu .  "<br>&nbsp&nbsp&nbsp&nbsp<a href=index.php?p=showpage&id=$row[id]>$row[header]</a>";


        }
    } // if ($is_ext_menu == 1)

}

?>