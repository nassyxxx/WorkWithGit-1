<?php
echo "<h2>Задание 1</h2>";

$arr = ['a', 'b', 'c', 'd', 'e'];
echo "Исходный массив: <pre>"; print_r($arr); echo "</pre>";
$result = array_map('strtoupper', $arr);
echo "Результат (array_map strtoupper): <pre>"; print_r($result); echo "</pre>";

echo "<h2>Задание 2</h2>";

$arr = [1,2,3,4,5,6,7,8,9,];

$length = count($arr);

$lastIndex = $length - 1;
  
$lastElement = $arr[$lastIndex];

echo "Исходный массив: " . implode(", ", $arr) . "<br>";
echo "count(arr) = $length<br>";
echo "Последний элемент: $lastElement<br>"; 

echo "<h2>Задание 3</h2>";

$numbers = [0, 36, 3, 7, 2, 10];
echo "Исходный массив: <pre>"; print_r($numbers); echo "</pre>";

$key = array_search(3, $numbers);

if ($key !== false) {
    echo "Результат: Элемент 3 найден! Ключ: $key<br>"; 
} else {
    echo "Результат: Элемент 3 не найден.<br>";
}


echo "<h2>Задание 4</h2>";

$arr1 = [1, 2, 3];
$arr2 = ['a', 'b', 'c'];
echo "Массив 1: <pre>"; print_r($arr1); echo "</pre>";
echo "Массив 2: <pre>"; print_r($arr2); echo "</pre>";
$result = array_merge($arr1, $arr2);
echo "Результат (array_merge): <pre>"; print_r($result); echo "</pre>";



echo "<h2>Задание 5</h2>";

$arr = [1, 2, 3, 4, 5];
echo "Исходный массив: <pre>"; print_r($arr); echo "</pre>";
$result = array_slice($arr, 1, 3);
echo "Результат (array_slice): <pre>"; print_r($result); echo "</pre>";
   

echo "<h2>Задание 6</h2>";

$arr = ['a' => 1, 'b' => 2, 'c' => 3];
echo "Исходный массив: <pre>"; print_r($arr); echo "</pre>";
$keys = array_keys($arr);
$values = array_values($arr);
echo "Ключи (array_keys): <pre>"; print_r($keys); echo "</pre>";    
echo "Значения (array_values): <pre>"; print_r($values); echo "</pre>";


echo "<h2>Задание 7</h2>";

$keys = ['a', 'b', 'c'];
$values = [1, 2, 3];
echo "Массив ключей: <pre>"; print_r($keys); echo "</pre>";
echo "Массив значений: <pre>"; print_r($values); echo "</pre>";
$result = array_combine($keys, $values);
echo "Результат (array_combine): <pre>"; print_r($result); echo "</pre>";


echo "<h2>Задание 8</h2>";

$arr = ['a', '-', 'b', '-', 'c', '-', 'd'];
echo "Исходный массив: <pre>"; print_r($arr); echo "</pre>";
$position = array_search('-', $arr);
echo "Результат (позиция первого '-'): $position<br>";

echo "<h2>Задание 9</h2>";

$arr = ['3' => 'a', '1' => 'c', '2' => 'e', '4' => 'b'];

echo "Исходный массив: <pre>"; print_r($arr); echo "</pre>";

echo "Сортировка по значениям (asort): <br>";
$temp = $arr;
asort($temp);
echo "<pre>"; print_r($temp); echo "</pre>";

echo "Сортировка по ключам (ksort): <br>";
$temp = $arr;
ksort($temp);
echo "<pre>"; print_r($temp); echo "</pre>";

echo "Сортировка по значениям в обратном порядке (arsort): <br>";
$temp = $arr;
arsort($temp);
echo "<pre>"; print_r($temp); echo "</pre>";



echo "<h2>Задание 10</h2>";

$str = '3497098611';
echo "Исходная строка: $str<br>";
$digits = str_split($str);
$sum = array_sum($digits);
echo "Результат (сумма цифр): $sum<br>";


echo "<h2>Задание 11</h2>";

$arr = array_fill(0, 10, 'x');
echo "Результат (array_fill): <pre>"; print_r($arr); echo "</pre>";


echo "<h2>Задание 12</h2>";

$arr1 = [1, 2, 3, 4, 5];
$arr2 = [3, 4, 5, 6, 7];
echo "Массив 1: <pre>"; print_r($arr1); echo "</pre>";
echo "Массив 2: <pre>"; print_r($arr2); echo "</pre>";
$result = array_intersect($arr1, $arr2);
echo "Результат (array_intersect): <pre>"; print_r($result); echo "</pre>";

?>
