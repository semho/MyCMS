<?php
if (isset($_FILES['myfile'])) {
    $myfile = $_FILES['myfile']['tmp_name'];
    $myfile_name = $_FILES['myfile']['name'];
    $myfile_size = $_FILES['myfile']['size'];
    $myfile_type = $_FILES['myfile']['type'];
    $error_flag = $_FILES['myfile']['error'];

    if($error_flag == 0) {
        $name = preg_replace('~\.tmp~', "", basename($myfile));
        $f_thum = $_SERVER["DOCUMENT_ROOT"]. "/Upload/gallery/thum_".$name.".jpg";

        print("Имя файла на сервере:".$myfile."<br>");
        print("Имя файла на компьютере:".$myfile_name."<br>");
        print("Имя будущей миниатюры на сервере:".$f_thum."<br>");
        print("MIME тип файла:".$myfile_type."<br>");
        print("Размер файла:".$myfile_size."<br>");

        //если размер файла больше 1024 Кбайт
        if ($myfile_size > 1024*1024)
            die ("Размер файла превышает 1024 Кбайт. Уменьшите файл!");

        //копирование файла из временного каталога в галерею
        $fname = $_SERVER["DOCUMENT_ROOT"]. "/Upload/gallery/".$name.".jpg";
        copy($myfile, $fname);
        //функция миниатюры
        function imageresize($infile, $outfile, $neww, $newh, $quality)
        {
            $im = imagecreatefromjpeg($infile);
            $im1 = imagecreatetruecolor($neww, $newh);
            imagecopyresampled($im1, $im, 0, 0, 0, 0, $neww, $newh, imagesx($im), imagesy($im));
            imagejpeg($im1, $outfile, $quality);
            imagedestroy($im);
            imagedestroy($im1);
        }
        imageresize($fname, $f_thum, 260, 200, 75);
    }
    echo "<a href = '/'>На главную</a>";
} else echo file_get_contents($_SERVER["DOCUMENT_ROOT"]."/Views/gallery_form.html");