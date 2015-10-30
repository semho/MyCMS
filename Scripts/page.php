<?php
//вывод главной страницы
if (!isset($_GET['p'])) {
    $page  = "Главная страница";
}elseif($_GET['p']=="show") {

    //вывод содержимого раздела
    $id = @htmlspecialchars($_GET['id']);
    $id = @strip_tags($id);

    //ищем подразделы у которых поле root равно номеру выводимого раздела
    $query = "select * from sections where root=$id";
    $result = mysql_query($query);
    //если подразделов нет, выводим страницы
    if (mysql_num_rows($result)==0){
        $q2 = "select * from sections where id=$id";
        $res2= mysql_query($q2);
        $res3= mysql_query($q2);

        $row3 = mysql_fetch_array($res3);
        $info = $row3["txt"];
        $page = $page . "<table width=100% border=0>
                        <td valign=top width=40%";

        if (mysql_num_rows($res2)>0){
            $row2 = mysql_fetch_array($res2);
            $page = $page . "<h1>$row2[title]</h1><p>";
            $q = "select * from pages where section=$id";
            $res = mysql_query($q);
            while($row = mysql_fetch_array($res))
                $page = $page . "<br><b> <a href=index.php?p=showpage&id=$row[id]>
                                $row[header]</a></b>";
            //$info = информация о разделе
            $page = $page . "</td><td valign=top>$info</td></table>";
        }
        else $page = $page . "<h1>Нет такого раздела!</h1>";

    }
    //если подразделы есть
    while ($row = mysql_fetch_array($result)){
        $page = $page . "<br><a href=index.php?p=show&id=$row[id]>
                                $row[title]</a>";
    }

}elseif($_GET['p']=="showpage"){
    //вывод страницы
    $id = @htmlspecialchars($_GET['id']);
    $id = @strip_tags($id);

    $q = "select * from pages where id=$id";
    $r = mysql_query($q);

    if(mysql_num_rows($r)>0) {
        $row = mysql_fetch_array($r);
        $page = $page . "<h1>$row[header]</h1>";

        //ссылка вниз
        $page = $page . "<p><center><a name=top></a><a href=#down>Вниз</a></center><p>";

        //вывод содержимого страницы
        $page = $page . "<p><br><br>$row[content]";

        //вывод ссылки на версию для печати
        $page = $page . "<p><p><a target=_blank href=print.php?id=$id>Версия для печати</a>";

        //ссылка вверх
        $page = $page . "<p><center><a name=down></a><a href=#top>Вверх</a></center><p>";
    }
    else $page = $page . "<h1>Нет такой страницы</h1>";
}