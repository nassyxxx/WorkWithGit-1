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


?>