<?php
if (isset($_FILES['myfile'])) {
    $myfile = $_FILES['myfile']['tmp_name'];
    $myfile_name = $_FILES['myfile']['name'];
    $myfile_size = $_FILES['myfile']['size'];
    $myfile_type = $_FILES['myfile']['type'];
    $error_flag = $_FILES['myfile']['error'];

    if($error_flag == 0) {
        $f_thum = "Upload/gallery/thum_".basename($myfile).".jpg";

        print("Имя файла на сервере:".$myfile."<br>");
        print("Имя файла на компьютере:".$myfile_name."<br>");
        print("Имя будущей миниатюры на сервере:".$f_thum."<br>");
        print("MIME тип файла:".$myfile_type."<br>");
        print("Размер файла:".$myfile_size."<br>");

        //если размер файла больше 1024 Кбайт
        if ($myfile_size > 1024*1024)
            die ("Размер файла превышает 1024 Кбайт. Уменьшите файл!");

        //копирование файла из временного каталога в галерею
        $fname = "Upload/gallery/".basename($myfile).".jpg";
        copy($myfile, $fname);

        //функция миниатюры
        function imageresize($outfile, $infile, $neww, $newh, $quality)
        {
            $im = imagecreatefromjpeg($infile);
            $im1 = imagecreatetruecolor($neww, $newh);
            imagecopyresampled($im1, $im1, 0, 0, 0, 0, $neww, $newh, imagesx($im), imagesy($im));
            imagejpeg($im1, $outfile, $quality);
            imagedestroy($im);
            imagedestroy($im1);
        }
        imageresize($f_thum, $fname, 260, 200, 75);
    }

} else echo file_get_contents($_SERVER["DOCUMENT_ROOT"]."/Views/gallery_form.html");