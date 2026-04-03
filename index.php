<?php
class Rabotnik {
    public $name;
    private $age;
    public $salary;

    public function getName() {
        return $this->name;
    }

    public function setAge($newAge) {
        if ($newAge >= 18) {
            $this->age = $newAge;
            echo "Возраст изменен на: " . $newAge . "<br>";
        } else {
            echo "Вам работать в нашей компании еще рано<br>";
        }
    }

   public function checkAge() {
        if ($this->age >= 18) {
            return true;
        } else {
            return false;
        }
    }

   public function showAge() {
        return $this->age;
    }



       public function getSalary(...$otherWorkers) {
        $total = $this->salary;
        
        foreach ($otherWorkers as $worker) {
            $total += $worker->salary;
        }
        
        return $total;
    }
}

$worker1 = new Rabotnik();
$worker2 = new Rabotnik();

$worker1->name = "Иван";
$worker1->setAge(25);
$worker1->salary = 50000;

$worker2->name = "Ольга";
$worker2->setAge(30);
$worker2->salary = 60000;

$sumSalary = $worker1->salary + $worker2->salary;
$sumAge = $worker1->showAge() + $worker2->showAge();


echo "Сумма зарплат: " . $sumSalary . "<br>";
echo "Сумма возрастов: " . $sumAge . "<br>";
echo "<br>";

echo "Имя работника 1: " . $worker1->getName() . "<br>";
echo "Возраст работника 1: " . $worker1->showAge() . "<br>";
echo "Зарплата работника 1: " . $worker1->getSalary() . "<br>";

echo "<br>";

echo "Общая сумма зарплат (через getSalary): " . $worker1->getSalary($worker2) . "<br>";

echo "<br>";

$worker3 = new Rabotnik();

$worker3->name = "Олег";
$worker3->salary = 75000;

echo "Имя работника 3: " . $worker3->getName() . "<br>";

echo "Попытка установить возраст 16:<br>";
$worker3->setAge(16);

echo "<br>Попытка установить возраст 25:<br>";
$worker3->setAge(25);
echo "Текущий возраст: " . $worker3->showAge() . "<br>";

echo "<br>";

$worker4 = new Rabotnik();

$worker4->name = "Анна";
$worker4->setAge(5);
$worker4->salary = 20000;

echo $worker1->getName() . " (25 лет): " . ($worker1->checkAge() ? "true" : "false") . "<br>";
echo $worker4->getName() . " (5 лет): " . ($worker4->checkAge() ? "true" : "false") . "<br>";

?>

