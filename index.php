<?php
class Rabotnik {
    public $name;
    public $age;
    public $salary;

    public function getName() {
        return $this->name;
    }
}

$worker1 = new Rabotnik();
$worker2 = new Rabotnik();

$worker1->name = "Иван";
$worker1->age = 25;
$worker1->salary = 50000;

$worker2->name = "Ольга";
$worker2->age = 30;
$worker2->salary = 60000;

$sumSalary = $worker1->salary + $worker2->salary;
$sumAge = $worker1->age + $worker2->age;

echo "Сумма зарплат: " . $sumSalary . "<br>";
echo "Сумма возрастов: " . $sumAge . "<br>";

echo "Имя работника 1: " . $worker1->getName() . "<br>";

?>

