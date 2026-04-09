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
}

class Triangle extends Figure implements Area
{
    private $a;
    private $b;
    private $c;
    const SIDES_COUNT = 3;
}

class Square extends Figure implements Area
{
    private $a;
    const SIDES_COUNT = 4;
}




?>