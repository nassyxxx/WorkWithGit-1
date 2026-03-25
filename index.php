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
    echo "Файл переименован <br>";
} else {
    echo "Не удалось переименовать файл";
}

#задание №4
if(mkdir("folder")) {
    echo "Каталог создан.<br>";
}
else {
    echo "Ошибка при создании каталога.<br>";
}

$newPath = "folder" . "/" . "mir.txt";

if (rename("mir.txt", $newPath)) {
    echo "Файл  перемещён в папку.<br>";
    echo "Новый путь: <strong>$newPath</strong><br><br>";
} else {
    echo "Не удалось переместить файл.<br><br>";
}

#задание №5

$sourceFile = $newPath;
$copyFile = "folder" . "/world.txt"; 

if (copy($sourceFile, $copyFile)) {
    echo " Копия создана: '$sourceFile' → '$copyFile'<br><br>";
} else {
    echo " Не удалось создать копию файла.<br><br>";
}

#задание №6

if (file_exists($copyFile)) {
    $fileSize = filesize($copyFile);  
    
    echo "Размер файла '$copyFile':<br>";
    echo "В байтах: $fileSize байт<br>";
    echo "В килобайтах:" . round($fileSize / 1024, 2) . " КБ<br>";
    echo "В мегабайтах:" . round($fileSize / 1024 / 1024, 2) . " МБ<br><br>";
} else {
    echo "Файл '$copyFile' не найден.<br><br>";
}

#задание 7

if (file_exists($copyFile)) {

    if (unlink($copyFile)) {
        echo "Файл '$copyFile' успешно удалён.<br><br>";
    } else {
        echo "Ошибка при удалении файла '$copyFile'.<br><br>";
    }
} else {
    echo "Файл '$$copyFile' не найден.<br><br>";
}

#задание 8
$file1 = "folder/world.txt";

echo "Файл '$file1': ";
if (file_exists($file1)) {

    echo "Существует<br>";
    
} else {
    echo "Не существует<br>";
}

echo "<br>";

$file2 = "folder/mir.txt";
echo "Файл '$file2': ";

if (file_exists($file2)) {
    echo "Существует<br>";
} else {
    echo "Не существует<br>";
}


#часть 2

#задание 1
if(mkdir("test")) {
    echo "Каталог создан.<br>";
}
else {
    echo "Ошибка при создании каталога.<br>";
}

#задание 2

$folderOld = "test";
$folderNew = "www";

if (file_exists($folderOld)) {
    if (rename($folderOld, $folderNew)) {
        echo "Папка '$folderOld' переименована в '$folderNew'.<br><br>";
    } else {
        echo "Ошибка при переименовании папки.<br><br>";
    }
} else {
    echo "Папка '$folderOld' не найдена.<br><br>";
}


#задание 3

if (file_exists($folderNew ) && is_dir($folderNew)) {
    $files = array_diff(scandir($folderNew ), ['.', '..']);
    foreach ($files as $file) {
        $filePath = $folderNew  . DIRECTORY_SEPARATOR . $file;
        is_dir($filePath) ? rmdir($filePath) : unlink($filePath);
    }
    
   
    if (rmdir($folderNew)) {
        echo "Папка '$folderNew' успешно удалена.<br><br>";
    } else {
        echo "Ошибка при удалении папки '$folderNew'.<br><br>";
    }
} else {
    echo " Папка '$folderNew ' не найдена или не является папкой.<br><br>";
}




?>