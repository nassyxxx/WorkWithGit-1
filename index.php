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

    public function getA() { return $this->a; }
}




?>