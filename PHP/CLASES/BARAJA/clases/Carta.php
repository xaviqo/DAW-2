<?php
class Carta {
    
    protected $numero;
    protected $figura;

    public function __construct($numero, $figura)
    {
        $this->numero = $numero;
        $this->figura = $figura;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    public function getFigura()
    {
        return $this->figura;
    }

    /**
     * Set the value of figura
     *
     * @return  self
     */ 
    public function setFigura($figura)
    {
        $this->figura = $figura;

        return $this;
    }
}