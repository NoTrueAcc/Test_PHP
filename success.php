<?php

class Circle {
    public $x;
    public $y;
    public $r;

    public function __construct($x,$y,$r)
    {
        $this->x = $x;
        $this->y = $y;
        $this->r = $r;
    }

    public function __toString()
    {
        return "Окружность с центром в (" . $this->x . "," . $this->y . ") и радиусом " . $this->r;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getR()
    {
        return $this->r;
    }

    public function setX($x)
    {
        $this->x = $x;
    }

    public function setY($y)
    {
        $this->y = $y;
    }

    public function setR($r)
    {
        $this->r = $r;
    }
}

$circle = new Circle(5,7,10);

echo $circle;