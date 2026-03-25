<?php
$fd = fopen("test.txt", 'w') or die("не удалось открыть файл");

$str = "Привет мир";
fwrite($fd, $str);

$fd = fopen("test.txt", 'r') or die("не удалось открыть файл");
fclose($fd);


$fd = fopen("test.txt", 'r') or die("Не удалось открыть файл для чтения");

$content = fread($fd, filesize("test.txt"));

fclose($fd);

echo "Содержимое файла: <strong>$content</strong><br><br>";


?>