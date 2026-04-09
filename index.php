<?php
interface Area
{

	public function getArea();

}

abstract class Figure
{
	protected $area;

	public function getArea(){
		return $this->area;
	}

	protected $color;

	public function getColor(){
		return $this->color;
	}

	public function setColor($color){
        	$this->color = $color;
   	}

	protected $number_side;

	public function getNumberSide(){
		return $this->number_side;
	}

	abstract public function infoAbout();
}

class Rectangle extends Figure implements Area
{
    private $a;
    private $b;
    const SIDES_COUNT = 4;

    public function __construct($a, $b, $color = "синий")
    {
        $this->a = $a;
        $this->b = $b;
        $this->color = $color;
        $this->number_side = self::SIDES_COUNT;
    }

    public function getArea()
    {
        $this->area = $this->a * $this->b;
        return $this->area;
    }


    public function infoAbout()
    {
        return "Это класс прямоугольника. У него " . self::SIDES_COUNT . " стороны.";
    }


    public function getA() { return $this->a; }
    public function getB() { return $this->b; }
}

class Triangle extends Figure implements Area
{
    private $a;
    private $b;
    private $c;
    const SIDES_COUNT = 3;

    public function __construct($a, $b, $c, $color = "зеленый")
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->color = $color;
        $this->number_side = self::SIDES_COUNT;
    }

    public function getArea()
    {
        $p = ($this->a + $this->b + $this->c) / 2;
        $this->area = sqrt($p * ($p - $this->a) * ($p - $this->b) * ($p - $this->c));
        return round($this->area, 2);
    }


    public function infoAbout()
    {
        return "Это класс треугольника. У него " . self::SIDES_COUNT . " стороны.";
    }

    public function getA() { return $this->a; }
    public function getB() { return $this->b; }
    public function getC() { return $this->c; }
}

class Square extends Figure implements Area
{
    private $a;
    const SIDES_COUNT = 4;

    public function __construct($a, $color = "красный")
    {
        $this->a = $a;
        $this->color = $color;
        $this->number_side = self::SIDES_COUNT;
    }

    public function getArea()
    {
        $this->area = $this->a * $this->a;
        return $this->area;
    }


    public function infoAbout()
    {
        return "Это класс квадрата. У него " . self::SIDES_COUNT . " стороны.";
    }

    public function getA() { return $this->a; }
}


echo "ПРЯМОУГОЛЬНИКИ<br>";
$rectangle1 = new Rectangle(10, 7, "синий");
$rectangle2 = new Rectangle(5, 12, "желтый");

echo "Прямоугольник 1:" . "<br>";
echo $rectangle1->infoAbout() . "<br>";
echo "Стороны: a = " . $rectangle1->getA() . ", b = " . $rectangle1->getB() . "<br>";
echo "Цвет: " . $rectangle1->getColor() . "<br>";
echo "Площадь: " . $rectangle1->getArea() . " кв.ед." . "<br>". "<br>";

echo "Прямоугольник 2:". "<br>";
echo $rectangle2->infoAbout() . "<br>";
echo "Стороны: a = " . $rectangle2->getA() . ", b = " . $rectangle2->getB() . "<br>";
echo "Цвет: " . $rectangle2->getColor() . "<br>";
echo "Площадь: " . $rectangle2->getArea() . " кв.ед." . "<br>". "<br>";

echo "ТРЕУГОЛЬНИКИ" . "<br>". "<br>";
$triangle1 = new Triangle(3, 4, 5, "зеленый");
$triangle2 = new Triangle(6, 8, 10, "оранжевый");

echo "Треугольник 1:". "<br>";
echo $triangle1->infoAbout() . "<br>";
echo "Стороны: a = " . $triangle1->getA() . ", b = " . $triangle1->getB() . ", c = " . $triangle1->getC() . "<br>";
echo "Цвет: " . $triangle1->getColor() . "<br>";
echo "Площадь: " . $triangle1->getArea() . " кв.ед." . "<br>". "<br>";

echo "Треугольник 2:". "<br>";
echo $triangle2->infoAbout() . "<br>";
echo "Стороны: a = " . $triangle2->getA() . ", b = " . $triangle2->getB() . ", c = " . $triangle2->getC() . "<br>";
echo "Цвет: " . $triangle2->getColor() . "<br>";
echo "Площадь: " . $triangle2->getArea() . " кв.ед." . "<br>" . "<br>";

echo " КВАДРАТЫ" . "<br>" . "<br>";
$square1 = new Square(18, "красный");
$square2 = new Square(7, "фиолетовый");

echo "Квадрат 1:" .  "<br>";
echo $square1->infoAbout() . "<br>";
echo "Сторона: a = " . $square1->getA() . "<br>";
echo "Цвет: " . $square1->getColor() . "<br>";
echo "Площадь: " . $square1->getArea() . " кв.ед." . "<br>" . "<br>";

echo "Квадрат 2:" .  "<br>";
echo $square2->infoAbout() . "<br>";
echo "Сторона: a = " . $square2->getA() . "<br>";
echo "Цвет: " . $square2->getColor() . "<br>";
echo "Площадь: " . $square2->getArea() . " кв.ед." . "<br>";


?>