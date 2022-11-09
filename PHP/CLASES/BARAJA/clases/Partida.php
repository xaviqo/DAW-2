<?php

class Partida {

    protected $jugadores;
    protected $cartas;
    protected $cartaEnJuego;
    protected $cartasJugadas;
    protected $turno;
    protected $pdf;

    public function __construct()
    {
        $this->jugadores = [];
        $this->cartas = [];
        $this->cartaEnJuego = null;
        $this->cartasJugadas = [];
        $this->turno = 0;
    }

    public function start(){
        $this->cartaEnJuego = array_pop($this->cartas);
        $this->turno = 1;
    }

    public function checkValidInputCard($card){
        //if ($this->cartaEnJuego->getFigura() == $card->getFigura()) return true;
    }

    public function getCurrentPlayer(){
        return $this->jugadores[$this->getTurno()-1];
    }

    public function getTurno(){
        return $this->turno;
    }

    public function nextTurno(){
        if ($this->turno <= 3) $this->turno++;
        else $this->turno = 1;
    }

    public function robar() {
        return array_pop($this->cartas);
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

    /**
     * Get the value of pdf
     */ 
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Set the value of pdf
     *
     * @return  self
     */ 
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;

        return $this;
    }
}