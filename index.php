<?php
interface Area()
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

s
    public function infoAbout()
    {
        return "Это класс квадрата. У него " . self::SIDES_COUNT . " стороны.";
    }

    public function getA() { return $this->a; }
}




?>