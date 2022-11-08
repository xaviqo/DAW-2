<?php

class Partida {

    protected $jugadores;
    protected $cartas;
    protected $cartaEnJuego;
    protected $cartasJugadas;
    protected $turno;

    public function __construct()
    {
        $this->jugadores = [];
        $this->cartas = [];
        $this->cartaEnJuego = new Carta(null,null);
        $this->cartasJugadas = [];
        $this->turno = 1;
    }

    public function start(){
        $this->cartaEnJuego = array_pop($this->cartas);
    }

    public function getTurno(){
        return $this->turno;
    }

    public function nextTurno(){
        $this->turno++;
    }


    public function robar() {
        return array_pop($cartas);
    }

    public function crearBaraja(){
        $baraja = [];
        for ($k=0; $k < 7; $k++) {
            array_push($baraja,array_pop($this->cartas));
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

    /**
     * Get the value of cartaEnJuego
     */ 
    public function getCartaEnJuego()
    {
        return $this->cartaEnJuego;
    }

    /**
     * Set the value of cartaEnJuego
     *
     * @return  self
     */ 
    public function setCartaEnJuego($cartaEnJuego)
    {
        $this->cartaEnJuego = $cartaEnJuego;

        return $this;
    }
}