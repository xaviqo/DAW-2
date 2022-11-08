<?php

class Baraja {

    protected $cartas;

    public function __construct($cartas)
    {
        $this->cartas = $cartas;
    }

    
    public function getCartas()
    {
        return $this->cartas;
    }

    public function setCartas($cartas)
    {
        $this->cartas = $cartas;

        return $this;
    }
}