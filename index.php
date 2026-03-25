<?php
$fd = fopen("test.txt", 'w+') or die("не удалось открыть файл");

$str = "Привет мир";
fwrite($fd, $str);

$fd = fopen("test.txt", 'r+') or die("не удалось открыть файл");
fclose($fd);


?>