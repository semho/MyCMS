<?php
$dir = "Upload/gallery";
$N = 3;

echo "<h1>Галерея</h1>";
echo "<table width='100%' cols='$N'>";
$i = 0; //счетчик итераций


//получаем все элименты каталога gallery
$images = scandir($dir);
foreach ($images as $k=>$v)
{
   //вывод одних миниатюр
   if(strpos($v, "thum_") !== false){
       if ($i % $N == 0) echo "<tr>";
       echo "<td>";
       $image = substr($v, 5);
       echo "<a target=_blank href='$dir/$image'>
               <img border=0 src='$dir/$v'>
             </a>";
       echo "</td>";
       $i++;
   }
}

echo "</table>";

echo file_get_contents($_SERVER["DOCUMENT_ROOT"]."/Views/gallery_form.html");