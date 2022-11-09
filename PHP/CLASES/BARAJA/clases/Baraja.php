<?php

class Baraja {

    protected $cartas;

    public function __construct($cartas)
    {
        $this->cartas = $cartas;
    }

    public function removeCard($pos)
    {
        $card = $this->cartas[$pos];
        unset($this->cartas[$pos]);
        array_values($this->cartas);
        return $card;
    }

    public function insertCard($card){
        array_push($this->cartas,$card);
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