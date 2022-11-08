<?php

class Partida {

    protected $jugadores;
    protected $cartas;

    public function __construct()
    {
        $this->jugadores = [];
        $this->cartas = [];
    }

    public function crearBaraja(){
        $baraja = [];
        for ($k=0; $k < 7; $k++) { 
            array_push($baraja,$this->cartas[rand(0,sizeof($this->cartas))]);
        }
        return new Baraja($baraja);
    }
    /**
     * Get the value of jugadores
     */ 
    public function getJugadores()
    {
        return $this->jugadores;
    }

    /**
     * Set the value of jugadores
     *
     * @return  self
     */ 
    public function setJugadores($jugadores)
    {
        $this->jugadores = $jugadores;

        return $this;
    }
    
    public function setJugador($jugador){
        array_push($this->jugadores,$jugador);
    }

    /**
     * Get the value of cartas
     */ 
    public function getCartas()
    {
        return $this->cartas;
    }

    /**
     * Set the value of cartas
     *
     * @return  self
     */ 
    public function setCartas($cartas)
    {
        $this->cartas = $cartas;

        return $this;
    }
}