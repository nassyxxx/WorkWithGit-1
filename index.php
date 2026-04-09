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





?>