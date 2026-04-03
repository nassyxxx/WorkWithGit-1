<?php
class Rabotnik {
    public $name;
    private $age;
    public $salary;

    public function getName() {
        return $this->name;
    }

    public function setAge($newAge) {
        $this->age = $newAge;
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

echo "Имя работника 1: " . $worker1->getName() . "<br>";
echo "Возраст работника 1: " . $worker1->showAge() . "<br>";
echo "Зарплата работника 1: " . $worker1->getSalary() . "<br>";

echo "Общая сумма зарплат (через getSalary): " . $worker1->getSalary($worker2) . "<br>";


?>

