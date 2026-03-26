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
        file_put_contents('log.txt', date('Y-m-d H:i:s') . " - $msg\n", FILE_APPEND);
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
    echo $msg . "\n";
}

restore_error_handler();


?>