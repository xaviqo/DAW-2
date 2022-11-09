<?php
class Jugador{

    protected $id;
    protected $baraja;

    public function __construct($baraja,$id)
    {
        $this->id = $id;
        $this->baraja = $baraja;
    }

    public function removeSelectedCard($pos){
        return $this->baraja->removeCard($pos);
    }

    public function getBaraja()
    {
        return $this->baraja;
    }

    public function setCarta($carta){
        $this->baraja->insertCard($carta);
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

    public function pdf(){
    }
}