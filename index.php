<?php
#ЧАСТЬ 1

    #задание 1

set_error_handler(function($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

try {
    $handle = fopen('example.txt', 'r');
    fclose($handle);
} catch (ErrorException $e) {
    echo "Исключение: " . $e->getMessage() . "<br>";
   
}

restore_error_handler();

    #задание 2

function divide($a, $b) {
    if ($b == 0) {
        $msg = "Ошибка: деление на ноль (a=$a, b=$b)";
        file_put_contents('log.txt', date('Y-m-d H:i:s') . " - $msg<br>", FILE_APPEND);
        throw new DivisionByZeroError($msg);
    }
    return $a / $b;
}

try {
    echo divide(10, 0);
} catch (DivisionByZeroError $e) {
    echo "Перехвачено: " . $e->getMessage() . "<br>";
}
    
    #задание 3
set_error_handler(function($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

$countries = ['Spain' => 'Madrid', 'Russia' => 'Moscow'];

try {
    echo $countries['Germany'];
} catch (ErrorException $e) {
    $msg = "Ошибка доступа к массиву: " . $e->getMessage();
    echo $msg . "<br>";
}

restore_error_handler();

#ЧАСТЬ 2

    #задание 1

$time = mktime(10, 25, 0, 3, 15, 2025);
echo "Timestamp для 15.03.2025 10:25:00: " . $time . "<br>";

    #задание 2

$past = mktime(8, 5, 59, 10, 2, 1990);
$current = time();
$difference = $current - $past;

echo "Разница в секундах: " . $difference . "<br>";

    #задание 3
date_default_timezone_set('Europe/Moscow');
echo date('Y.m.d H:i:s')  . "<br>";

    #задание 4

$currentYear = date('Y');

$september = mktime(0, 0, 0, 9, 1, $currentYear);

echo date('Y.m.d', $september) . "<br>";

    #задание 5
$weekDays = [
    0 => 'Воскресенье',
    1 => 'Понедельник',
    2 => 'Вторник',
    3 => 'Среда',
    4 => 'Четверг',
    5 => 'Пятница',
    6 => 'Суббота'
];

$dayOfWeek = date('w', mktime(0, 0, 0, 2, 2, 2000));
echo "2 февраля 2000 года был(а): " . $weekDays[$dayOfWeek] . "<br>";

    #задание 6

$week = [
    0 => 'Воскресенье',
    1 => 'Понедельник',
    2 => 'Вторник',
    3 => 'Среда',
    4 => 'Четверг',
    5 => 'Пятница',
    6 => 'Суббота'
];

$todayIndex = date('w');
echo "1. Сегодня: " . $week[$todayIndex] . "<br>";

$birthday1Index = date('w', mktime(0, 0, 0, 6, 12, 2016));
echo "2. 12.06.2016 был: " . $week[$birthday1Index] . "<br>";

$myBirthdayIndex = date('w', mktime(0, 0, 0, 12, 3, 2007));
echo "3. 03.12.2007 (мой день рождения) был: " . $week[$myBirthdayIndex] . "<br>";


    #задание 7
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date1 = $_POST['date1'] ?? '';
    $date2 = $_POST['date2'] ?? '';
    
    try {
        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);
        
        if ($ts1 === false || $ts2 === false) {
            throw new Exception("Неверный формат даты. Используйте формат 'ГГГГ-ММ-ДД'");
        }
        
        $greater = ($ts1 > $ts2) ? $date1 : $date2;
        echo "<p>Большая дата: <strong>" . htmlspecialchars($greater) . "</strong></p>";
        
    } catch (Exception $ex) {
        echo '<p style="color:red;">Исключение: ' . $ex->getMessage() . '</p>';
    }
}

    #задание 8

$originalDate = '2025-12-31'; 

$timestamp = strtotime($originalDate);
$newFormat = date('d-m-Y', $timestamp); 

echo "Исходная дата: $originalDate<br>";
echo "Преобразованная дата: $newFormat<br>";
echo "<br>";
        
    #задание 9
$originalDate = '2000.02.03';

// 1. Прибавляем 2 дня к исходной дате
$date = date_create(str_replace('.', '-', $originalDate));
date_modify($date, '2 days');
echo "После добавления 2 дней: " . date_format($date, 'd.m.Y') . "<br>";

// 2. Прибавляем 1 месяц и 3 дня к исходной дате
$date = date_create(str_replace('.', '-', $originalDate));
date_modify($date, '1 month 3 days');
echo "После добавления 1 месяца и 3 дней: " . date_format($date, 'd.m.Y') . "<br>";

// 3. Прибавляем 1 год к исходной дате
$date = date_create(str_replace('.', '-', $originalDate));
date_modify($date, '1 year');
echo "После добавления 1 года: " . date_format($date, 'd.m.Y') . "<br>";

// 4. Отнимаем 3 дня от исходной даты
$date = date_create(str_replace('.', '-', $originalDate));
date_modify($date, '-3 days');
echo "После вычитания 3 дней: " . date_format($date, 'd.m.Y') . "<br>";
echo "<br>";
 
    #задание 10
 
$today = date_create(date('Y-m-d'));
$newYearObj = date_create(($currentYear + 1) . '-01-01');
$interval = date_diff($today, $newYearObj);
echo "До Нового Года осталось: " . $interval->days . " дней<br>";
echo "<br>";

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лаба12</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="POST">
    <label>Дата 1 (ГГГГ-ММ-ДД): 
        <input type="text" 
               name="date1" 
               pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" 
               placeholder="2025-12-31"
               required>
    </label><br><br>
    
    <label>Дата 2 (ГГГГ-ММ-ДД): 
        <input type="text" 
               name="date2" 
               pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" 
               placeholder="2025-12-31"
               required>
    </label><br><br>
    
    <button type="submit">Сравнить даты</button>
</form>
</body>
</html>