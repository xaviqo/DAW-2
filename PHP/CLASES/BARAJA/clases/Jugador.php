<?php

class Jugador {

    protected $baraja;

    public function __construct($baraja)
    {
        $this->baraja = $baraja;
    }

    public function getBaraja()
    {
        return $this->baraja;
    }

    public function setBaraja($baraja)
    {
        $this->baraja = $baraja;

        return $this;
    }
}