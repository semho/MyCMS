<?php
$dir = "Upload/gallery";
$N = 3;

$page = $page . "<h1>Галерея</h1>";
$page = $page . "<table width='100%' cols='$N'>";
$i = 0; //счетчик итераций


//получаем все элименты каталога gallery
$images = scandir($dir);

foreach ($images as $k=>$v)
{
   //вывод одних миниатюр
   if(strpos($v, "thum_") !== false){
       if ($i % $N == 0) $page = $page . "<tr>";
       $page = $page . "<td>";
       $image = substr($v, 5);
       $page = $page . "<a target=_blank href='$dir/$image'>
               <img border=0 src='$dir/$v'>
             </a>";
       $page = $page . "</td>";
       $i++;
   }
}

$page = $page . "</table>";

$page = $page . file_get_contents($_SERVER["DOCUMENT_ROOT"]."/Views/gallery_form.html");