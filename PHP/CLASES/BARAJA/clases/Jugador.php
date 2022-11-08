<?php

class Jugador {

    protected $id;
    protected $baraja;

    public function __construct($baraja,$id)
    {
        $this->id = $id;
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

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
}