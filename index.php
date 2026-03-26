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

?>