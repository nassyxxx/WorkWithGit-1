<?php
#задание №1
$fd = fopen("test.txt", 'w') or die("не удалось открыть файл");

$str = "Привет мир";
fwrite($fd, $str);

$fd = fopen("test.txt", 'r') or die("не удалось открыть файл");
fclose($fd);

#задание №2
$fd = fopen("test.txt", 'r') or die("Не удалось открыть файл для чтения");

$content = fread($fd, filesize("test.txt"));

fclose($fd);

echo "Содержимое файла: <strong>$content</strong><br><br>";

#задание №3

if (rename("test.txt", "mir.txt")) {
    echo "Файл переименован: <br>";
} else {
    echo "Не удалось переименовать файл";
}



?>